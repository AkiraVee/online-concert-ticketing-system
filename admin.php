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

// Fetch Orders with more details
$orders = mysqli_query($conn, "SELECT o.*, u.FullName, u.Email 
                               FROM ordertb o 
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

<nav class="border-b border-zinc-800 bg-zinc-900 py-4 sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
    <div class="flex items-center gap-3">
      <i class="fa-solid fa-ticket text-violet-400 text-2xl"></i>
      <span class="text-xl font-bold">Admin Dashboard</span>
    </div>
    <a href="logout.php" class="text-red-400 hover:text-red-500 flex items-center gap-2">
      <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>
  </div>
</nav>

<div class="max-w-7xl mx-auto px-6 py-10">
  <h1 class="text-4xl font-bold mb-8">Admin Overview</h1>

  <!-- Stats -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-zinc-900 border border-zinc-700 rounded-3xl p-6">
      <p class="text-zinc-500">Total Users</p>
      <p class="text-4xl font-bold"><?= mysqli_num_rows($users) ?></p>
    </div>
    <div class="bg-zinc-900 border border-zinc-700 rounded-3xl p-6">
      <p class="text-zinc-500">Total Orders</p>
      <p class="text-4xl font-bold"><?= mysqli_num_rows($orders) ?></p>
    </div>
    <div class="bg-zinc-900 border border-zinc-700 rounded-3xl p-6">
      <p class="text-zinc-500">Revenue</p>
      <?php 
        $revenueQuery = mysqli_query($conn, "SELECT SUM(TotalPrice) as total FROM ordertb");
        $revenue = mysqli_fetch_assoc($revenueQuery)['total'] ?? 0;
      ?>
      <p class="text-4xl font-bold text-emerald-400">₱<?= number_format($revenue) ?></p>
    </div>
  </div>

  <!-- Recent Orders - More Detailed -->
  <div class="mb-12">
    <h2 class="text-2xl font-semibold mb-6 flex items-center gap-3">
      <i class="fa-solid fa-ticket"></i> Recent Orders
    </h2>
    <div class="bg-zinc-900 border border-zinc-700 rounded-3xl overflow-hidden">
      <table class="w-full">
        <thead class="bg-zinc-800">
          <tr>
            <th class="px-6 py-4 text-left">Order ID</th>
            <th class="px-6 py-4 text-left">Customer</th>
            <th class="px-6 py-4 text-left">Event</th>
            <th class="px-6 py-4 text-left">Event Date</th>
            <th class="px-6 py-4 text-left">Seat / Tier</th>
            <th class="px-6 py-4 text-center">Qty</th>
            <th class="px-6 py-4 text-right">Total</th>
            <th class="px-6 py-4 text-center">Payment</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-zinc-700">
          <?php while($o = mysqli_fetch_assoc($orders)): ?>
          <tr class="hover:bg-zinc-800/50">
            <td class="px-6 py-4 font-mono text-sm">#<?= str_pad($o['TicketID'], 5, '0', STR_PAD_LEFT) ?></td>
            <td class="px-6 py-4">
              <div class="font-medium"><?= htmlspecialchars($o['FullName'] ?? 'N/A') ?></div>
              <div class="text-xs text-zinc-500"><?= htmlspecialchars($o['Email'] ?? '') ?></div>
            </td>
            <td class="px-6 py-4"><?= htmlspecialchars($o['EventTitle']) ?></td>
            <td class="px-6 py-4 text-sm"><?= $o['EventDate'] ?></td>
            <td class="px-6 py-4"><?= htmlspecialchars($o['SeatLocation']) ?></td>
            <td class="px-6 py-4 text-center"><?= $o['TicketQuantity'] ?></td>
            <td class="px-6 py-4 text-right font-semibold text-emerald-400">₱<?= number_format($o['TotalPrice']) ?></td>
            <td class="px-6 py-4 text-center">
              <span class="bg-emerald-600/80 text-white text-xs px-3 py-1 rounded-full">
                <?= htmlspecialchars($o['PaymentMethod']) ?>
              </span>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Users Table -->
  <div>
    <h2 class="text-2xl font-semibold mb-6">👥 All Users</h2>
    <div class="bg-zinc-900 border border-zinc-700 rounded-3xl overflow-hidden">
      <table class="w-full">
        <thead class="bg-zinc-800">
          <tr>
            <th class="px-6 py-4 text-left">User ID</th>
            <th class="px-6 py-4 text-left">Full Name</th>
            <th class="px-6 py-4 text-left">Email</th>
            <th class="px-6 py-4 text-center">Age</th>
            <th class="px-6 py-4 text-left">Contact</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-zinc-700">
          <?php while($u = mysqli_fetch_assoc($users)): ?>
          <tr class="hover:bg-zinc-800/50">
            <td class="px-6 py-4"><?= $u['UserID'] ?></td>
            <td class="px-6 py-4"><?= htmlspecialchars($u['FullName']) ?></td>
            <td class="px-6 py-4"><?= htmlspecialchars($u['Email']) ?></td>
            <td class="px-6 py-4 text-center"><?= $u['Age'] ?></td>
            <td class="px-6 py-4"><?= htmlspecialchars($u['ContactNumber'] ?? 'N/A') ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>