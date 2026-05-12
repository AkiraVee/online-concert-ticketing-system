<?php
session_start();

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
  <style>
  </style>
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
    <div class="flex justify-center gap-6 text-xs mb-4">
      <a href="faqs.php" class="hover:text-zinc-300">FAQs</a>
      <a href="https://www.facebook.com/jersey1705" target="_blank" class="hover:text-zinc-300">Contact</a>
      <a href="terms.php" class="hover:text-zinc-300">Terms</a>
    </div>
    <p>© 2026 Absolute Cinema. All rights reserved.</p>
  </footer>

<script>
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
  const maxCapacity = Math.max(...e.tiers.map(t => t.available || 0)) || 1;

  const steps = [
    { icon: 'fa-house',         label: 'Browse available events from the homepage.' },
    { icon: 'fa-calendar-days', label: 'Select the event you want to attend.' },
    { icon: 'fa-chair',         label: 'Choose your preferred ticket section and seat(s).' },
    { icon: 'fa-ticket',        label: 'Click the <strong class="text-white">Buy Ticket</strong> button.' },
    { icon: 'fa-user-circle',   label: 'Login or create an account.' },
    { icon: 'fa-list-check',    label: 'Review your order summary.' },
    { icon: 'fa-credit-card',   label: 'Select your payment method.' },
    { icon: 'fa-lock',          label: 'Complete the payment process.' },
    { icon: 'fa-circle-check',  label: 'Your ticket will appear under <strong class="text-white">My Account → My Tickets</strong>.' },
  ];

  const html = `
    <!-- Hero Header -->
    <div class="border-b border-zinc-800 bg-zinc-950 py-8">
      <div class="max-w-6xl mx-auto px-6">
        <span class="inline-block bg-violet-600 text-white text-xs font-semibold uppercase tracking-widest px-3 py-1 rounded-full mb-4">${e.type}</span>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-3" style="font-family: Georgia, serif;">${e.title}</h1>
        <div class="flex flex-wrap items-center gap-5 text-sm text-zinc-400">
          <span class="flex items-center gap-1.5">
            <i class="fa-solid fa-map-pin text-violet-400"></i>
            ${e.location}
          </span>
          <span class="flex items-center gap-1.5">
            <i class="fa-regular fa-clock text-violet-400"></i>
            ${e.duration}
          </span>
        </div>
      </div>
    </div>

    <!-- Page Body -->
    <div class="max-w-6xl mx-auto px-6 py-10">
      <div class="flex flex-col lg:flex-row gap-10">

        <!-- LEFT COLUMN -->
        <div class="flex-1 min-w-0 space-y-10">

          <!-- Gallery -->
          <section>
            <h2 class="text-base font-semibold text-zinc-400 uppercase tracking-widest mb-4">Gallery</h2>
            <div class="rounded-2xl overflow-hidden mb-3" style="height: 380px;">
              <img id="mainImg" src="${e.images[state.activeImg]}" alt="${e.title}" class="w-full h-full object-cover">
            </div>
            <div class="flex gap-2">
              ${e.images.map((img, i) => `
                <div onclick="switchImage(${i})"
                  class="cursor-pointer rounded-xl overflow-hidden flex-1 ring-2 transition-all ${i === state.activeImg ? 'ring-violet-500' : 'ring-transparent opacity-50 hover:opacity-75'}"
                  style="height: 72px;">
                  <img src="${img}" class="w-full h-full object-cover">
                </div>
              `).join('')}
            </div>
          </section>

          <!-- About This Event -->
          <section>
            <div class="flex justify-between items-end mb-3">
              <h2 class="text-xl font-bold text-white" style="font-family: Georgia, serif;">About This Event</h2>
              <button onclick="openSeatPlan('${e.images[3]}')" class="text-violet-400 hover:text-violet-300 text-sm font-medium transition-colors">
                <i class="fa-solid fa-map mr-1"></i> View Seat Plan
              </button>
            </div>
            <p class="text-zinc-400 leading-relaxed text-sm">${e.description}</p>
          </section>

          <!-- Event Info -->
          <section>
            <h2 class="text-xl font-bold text-white mb-4" style="font-family: Georgia, serif;">Event Info</h2>
            <div class="grid grid-cols-2 gap-3">
              <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4">
                <p class="text-xs text-zinc-500 mb-1 uppercase tracking-wide">Venue</p>
                <p class="text-white text-sm font-medium">${e.location}</p>
              </div>
              <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4">
                <p class="text-xs text-zinc-500 mb-1 uppercase tracking-wide">Duration</p>
                <p class="text-white text-sm font-medium">${e.duration}</p>
              </div>
              <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4">
                <p class="text-xs text-zinc-500 mb-1 uppercase tracking-wide">Type</p>
                <p class="text-white text-sm font-medium">${e.type}</p>
              </div>
              <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-4">
                <p class="text-xs text-zinc-500 mb-1 uppercase tracking-wide">Available Shows</p>
                <p class="text-white text-sm font-medium">${e.dates.length} date${e.dates.length > 1 ? 's' : ''}</p>
              </div>
            </div>
          </section>

          <!-- How to Purchase Tickets -->
          <section>
            <h2 class="text-xl font-bold text-white mb-4" style="font-family: Georgia, serif;">How to Purchase Tickets</h2>
            <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5">
              ${steps.map((step, i) => `
                <div class="flex gap-4 items-start py-4 ${i !== steps.length - 1 ? 'border-b border-zinc-800' : ''}">
                  <div class="flex-shrink-0 w-8 h-8 rounded-full bg-violet-600/20 border border-violet-500/40 flex items-center justify-center mt-0.5">
                    <span class="text-violet-400 text-xs font-bold">${i + 1}</span>
                  </div>
                  <div class="flex items-center gap-3">
                    <i class="fa-solid ${step.icon} text-violet-400 text-sm w-4 text-center flex-shrink-0"></i>
                    <p class="text-zinc-400 text-sm leading-relaxed">${step.label}</p>
                  </div>
                </div>
              `).join('')}
            </div>
          </section>

        </div>

        <!-- RIGHT SIDEBAR -->
        <div class="lg:w-72 xl:w-80 flex-shrink-0">
          <div class="sticky top-20 bg-zinc-900 border border-zinc-800 rounded-2xl p-5 space-y-6">

            <!-- Date & Time -->
            <div>
              <p class="text-xs text-zinc-500 uppercase tracking-widest font-semibold mb-3">Select Date &amp; Time</p>
              <div class="space-y-2">
                ${e.dates.map((d, i) => `
                  <button onclick="selectDate(${i})"
                    class="w-full flex justify-between items-center px-4 py-3 rounded-xl border text-sm transition-all ${state.selectedDate === i
                      ? 'border-violet-500 bg-violet-600 text-white font-medium'
                      : 'border-zinc-700 text-zinc-300 hover:border-zinc-500'}">
                    <span>${d.label}</span>
                    <span class="${state.selectedDate === i ? 'text-white' : 'text-zinc-400'}">${d.time}</span>
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
            <div>
              <p class="text-xs text-zinc-500 uppercase tracking-widest font-semibold mb-3">Quantity <span class="normal-case">(max 5)</span></p>
              <div class="flex items-center gap-3">
                <button onclick="changeQty(-1)" class="w-10 h-10 rounded-lg border border-zinc-700 hover:border-violet-500 text-white text-lg flex items-center justify-center transition-colors">&#8722;</button>
                <span class="flex-1 text-center font-bold text-xl text-white">${state.qty}</span>
                <button onclick="changeQty(1)" class="w-10 h-10 rounded-lg border border-zinc-700 hover:border-violet-500 text-white text-lg flex items-center justify-center transition-colors">+</button>
              </div>
            </div>

            <!-- Total & Buy -->
            <div class="border-t border-zinc-800 pt-4">
              <div class="flex justify-between items-center mb-4">
                <span class="text-zinc-400 text-sm">Total</span>
                <span class="text-white font-bold text-xl">&#8369;${(tier.price * state.qty).toLocaleString()}</span>
              </div>
              <button onclick="openModal()" class="w-full bg-violet-600 hover:bg-violet-500 text-white py-3.5 rounded-xl font-semibold text-sm transition-colors">
                Buy Tickets
              </button>
            </div>

          </div>
        </div>

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
  renderPage();
}

function openModal() {
  <?php if (!isset($_SESSION['UserID'])): ?>
    alert("Please log in first to purchase tickets.");
    window.location.href = "login.php";
    return;
  <?php endif; ?>

  const e = state.event;
  const tier = e.tiers[state.selectedTier];
  const date = e.dates[state.selectedDate];
  const total = tier.price * state.qty;

  const params = new URLSearchParams({
    eventTitle: e.title,
    date:       date.label + ' • ' + date.time,
    location:   e.location,
    tier:       tier.name,
    quantity:   state.qty,
    total:      total,
  });

  window.location.href = `order-summary.php?${params.toString()}`;
}

function closeModal() {
  document.getElementById("buyModal").classList.add("hidden");
}

function selectPayment(btn) {
  document.querySelectorAll('.pay-btn').forEach(b => b.classList.remove('border-violet-500', 'text-white'));
  btn.classList.add('border-violet-500', 'text-white');
}

function submitOrder() {
  // Handled by openModal redirect
}

init();

// --- Seat Plan Popup Logic ---

function openSeatPlan(imgSrc) {
    const lightbox = document.getElementById('imageLightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    
    // Set the seat plan image and show the modal
    if (lightbox && lightboxImg) {
        lightboxImg.src = imgSrc;
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        // Prevent background scrolling for a focused view
        document.body.style.overflow = 'hidden'; 
    }
}

function closeLightbox() {
    const lightbox = document.getElementById('imageLightbox');
    if (lightbox) {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        // Restore scrolling when closed
        document.body.style.overflow = 'auto'; 
    }
}

// Close if user clicks the dark background area
document.getElementById('imageLightbox').onclick = function(e) {
    if (e.target === this) closeLightbox();
};
</script>
<!-- New feature: Pop Up window -->
<div id="imageLightbox" 
     class="fixed inset-0 z-[100] bg-black/95 backdrop-blur-md hidden flex items-center justify-center p-4 lg:p-10">
    
    <button onclick="closeLightbox()" class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors z-50">
      <i class="fa-solid fa-xmark text-4xl"></i>
    </button>
    
    <img id="lightboxImg" src="" class="max-w-full max-h-full object-contain shadow-2xl rounded-lg">
</div>
</body>
</html>