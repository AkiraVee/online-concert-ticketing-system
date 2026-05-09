<?php
// event-details.php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$eventId = isset($_GET['eventId']) ? (int)$_GET['eventId'] : 0;

$eventFile = "events/event_{$eventId}.php";

if ($eventId <= 0 || !file_exists($eventFile)) {
    die("<h2 style='color:red;text-align:center;padding:80px;'>Event not found.</h2>");
}

include $eventFile;

if (!isset($event) || !is_array($event)) {
    die("<h2 style='color:red;text-align:center;padding:80px;'>Event data error.</h2>");
}

$eventJson = json_encode($event, JSON_UNESCAPED_SLASHES);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($event['title']) ?> — Absolute Cinema</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body class="bg-zinc-950 text-zinc-300 min-h-screen">

  <!-- Nav -->
  <nav class="border-b border-zinc-800 sticky top-0 z-50 bg-zinc-950/90 backdrop-blur">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center gap-4">
      <a href="homepage.php" class="flex items-center gap-2 text-white hover:text-violet-400 transition-colors">
        <i class="fa-solid fa-arrow-left text-sm"></i>
        <span class="text-sm">Back</span>
      </a>
      <div class="h-5 w-px bg-zinc-700"></div>
      <div class="flex items-center gap-2 text-white">
        <i class="fa-solid fa-ticket text-violet-400 text-xl"></i>
        <span class="text-lg font-semibold tracking-tight">Absolute Cinema</span>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div id="pageContent"></div>

  <!-- Buy Modal -->
  <div id="buyModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-zinc-900 border border-zinc-700 rounded-2xl w-full max-w-md p-6 relative">
      <button onclick="closeModal()" class="absolute top-4 right-4 text-zinc-500 hover:text-white">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
      <h3 class="serif text-2xl text-white mb-1">Confirm Order</h3>
      <p class="text-zinc-400 text-sm mb-6">Review your ticket selection before checkout.</p>

      <div id="modalSummary" class="bg-zinc-800 rounded-xl p-4 mb-5 space-y-2 text-sm"></div>

      <div class="mb-5">
        <label class="block text-xs text-zinc-400 mb-1.5 font-medium uppercase tracking-wide">Full Name</label>
        <input type="text" id="modalName" placeholder="Juan dela Cruz"
          class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500">
      </div>

      <div class="mb-5">
        <label class="block text-xs text-zinc-400 mb-1.5 font-medium uppercase tracking-wide">Email</label>
        <input type="email" id="modalEmail" placeholder="juan@example.com"
          class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500">
      </div>

      <div class="mb-6">
        <label class="block text-xs text-zinc-400 mb-1.5 font-medium uppercase tracking-wide">Payment Method</label>
        <div class="grid grid-cols-3 gap-2">
          <button onclick="selectPayment(this)" class="pay-btn border border-zinc-700 rounded-xl py-2 text-xs text-zinc-400 hover:border-violet-500 hover:text-white transition-all">GCash</button>
          <button onclick="selectPayment(this)" class="pay-btn border border-zinc-700 rounded-xl py-2 text-xs text-zinc-400 hover:border-violet-500 hover:text-white transition-all">Maya</button>
          <button onclick="selectPayment(this)" class="pay-btn border border-zinc-700 rounded-xl py-2 text-xs text-zinc-400 hover:border-violet-500 hover:text-white transition-all">Card</button>
        </div>
      </div>

      <button onclick="submitOrder()" class="w-full bg-violet-600 hover:bg-violet-500 text-white py-3 rounded-xl font-semibold text-sm">
        Confirm & Pay
      </button>
    </div>
  </div>

  <!-- Footer -->
  <footer class="border-t border-zinc-800 py-8 text-center text-zinc-600 text-sm">
    <div class="flex justify-center items-center gap-2 text-zinc-400 mb-3">
      <i class="fa-solid fa-ticket text-violet-400"></i>
      <span class="font-medium">Absolute Cinema</span>
    </div>
    <p>© 2026 Absolute Cinema. All rights reserved.</p>
  </footer>

<script>
// Event Data from PHP
const eventData = <?= $eventJson ?>;

let state = {
  event: eventData,
  activeImg: 0,
  selectedDate: 0,
  selectedTier: 0,
  qty: 1,
};

function init() {
  document.title = `${state.event.title} — Absolute Cinema`;
  renderPage();
}

function renderPage() {
  const e = state.event;
  const tier = e.tiers[state.selectedTier];
  const date = e.dates[state.selectedDate];

  const html = `
    <div class="max-w-6xl mx-auto px-6 py-12">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Images -->
        <div class="lg:col-span-2 space-y-6">
          <div class="relative rounded-2xl overflow-hidden" style="height: 400px;">
            <img id="mainImg" src="${e.images[0]}" alt="${e.title}" class="w-full h-full object-cover">
          </div>
          <div class="flex gap-2">
            ${e.images.map((img, i) => `
              <div onclick="switchImage(${i})" class="thumb cursor-pointer rounded-lg overflow-hidden flex-1" style="height: 80px;">
                <img src="${img}" class="w-full h-full object-cover ${i === 0 ? '' : 'opacity-50'}">
              </div>
            `).join('')}
          </div>
        </div>

        <!-- Details -->
        <div class="space-y-6">
          <div>
            <h1 class="serif text-4xl text-white mb-2">${e.title}</h1>
            <div class="flex items-center gap-2 text-zinc-400">
              <i class="fa-solid fa-tag"></i>
              <span class="uppercase tracking-wide">${e.type}</span>
            </div>
          </div>

          <div class="border-t border-zinc-800 pt-4">
            <p class="text-zinc-400 text-sm mb-2">Event Details</p>
            <div class="space-y-2 text-sm">
              <div class="flex items-center gap-2"><i class="fa-solid fa-calendar text-violet-400 w-4"></i> ${e.date}</div>
              <div class="flex items-center gap-2"><i class="fa-solid fa-map-pin text-violet-400 w-4"></i> ${e.location}</div>
            </div>
          </div>

          <!-- Date Selection -->
          <div class="border-t border-zinc-800 pt-4">
            <p class="text-zinc-400 text-sm mb-3">Select Date</p>
            <div class="space-y-2">
              ${e.dates.map((d, i) => `
                <button onclick="selectDate(${i})" 
                  class="w-full py-2.5 px-4 rounded-lg border text-left ${state.selectedDate === i ? 'border-violet-500 bg-violet-500/10' : 'border-zinc-700 hover:border-zinc-600'}">
                  ${d.label} • ${d.time}
                </button>
              `).join('')}
            </div>
          </div>

          <!-- Tier Selection -->
          <div class="border-t border-zinc-800 pt-4">
            <p class="text-zinc-400 text-sm mb-3">Ticket Tier</p>
            <div class="space-y-2">
              ${e.tiers.map((t, i) => `
                <button onclick="selectTier(${i})" 
                  class="w-full py-2.5 px-4 rounded-lg border text-left ${state.selectedTier === i ? 'border-violet-500 bg-violet-500/10' : 'border-zinc-700 hover:border-zinc-600'}">
                  <div class="flex justify-between">
                    <span>${t.name}</span>
                    <span class="text-violet-400">₱${t.price.toLocaleString()}</span>
                  </div>
                </button>
              `).join('')}
            </div>
          </div>

          <!-- Quantity -->
          <div class="border-t border-zinc-800 pt-4">
            <p class="text-zinc-400 text-sm mb-3">Quantity (max 5)</p>
            <div class="flex items-center gap-4">
              <button onclick="changeQty(-1)" class="w-10 h-10 rounded-lg border border-zinc-700 hover:border-violet-500">-</button>
              <span class="flex-1 text-center font-semibold text-lg">${state.qty}</span>
              <button onclick="changeQty(1)" class="w-10 h-10 rounded-lg border border-zinc-700 hover:border-violet-500">+</button>
            </div>
          </div>

          <div class="border-t border-zinc-800 pt-6">
            <div class="flex justify-between text-lg mb-4">
              <span class="text-zinc-400">Total:</span>
              <span class="font-bold text-white">₱${(tier.price * state.qty).toLocaleString()}</span>
            </div>
            <button onclick="openModal()" class="w-full bg-violet-600 hover:bg-violet-500 py-4 rounded-xl font-semibold text-lg">
              Buy Tickets
            </button>
          </div>
        </div>
      </div>

      <!-- Description -->
      <div class="mt-16 border-t border-zinc-800 pt-8">
        <h2 class="text-2xl text-white mb-4">About This Event</h2>
        <p class="text-zinc-300 leading-relaxed">${e.description}</p>
      </div>
    </div>
  `;

  document.getElementById("pageContent").innerHTML = html;
}

// ==================== All Functions ====================
function selectDate(i) { state.selectedDate = i; renderPage(); }
function selectTier(i) { state.selectedTier = i; renderPage(); }

function changeQty(delta) {
  let newQty = state.qty + delta;
  if (newQty >= 1 && newQty <= 5) {
    state.qty = newQty;
    renderPage();
  }
}

function switchImage(i) {
  state.activeImg = i;
  document.getElementById("mainImg").src = state.event.images[i];
}

function openModal() {
  if (localStorage.getItem("userLoggedIn") !== "true") {
    alert("Please log in first to purchase tickets.");
    window.location.href = "login.php";
    return;
  }
  // ... your modal logic (you can expand this part if needed)
  // For now, keeping it simple
  alert("Order modal opened! (You can expand this later)");
}

function closeModal() {
  document.getElementById("buyModal").classList.add("hidden");
}

function selectPayment(btn) {
  document.querySelectorAll('.pay-btn').forEach(b => b.classList.remove('border-violet-500', 'text-white'));
  btn.classList.add('border-violet-500', 'text-white');
}

function submitOrder() {
  alert("Order submitted! (Redirect to order-summary.php can be added here)");
}

// Start the page
init();
</script>
</body>
</html> 