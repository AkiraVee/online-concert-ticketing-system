<?php
// payment-success.php

session_start();

// Get all data from URL parameters
$eventTitle     = isset($_GET['eventTitle']) ? htmlspecialchars($_GET['eventTitle']) : 'Untitled Event';
$eventDate      = isset($_GET['date']) ? htmlspecialchars($_GET['date']) : 'Date not available';
$eventLocation  = isset($_GET['location']) ? htmlspecialchars($_GET['location']) : 'Location not available';
$tier           = isset($_GET['tier']) ? htmlspecialchars($_GET['tier']) : 'General Admission';
$quantity       = max(1, (int)($_GET['quantity'] ?? 1));
$total          = max(0, (int)($_GET['total'] ?? 0));
$paymentMethod  = isset($_GET['paymentMethod']) ? htmlspecialchars($_GET['paymentMethod']) : 'GCash';
$transactionPin = isset($_GET['transactionPin']) ? htmlspecialchars($_GET['transactionPin']) : 'N/A';

// Calculations
$subtotal       = $total;
$serviceFee     = round($subtotal * 0.08);
$grandTotal     = $subtotal + $serviceFee;

// Generate Order ID
$orderID = "AC-" . date("Y") . "-" . rand(10000, 99999);

// Save order to DB
if (isset($_SESSION['UserID'])) {
    include('mysql-connect.php');

    $userID = $_SESSION['UserID'];
    $rawDate = $_GET['date'] ?? '';
    $parsedDate = date('Y-m-d', strtotime($rawDate));

 $insertQuery = "insert into ordertb (TicketID, EventDate, SeatLocation, TicketQuantity, TotalPrice, TransactionPin, PurchaseDate)
            values ($userID, '$parsedDate', '$tier', '$quantity', '$grandTotal', '$transactionPin', NOW())";

    @mysqli_query($conn, $insertQuery);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Successful - Absolute Cinema</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Serif+Display&display=swap');
    body { font-family: 'DM Sans', sans-serif; }
    .serif { font-family: 'DM Serif Display', serif; }
  </style>
</head>
<body class="bg-zinc-950 text-zinc-300 min-h-screen">

  <!-- Nav -->
  <nav class="border-b border-zinc-800 sticky top-0 z-50 bg-zinc-950/90 backdrop-blur">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-2 text-white">
        <i class="fa-solid fa-ticket text-violet-400 text-xl"></i>
        <span class="text-lg font-semibold tracking-tight">Absolute Cinema</span>
      </div>
      <a href="homepage.php" class="text-sm text-zinc-400 hover:text-white">← Back to Home</a>
    </div>
  </nav>

  <div class="max-w-2xl mx-auto px-6 py-16 text-center">
    <div class="inline-flex items-center justify-center w-24 h-24 bg-emerald-500/10 rounded-full mb-6">
      <i class="fa-solid fa-circle-check text-emerald-500 text-6xl"></i>
    </div>
    
    <h1 class="serif text-5xl text-white mb-2">Payment Successful!</h1>
    <p class="text-emerald-400 text-lg font-medium">Your tickets have been confirmed</p>

    <div class="mt-12 bg-zinc-900 border border-zinc-700 rounded-3xl p-8 text-left">
      
      <div class="space-y-6">
        <!-- Event Info -->
        <div class="flex justify-between items-center pb-6 border-b border-zinc-700">
          <div class="text-left">
            <h2 class="text-white text-2xl serif"><?= $eventTitle ?></h2>
            <p class="text-zinc-400 mt-1"><?= $eventDate ?></p>
          </div>
          <span class="text-emerald-400 font-medium flex items-center gap-1">
            <i class="fa-solid fa-check-circle"></i> Confirmed
          </span>
        </div>

        <!-- Details Grid -->
        <div class="pt-6 grid grid-cols-2 gap-y-5 text-sm">
          <div>
            <p class="text-zinc-500">Location</p>
            <p class="text-white"><?= $eventLocation ?></p>
          </div>
          <div>
            <p class="text-zinc-500">Section / Tier</p>
            <p class="text-white"><?= $tier ?></p>
          </div>
          <div>
            <p class="text-zinc-500">Quantity</p>
            <p class="text-white"><?= $quantity ?> Ticket<?= $quantity > 1 ? 's' : '' ?></p>
          </div>
          <div>
            <p class="text-zinc-500">Payment Method</p>
            <p class="text-white"><?= $paymentMethod ?></p>
          </div>
        </div>

        <!-- Price Summary -->
        <div class="mt-8 pt-6 border-t border-zinc-700">
          <div class="flex justify-between text-zinc-400 mb-2">
            <span>Subtotal</span>
            <span>₱<?= number_format($subtotal) ?></span>
          </div>
          <div class="flex justify-between text-zinc-400 mb-2">
            <span>Service Fee</span>
            <span>₱<?= number_format($serviceFee) ?></span>
          </div>
          <div class="flex justify-between text-xl font-bold text-white pt-4 border-t border-zinc-700">
            <span>Total Paid</span>
            <span class="text-violet-400">₱<?= number_format($grandTotal) ?></span>
          </div>
        </div>
      </div>

      <!-- QR Code -->
      <div class="mt-10 flex justify-center">
        <div class="bg-white p-5 rounded-2xl shadow-inner">
          <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=<?= urlencode($orderID) ?>" 
               alt="QR Code" class="w-48 h-48">
        </div>
      </div>
      <p class="text-center text-zinc-500 text-sm mt-3">Present this QR code at the venue entrance</p>

      <div class="mt-10 pt-6 border-t border-zinc-700 text-center">
        <p class="text-xs text-zinc-500">Order ID: <span class="text-white font-mono">#<?= $orderID ?></span></p>
      </div>
    </div>

    <div class="flex flex-col sm:flex-row gap-4 mt-10">
      <a href="profile.php" 
         class="flex-1 bg-violet-600 hover:bg-violet-500 text-white py-4 rounded-2xl font-semibold transition-colors">
        View My Tickets
      </a>
      <button onclick="downloadTickets()" 
        class="flex-1 border border-zinc-700 hover:border-zinc-500 py-4 rounded-2xl font-semibold transition-colors">
        Download Tickets (PDF)
      </button>
    </div>

    <p class="text-zinc-500 text-sm mt-12">
      A detailed receipt has been sent to your email.<br>
      Thank you for choosing Absolute Cinema!
    </p>
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
    function downloadTickets() {
      alert("🎟️ Downloading your tickets as PDF...\nOrder ID: #<?= $orderID ?> (Demo)");
    }
  </script>
</body>
</html>