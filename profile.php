<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

include('mysql-connect.php');

$userID = $_SESSION['UserID'];

// ====================== HANDLE PROFILE UPDATE ======================
if (isset($_POST['update_profile'])) {
    $fullName   = trim($_POST['fullName']);
    $email      = trim($_POST['email']);
    $contact    = trim($_POST['contact']);
    $birthdate  = $_POST['birthdate'];

    if (!empty($fullName) && !empty($email)) {
        $stmt = $conn->prepare("UPDATE usertb SET FullName=?, Email=?, ContactNumber=?, Birthdate=? WHERE UserID=?");
        $stmt->bind_param("ssssi", $fullName, $email, $contact, $birthdate, $userID);
        
        if ($stmt->execute()) {
            $success = "Profile updated successfully!";
        } else {
            $error = "Failed to update profile. Please try again.";
        }
        $stmt->close();
    } else {
        $error = "Full Name and Email are required.";
    }
}

// ====================== FETCH USER DATA ======================
$stmt = $conn->prepare("SELECT FullName, Email, Birthdate, Age, ContactNumber FROM usertb WHERE UserID = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch user's tickets
$stmt = $conn->prepare("SELECT * FROM ordertb WHERE UserID = ? ORDER BY PurchaseDate DESC, TicketID DESC");
$stmt->bind_param("i", $userID);
$stmt->execute();
$ticketsResult = $stmt->get_result();
$tickets = $ticketsResult->fetch_all(MYSQLI_ASSOC);

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

  <!-- Navigation -->
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
              <span class="text-violet-400 font-medium"><?= count($tickets) ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-zinc-500">Contact</span>
              <span class="text-zinc-300"><?= htmlspecialchars($user['ContactNumber'] ?? '--') ?></span>
            </div>
            <div class="flex justify-between">
              <span class="text-zinc-500">Birthdate</span>
              <span class="text-zinc-300"><?= htmlspecialchars($user['Birthdate'] ?? '--') ?></span>
            </div>

            <button onclick="openEditModal()" 
              class="w-full mt-6 bg-violet-600 hover:bg-violet-500 text-white px-5 py-3 rounded-2xl text-sm font-medium transition">
              ✏️ Edit Profile
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
            <i class="fa-solid fa-clock-rotate-left"></i> My Tickets
          </button>
        </div>

        <!-- Tab 0: Upcoming Tickets -->
        <div id="content0">
          <h3 class="text-xl font-semibold mb-6 flex items-center gap-3">
            <i class="fa-solid fa-ticket text-violet-400"></i> Upcoming Tickets
          </h3>
          <div id="upcomingTickets" class="grid grid-cols-1 md:grid-cols-2 gap-5"></div>
        </div>

        <!-- Tab 1: My Purchased Tickets -->
        <div id="content1" class="hidden">
          <h3 class="text-xl font-semibold mb-6 flex items-center gap-3">
            <i class="fa-solid fa-clock-rotate-left text-emerald-400"></i> My Purchased Tickets
          </h3>

          <?php if (count($tickets) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <?php foreach ($tickets as $ticket): ?>
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
                      <button 
                        onclick="openTicketModal(
                          '<?= htmlspecialchars($ticket['EventTitle']) ?>',
                          '<?= htmlspecialchars($ticket['EventDate']) ?>',
                          '<?= htmlspecialchars($ticket['EventLocation']) ?>',
                          '<?= htmlspecialchars($ticket['SeatLocation']) ?>',
                          '<?= htmlspecialchars($ticket['TicketQuantity']) ?>',
                          '<?= htmlspecialchars(number_format($ticket['TotalPrice'])) ?>',
                          '<?= htmlspecialchars($ticket['TicketID']) ?>'
                        )"
                        class="bg-violet-600 hover:bg-violet-500 text-white px-5 py-2 rounded-xl text-sm">
                        View Ticket
                      </button>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-12 text-center">
              <i class="fa-solid fa-ticket text-6xl text-zinc-600 mb-4"></i>
              <p class="text-zinc-400">No tickets purchased yet.</p>
              <a href="index.php" class="mt-6 inline-block bg-violet-600 hover:bg-violet-500 text-white px-8 py-3 rounded-2xl">
                Browse Events
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- ====================== VIEW TICKET MODAL ====================== -->
<div id="ticketModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-[100]">
  <div class="bg-zinc-900 border border-zinc-700 rounded-3xl w-full max-w-lg mx-4 overflow-hidden">

    <!-- Header -->
    <div class="bg-gradient-to-r from-violet-600 to-fuchsia-600 p-6 text-white">
      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-2xl font-bold">🎟️ Event Ticket</h2>
          <p class="text-sm text-white/80">Absolute Cinema</p>
        </div>

        <button onclick="closeTicketModal()" class="text-white text-xl hover:opacity-70">
          <i class="fa-solid fa-xmark"></i>
        </button>
      </div>
    </div>

    <!-- Body -->
    <div class="p-8">

      <div class="space-y-5">

        <div>
          <p class="text-zinc-500 text-sm">Event</p>
          <h3 id="ticketEvent" class="text-2xl font-semibold text-white"></h3>
        </div>

        <div class="grid grid-cols-2 gap-5">

          <div class="bg-zinc-800 rounded-2xl p-4">
            <p class="text-zinc-500 text-sm">Date</p>
            <p id="ticketDate" class="text-white mt-1"></p>
          </div>

          <div class="bg-zinc-800 rounded-2xl p-4">
            <p class="text-zinc-500 text-sm">Location</p>
            <p id="ticketLocation" class="text-white mt-1"></p>
          </div>

          <div class="bg-zinc-800 rounded-2xl p-4">
            <p class="text-zinc-500 text-sm">Seat Tier</p>
            <p id="ticketTier" class="text-white mt-1"></p>
          </div>

          <div class="bg-zinc-800 rounded-2xl p-4">
            <p class="text-zinc-500 text-sm">Quantity</p>
            <p id="ticketQuantity" class="text-white mt-1"></p>
          </div>

        </div>

        <div class="border-t border-dashed border-zinc-700 pt-6 flex justify-between items-center">
          <div>
            <p class="text-zinc-500 text-sm">Ticket ID</p>
            <p id="ticketID" class="text-violet-400 font-semibold"></p>
          </div>

          <div class="text-right">
            <p class="text-zinc-500 text-sm">Total Paid</p>
            <p id="ticketPrice" class="text-2xl font-bold text-emerald-400"></p>
          </div>
        </div>

        <div class="bg-emerald-500/10 border border-emerald-500 rounded-2xl p-4 text-center">
          <p class="text-emerald-400 font-medium">
            ✅ Payment Confirmed
          </p>
        </div>

      </div>

    </div>

  </div>
</div>



  <!-- ====================== EDIT PROFILE MODAL ====================== -->
  <div id="editModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-[100]">
    <div class="bg-zinc-900 border border-zinc-700 rounded-3xl w-full max-w-md mx-4 overflow-hidden">
      <div class="p-8">
        <h2 class="text-2xl font-semibold text-white mb-6">Edit Profile</h2>

        <?php if (isset($success)): ?>
          <div class="bg-green-500/10 border border-green-500 text-green-400 p-4 rounded-2xl mb-6">
            <?= $success ?>
          </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
          <div class="bg-red-500/10 border border-red-500 text-red-400 p-4 rounded-2xl mb-6">
            <?= $error ?>
          </div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
          <div>
            <label class="block text-zinc-400 text-sm mb-1">Full Name</label>
            <input type="text" name="fullName" value="<?= htmlspecialchars($user['FullName'] ?? '') ?>" 
                   class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-4 py-3 focus:outline-none focus:border-violet-500" required>
          </div>

          <div>
            <label class="block text-zinc-400 text-sm mb-1">Email Address</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['Email'] ?? '') ?>" 
                   class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-4 py-3 focus:outline-none focus:border-violet-500" required>
          </div>

          <div>
            <label class="block text-zinc-400 text-sm mb-1">Contact Number</label>
            <input type="text" name="contact" value="<?= htmlspecialchars($user['ContactNumber'] ?? '') ?>" 
                   class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-4 py-3 focus:outline-none focus:border-violet-500">
          </div>

          <div>
            <label class="block text-zinc-400 text-sm mb-1">Birthdate</label>
            <input type="date" name="birthdate" value="<?= htmlspecialchars($user['Birthdate'] ?? '') ?>" 
                   class="w-full bg-zinc-800 border border-zinc-700 rounded-2xl px-4 py-3 focus:outline-none focus:border-violet-500">
          </div>

          <div class="flex gap-4 pt-6">
            <button type="button" onclick="closeEditModal()" 
              class="flex-1 py-3 rounded-2xl border border-zinc-700 hover:bg-zinc-800 transition">
              Cancel
            </button>
            <button type="submit" name="update_profile" 
              class="flex-1 py-3 bg-violet-600 hover:bg-violet-500 rounded-2xl transition">
              Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    
          // ====================== VIEW TICKET MODAL ======================

      function openTicketModal(title, date, location, tier, quantity, price, id) {

        document.getElementById('ticketEvent').innerText = title;
        document.getElementById('ticketDate').innerText = date;
        document.getElementById('ticketLocation').innerText = location;
        document.getElementById('ticketTier').innerText = tier;
        document.getElementById('ticketQuantity').innerText = quantity + ' ticket(s)';
        document.getElementById('ticketPrice').innerText = '₱' + price;
        document.getElementById('ticketID').innerText = '#' + id;

        document.getElementById('ticketModal').classList.remove('hidden');
      }

      function closeTicketModal() {
        document.getElementById('ticketModal').classList.add('hidden');
      }

      // Close ticket modal when clicking outside
      document.getElementById('ticketModal').addEventListener('click', function(e) {
        if (e.target === this) closeTicketModal();
      });
          
    function showTab(n) {
      document.getElementById('content0').classList.toggle('hidden', n !== 0);
      document.getElementById('content1').classList.toggle('hidden', n !== 1);
      
      document.getElementById('tab0').classList.toggle('border-violet-500', n === 0);
      document.getElementById('tab0').classList.toggle('text-white', n === 0);
      document.getElementById('tab0').classList.toggle('text-zinc-400', n !== 0);
      
      document.getElementById('tab1').classList.toggle('border-violet-500', n === 1);
      document.getElementById('tab1').classList.toggle('text-white', n === 1);
      document.getElementById('tab1').classList.toggle('text-zinc-400', n !== 1);
    }

    // Edit Modal Functions
    function openEditModal() {
      document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
      document.getElementById('editModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('editModal').addEventListener('click', function(e) {
      if (e.target === this) closeEditModal();
    });

    // Upcoming Tickets (Hardcoded for now)
    const upcoming = [
      { title: "Coldplay World Tour", date: "July 5, 2026", location: "MOA Arena", price: "₱6,000" },
      { title: "PBA: Ginebra vs TNT", date: "May 15, 2026", location: "Smart Araneta", price: "₱800" }
    ];

    const container = document.getElementById("upcomingTickets");
    container.innerHTML = upcoming.map(t => `
      <div class="bg-zinc-900 border border-zinc-700 rounded-3xl p-6">
        <h4 class="font-semibold">${t.title}</h4>
        <p class="text-sm text-zinc-400 mt-1">${t.date}</p>
        <p class="text-sm text-zinc-500">${t.location}</p>
        <p class="text-violet-400 font-bold mt-4">${t.price}</p>
      </div>
    `).join('');
  </script>

  <!-- Footer -->
  <footer class="border-t border-zinc-800 py-8 text-center text-zinc-600 text-sm">
    <p>© 2026 Absolute Cinema. All rights reserved.</p>
  </footer>
</body>
</html>