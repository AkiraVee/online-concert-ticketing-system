<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

include('mysql-connect.php');

$userID = $_SESSION['UserID'];

// Fetch user info
$userQuery = "SELECT FullName, Email, Birthdate, Age, ContactNumber FROM usertb WHERE UserID='$userID'";
$userResult = mysqli_query($conn, $userQuery);
$user = mysqli_fetch_assoc($userResult);

// Fetch user's purchased tickets
$ticketsQuery = "SELECT * FROM ordertb 
                 WHERE UserID = '$userID' 
                 ORDER BY PurchaseDate DESC, TicketID DESC";
$ticketsResult = mysqli_query($conn, $ticketsQuery);

$fullName = $user['FullName'] ?? 'Unknown';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Profile - Absolute Cinema</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body class="bg-zinc-950 text-zinc-300">

  <!-- Nav -->
  <nav class="border-b border-zinc-800 sticky top-0 z-50 bg-zinc-950/90 backdrop-blur">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-2 text-white">
        <i class="fa-solid fa-ticket text-violet-400 text-xl"></i>
        <span class="text-lg font-semibold tracking-tight">Absolute Cinema</span>
      </div>
      <div class="flex items-center gap-6 text-sm">
        <a href="homepage.php" class="hover:text-white">Home</a>
        <a href="logout.php" class="text-red-400 hover:text-red-500 flex items-center gap-2">
          <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
      </div>
    </div>
  </nav>

  <div class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row gap-10">

      <!-- Sidebar -->
      <div class="md:w-80 flex-shrink-0">
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 text-center">
          <div class="w-28 h-28 mx-auto rounded-2xl bg-gradient-to-br from-violet-500 to-fuchsia-500 flex items-center justify-center text-5xl mb-6">
            👤
          </div>
          <h2 class="text-2xl font-semibold text-white mb-1"><?= htmlspecialchars($fullName) ?></h2>
          <p class="text-zinc-400"><?= htmlspecialchars($user['Email'] ?? '') ?></p>

          <div class="mt-8 pt-6 border-t border-zinc-800 text-left space-y-4 text-sm">
            <div class="flex justify-between">
              <span class="text-zinc-500">Age</span>
              <span class="text-zinc-300"><?= $user['Age'] ?? '--' ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-zinc-500">Tickets Purchased</span>
              <span class="text-violet-400 font-medium"><?= mysqli_num_rows($ticketsResult) ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-zinc-500">Contact</span>
              <span class="text-zinc-300"><?= htmlspecialchars($user['ContactNumber'] ?? '--') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-zinc-500">Birthdate</span>
              <span class="text-zinc-300"><?= htmlspecialchars($user['Birthdate'] ?? '--') ?></span>
            </div>
            <button onclick="alert('Edit profile coming soon!')" 
              class="w-full mt-4 bg-violet-600 hover:bg-violet-500 text-white px-5 py-2 rounded-xl text-sm">
              Edit Profile
            </button> 
          </div>
        </div>
      </div>

      

      <!-- Main Content -->
      <div class="flex-1">
        <h1 class="text-4xl text-white mb-8">My Profile</h1>

        <!-- Tabs -->
        <div class="flex gap-6 border-b border-zinc-800 mb-8">
          <button onclick="showTab(0)" id="tab0" 
            class="pb-4 text-white border-b-2 border-violet-500 font-medium flex items-center gap-2">
            <i class="fa-solid fa-ticket text-violet-400"></i> Upcoming Tickets
          </button>
          <button onclick="showTab(1)" id="tab1" 
            class="pb-4 text-zinc-400 hover:text-white border-b-2 border-transparent transition-colors flex items-center gap-2">
            <i class="fa-solid fa-ticket"></i> View My Tickets
          </button>
        </div>

        <!-- Tab 1: Upcoming Tickets -->
        <div id="content0">
          <h3 class="text-xl font-semibold mb-6 flex items-center gap-3">
            <i class="fa-solid fa-ticket text-violet-400"></i> Upcoming Tickets
          </h3>
          <div id="upcomingTickets" class="grid grid-cols-1 md:grid-cols-2 gap-5"></div>
        </div>

        <!-- Tab 2: My Purchased Tickets -->
        <div id="content1" class="hidden">
          <h3 class="text-xl font-semibold mb-6 flex items-center gap-3">
            <i class="fa-solid fa-clock-rotate-left text-emerald-400"></i> My Purchased Tickets
          </h3>

          <?php if (mysqli_num_rows($ticketsResult) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <?php while ($ticket = mysqli_fetch_assoc($ticketsResult)): ?>
                <div class="bg-zinc-900 border border-zinc-700 rounded-3xl overflow-hidden">
                  <div class="p-6">
                    <h4 class="font-semibold text-lg text-white"><?= htmlspecialchars($ticket['EventTitle']) ?></h4>
                    <p class="text-zinc-400 text-sm mt-1"><?= $ticket['EventDate'] ?> • <?= htmlspecialchars($ticket['EventLocation']) ?></p>
                    
                    <div class="mt-4 space-y-2 text-sm">
                      <div class="flex justify-between">
                        <span class="text-zinc-500">Tier</span>
                        <span class="text-white"><?= htmlspecialchars($ticket['SeatLocation']) ?></span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-zinc-500">Quantity</span>
                        <span class="text-white"><?= $ticket['TicketQuantity'] ?> ticket(s)</span>
                      </div>
                      <div class="flex justify-between pt-3 border-t border-zinc-700">
                        <span class="text-zinc-500">Total Paid</span>
                        <span class="text-violet-400 font-bold">₱<?= number_format($ticket['TotalPrice']) ?></span>
                      </div>
                    </div>
                  </div>
                  <div class="bg-zinc-800 px-6 py-4 flex justify-between items-center border-t border-zinc-700">
                    <span class="text-emerald-400 text-sm">✅ Confirmed</span>
                    <button onclick="alert('🎟️ Ticket #<?= $ticket['TicketID'] ?> - Download coming soon!')" 
                      class="bg-violet-600 hover:bg-violet-500 text-white px-5 py-2 rounded-xl text-sm">
                      View Ticket
                    </button>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          <?php else: ?>
            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-12 text-center">
              <i class="fa-solid fa-ticket text-6xl text-zinc-600 mb-4"></i>
              <p class="text-zinc-400">No tickets purchased yet.</p>
              <a href="homepage.php" class="mt-6 inline-block bg-violet-600 hover:bg-violet-500 text-white px-8 py-3 rounded-2xl">
                Browse Events
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    function showTab(n) {
      document.getElementById('content0').classList.toggle('hidden', n !== 0);
      document.getElementById('content1').classList.toggle('hidden', n !== 1);
      
      document.getElementById('tab0').classList.toggle('border-violet-500', n === 0);
      document.getElementById('tab0').classList.toggle('text-white', n === 0);
      document.getElementById('tab1').classList.toggle('border-violet-500', n === 1);
      document.getElementById('tab1').classList.toggle('text-white', n === 1);
    }

    // Upcoming Tickets
    const upcoming = [
      { title: "Coldplay World Tour", date: "July 5, 2026", location: "MOA Arena", price: "₱6,000" },
      { title: "PBA: Ginebra vs TNT", date: "May 15, 2026", location: "Smart Araneta", price: "₱800" }
    ];

    const container = document.getElementById("upcomingTickets");
    container.innerHTML = upcoming.map(t => `
      <div class="bg-zinc-900 border border-zinc-700 rounded-3xl p-6">
        <h4 class="font-semibold">${t.title}</h4>
        <p class="text-sm text-zinc-400">${t.date}</p>
        <p class="text-sm text-zinc-500">${t.location}</p>
        <p class="text-violet-400 font-bold mt-3">${t.price}</p>
      </div>
    `).join('');
  </script>

  <!-- Footer -->
  <footer class="border-t border-zinc-800 py-8 text-center text-zinc-600 text-sm">
    <p>© 2026 Absolute Cinema. All rights reserved.</p>
  </footer>
</body>
</html>