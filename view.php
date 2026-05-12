<?php
session_start();

// Auth guard - redirect to login if not logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

// Fetch user data from DB
include('mysql-connect.php');

$userID = $_SESSION['UserID'];
$userQuery = "SELECT FullName, Email FROM usertb WHERE UserID='$userID'";
$userResult = mysqli_query($conn, $userQuery);
$user = mysqli_fetch_assoc($userResult);

// Fetch all tickets for the user
$ticketsQuery = "SELECT * FROM ordertb WHERE TicketID='$userID' ORDER BY PurchaseDate DESC, TicketID DESC";
$ticketsResult = mysqli_query($conn, $ticketsQuery);

$fullName = $user['FullName'] ?? 'Unknown';
$email = $user['Email'] ?? '';

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Tickets - Absolute Cinema</title>
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
        <a href="index.php" class="hover:text-white">Home</a>
        <a href="logout.php" class="text-red-400 hover:text-red-500 flex items-center gap-2">
          <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
      </div>
    </div>
  </nav>

  <!-- Tickets Content -->
  <div class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row gap-10">

      <!-- Sidebar -->
      <div class="md:w-80 flex-shrink-0">
        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 text-center">
          <div class="w-28 h-28 mx-auto rounded-2xl bg-gradient-to-br from-violet-500 to-fuchsia-500 flex items-center justify-center text-5xl mb-6">
            👤
          </div>
          <h2 class="text-2xl font-semibold text-white mb-1"><?= htmlspecialchars($fullName) ?></h2>
          <p class="text-zinc-400"><?= htmlspecialchars($email) ?></p>

          <div class="mt-8 pt-6 border-t border-zinc-800 text-left space-y-4 text-sm">
            <div class="flex justify-between">
              <span class="text-zinc-500">Total Tickets</span>
              <span class="text-violet-400 font-medium"><?= mysqli_num_rows($ticketsResult) ?></span>
            </div>
          </div>

          <a href="profile.php"
            class="mt-8 w-full border border-zinc-700 hover:border-violet-500 text-white py-3 rounded-2xl transition-colors inline-block text-center">
            Back to Profile
          </a>
        </div>
      </div>

      <!-- Main Content -->
      <div class="flex-1">
        <h1 class="text-4xl text-white mb-8">My Tickets</h1>

        <!-- Tabs Navigation -->
        <div class="flex gap-6 border-b border-zinc-800 mb-8">
          <a href="profile.php"
            class="pb-4 text-zinc-400 hover:text-white border-b-2 border-transparent transition-colors flex items-center gap-2">
            <i class="fa-solid fa-ticket text-violet-400"></i> Upcoming Tickets
          </a>
          <a href="view.php"
            class="pb-4 text-white border-b-2 border-violet-500 font-medium flex items-center gap-2">
            <i class="fa-solid fa-ticket"></i> View My Tickets
          </a>
        </div>

        <!-- Tickets Display -->
        <div>
          <?php if (mysqli_num_rows($ticketsResult) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <?php while ($ticket = mysqli_fetch_assoc($ticketsResult)): ?>
                <div class="bg-zinc-900 border border-zinc-700 rounded-3xl overflow-hidden hover:border-violet-500 transition-colors">
                  <div class="bg-gradient-to-br from-violet-500 to-fuchsia-500 h-32 flex items-center justify-center">
                    <i class="fa-solid fa-ticket text-white text-5xl opacity-20"></i>
                  </div>
                  <div class="p-6">
                    <h4 class="font-semibold text-white text-lg mb-1"><?= htmlspecialchars($ticket['EventTitle'] ?? 'Event') ?></h4>
                    <p class="text-sm text-zinc-400 mb-4">
                      <i class="fa-solid fa-calendar mr-2"></i><?= $ticket['EventDate'] ?? 'N/A' ?>
                    </p>
                    <p class="text-sm text-zinc-400 mb-4">
                      <i class="fa-solid fa-location-dot mr-2"></i><?= htmlspecialchars($ticket['EventLocation'] ?? 'N/A') ?>
                    </p>
                    <div class="border-t border-zinc-800 pt-4 mt-4">
                      <div class="flex justify-between items-center mb-3">
                        <span class="text-zinc-500 text-sm">Ticket ID</span>
                        <span class="text-white font-mono text-sm"><?= htmlspecialchars($ticket['TicketID'] ?? 'N/A') ?></span>
                      </div>
                      <div class="flex justify-between items-center mb-3">
                        <span class="text-zinc-500 text-sm">Quantity</span>
                        <span class="text-white text-sm"><?= $ticket['TicketQuantity'] ?? 'N/A' ?> ticket(s)</span>
                      </div>
                      <div class="flex justify-between items-center">
                        <span class="text-zinc-500 text-sm">Status</span>
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-emerald-500/20 text-emerald-300">
                          Valid
                        </span>
                      </div>
                    </div>
                    <button onclick="downloadTicket('<?= htmlspecialchars($ticket['TicketID'] ?? '') ?>')"
                      class="mt-5 w-full bg-violet-600 hover:bg-violet-500 text-white py-2.5 rounded-xl transition-colors flex items-center justify-center gap-2 text-sm font-medium">
                      <i class="fa-solid fa-download"></i> Download Ticket
                    </button>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          <?php else: ?>
            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-12 text-center">
              <i class="fa-solid fa-ticket text-zinc-600 text-5xl mb-4"></i>
              <h3 class="text-xl font-semibold text-white mb-2">No Tickets Found</h3>
              <p class="text-zinc-400 mb-6">You haven't purchased any tickets yet.</p>
              <a href="index.php"
                class="inline-block bg-violet-600 hover:bg-violet-500 text-white px-6 py-3 rounded-xl transition-colors">
                Browse Events
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="border-t border-zinc-800 py-8 text-center text-zinc-600 text-sm mt-12">
    <p>© 2026 Absolute Cinema. All rights reserved.</p>
  </footer>

  <script>
    function downloadTicket(ticketID) {
      alert(`Downloading ticket ${ticketID}... (Feature coming soon)`);
    }
  </script>
</body>
</html>
