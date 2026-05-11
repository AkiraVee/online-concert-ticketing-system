<?php
// admin.php
session_start();

if (!isset($_SESSION['admin_logged_in']) && !isset($_SESSION['is_admin'])) {
    header("Location: admin-login.php");
    exit();
}

include('mysql-connect.php');

// Fetch Users
$users = mysqli_query($conn, "SELECT * FROM usertb ORDER BY UserID DESC");

// Fetch Orders
$orders = mysqli_query($conn, "SELECT o.*, u.FullName FROM ordertb o 
                               LEFT JOIN usertb u ON o.UserID = u.UserID 
                               ORDER BY o.TicketID DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Absolute Cinema</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body class="bg-zinc-950 text-zinc-300">

<nav class="border-b border-zinc-800 bg-zinc-900 py-4">
  <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <i class="fa-solid fa-ticket text-violet-400 text-2xl"></i>
      <span class="text-xl font-bold">Admin Dashboard</span>
    </div>
    <a href="logout.php" class="text-red-400 hover:text-red-500">Logout</a>
  </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-10">
  <h1 class="text-4xl font-bold mb-10">Dashboard</h1>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Users -->
    <div>
      <h2 class="text-2xl mb-4">👥 Users</h2>
      <div class="bg-zinc-900 rounded-3xl overflow-hidden border border-zinc-700">
        <table class="w-full">
          <thead class="bg-zinc-800">
            <tr>
              <th class="px-6 py-4 text-left">Name</th>
              <th class="px-6 py-4 text-left">Email</th>
              <th class="px-6 py-4 text-center">Age</th>
            </tr>
          </thead>
          <tbody>
            <?php while($u = mysqli_fetch_assoc($users)): ?>
            <tr class="border-t border-zinc-700">
              <td class="px-6 py-4"><?= htmlspecialchars($u['FullName']) ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($u['Email']) ?></td>
              <td class="px-6 py-4 text-center"><?= $u['Age'] ?></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Orders -->
    <div>
      <h2 class="text-2xl mb-4">🎟️ Recent Orders</h2>
      <div class="bg-zinc-900 rounded-3xl overflow-hidden border border-zinc-700">
        <table class="w-full">
          <thead class="bg-zinc-800">
            <tr>
              <th class="px-6 py-4 text-left">Event</th>
              <th class="px-6 py-4 text-left">Customer</th>
              <th class="px-6 py-4 text-right">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php while($o = mysqli_fetch_assoc($orders)): ?>
            <tr class="border-t border-zinc-700">
              <td class="px-6 py-4"><?= htmlspecialchars($o['EventTitle']) ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($o['FullName'] ?? 'N/A') ?></td>
              <td class="px-6 py-4 text-right font-semibold">₱<?= number_format($o['TotalPrice']) ?></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

</body>
</html>