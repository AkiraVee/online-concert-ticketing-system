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
                 WHERE TicketID = '$userID' 
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
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="flex-1">
        <h1 class="text-4xl text-white mb-8">My Profile</h1>

        <!-- Tabs Navigation -->
        <div class="flex gap-6 border-b border-zinc-800 mb-8">
          <a href="profile.php"
            class="pb-4 text-white border-b-2 border-violet-500 font-medium flex items-center gap-2">
            <i class="fa-solid fa-ticket text-violet-400"></i> Upcoming Tickets
          </a>
          <a href="view.php"
            class="pb-4 text-zinc-400 hover:text-white border-b-2 border-transparent transition-colors flex items-center gap-2">
            <i class="fa-solid fa-ticket"></i> View My Tickets
          </a>
        </div>

        <!-- Upcoming Tickets -->
        <div>
          <h3 class="text-xl font-semibold mb-6 flex items-center gap-3">
            <i class="fa-solid fa-ticket text-violet-400"></i> Upcoming Tickets
          </h3>
          <div id="upcomingTickets" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <!-- Populated by JS -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const upcoming = [
      {
        title: "Coldplay World Tour",
        date: "July 5, 2026",
        location: "MOA Arena, Pasay",
        price: "₱6,000",
        image: "https://picsum.photos/id/870/400/250",
      },
      {
        title: "PBA: Ginebra vs TNT",
        date: "May 15, 2026",
        location: "Smart Araneta Coliseum",
        price: "₱800",
        image: "https://picsum.photos/id/201/400/250",
      },
    ];

    const container = document.getElementById("upcomingTickets");
    container.innerHTML = upcoming.map(ticket => `
      <div class="card bg-zinc-900 border border-zinc-800 rounded-3xl overflow-hidden">
        <img src="${ticket.image}" class="w-full h-40 object-cover">
        <div class="p-5">
          <h4 class="font-semibold leading-tight mb-2">${ticket.title}</h4>
          <p class="text-xs text-zinc-500 mb-4">${ticket.date} • ${ticket.location}</p>
          <div class="flex justify-between items-center">
            <span class="text-violet-400 font-semibold">${ticket.price}</span>
            <button onclick="viewTicket()"
              class="text-xs bg-violet-600 hover:bg-violet-500 px-5 py-2 rounded-xl">View Ticket</button>
          </div>
        </div>
      </div>
    `).join("");

    function viewTicket() {
      alert("Ticket details would open here (Demo)");
    }
  </script>

  <!-- Footer -->
  <footer class="border-t border-zinc-800 py-8 text-center text-zinc-600 text-sm">
    <p>© 2026 Absolute Cinema. All rights reserved.</p>
  </footer>
</body>
</html>