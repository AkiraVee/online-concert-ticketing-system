<?php
// event-details.php
include 'config.php'; // Your database connection

$event_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($event_id <= 0) {
    header("Location: index.html");
    exit;
}

// Fetch event data from database
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    // Fallback sample data if event not found
    $event = [
        'id' => $event_id,
        'title' => 'Taylor Swift | The Eras Tour',
        'description' => 'Join Taylor Swift for an unforgettable night of music spanning her entire career. This is a once-in-a-lifetime experience you don\'t want to miss!',
        'venue' => 'Philippine Arena, Bulacan',
        'main_image' => 'https://picsum.photos/id/1015/1200/600',
        'date' => 'May 20, 2026',
        'duration' => '3 hours 30 minutes'
    ];
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($event['title']) ?> | Ticketo</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    .ticket-type { transition: all 0.3s ease; }
    .ticket-type:hover { transform: translateY(-4px); }
  </style>
</head>
<body class="bg-gray-950 text-gray-200 font-sans">

  <!-- Navbar -->
  <nav class="bg-gray-900 border-b border-gray-800 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <a href="index.html" class="flex items-center gap-3 hover:text-white">
          <i class="fa-solid fa-ticket text-3xl text-indigo-500"></i>
          <h1 class="text-2xl font-bold text-white">Ticketo</h1>
        </a>
      </div>
      <a href="index.html" class="text-gray-400 hover:text-white flex items-center gap-2">
        ← Back to Events
      </a>
    </div>
  </nav>

  <!-- Hero Image -->
  <div class="relative h-96 md:h-[500px]">
    <img src="<?= htmlspecialchars($event['main_image'] ?? 'https://picsum.photos/id/1015/1200/600') ?>" 
         alt="<?= htmlspecialchars($event['title']) ?>" 
         class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/80 to-transparent"></div>
  </div>

  <div class="max-w-7xl mx-auto px-6 -mt-16 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

      <!-- Left Column - Main Info -->
      <div class="lg:col-span-2">
        <div class="bg-gray-900 rounded-3xl p-8 border border-gray-800">
          <h1 class="text-4xl font-bold text-white mb-3"><?= htmlspecialchars($event['title']) ?></h1>
          
          <div class="flex flex-wrap gap-6 text-gray-400 mb-8">
            <div class="flex items-center gap-3">
              <i class="fa-solid fa-calendar text-indigo-400"></i>
              <span><?= htmlspecialchars($event['date']) ?></span>
            </div>
            <div class="flex items-center gap-3">
              <i class="fa-solid fa-location-dot text-indigo-400"></i>
              <span><?= htmlspecialchars($event['venue']) ?></span>
            </div>
            <div class="flex items-center gap-3">
              <i class="fa-solid fa-clock text-indigo-400"></i>
              <span><?= htmlspecialchars($event['duration'] ?? '3h 30m') ?></span>
            </div>
          </div>

          <!-- Description -->
          <h3 class="text-xl font-semibold mb-4 text-white">About This Event</h3>
          <p class="text-gray-300 leading-relaxed text-lg">
            <?= nl2br(htmlspecialchars($event['description'])) ?>
          </p>
        </div>

        <!-- Ticket Types -->
        <div class="mt-10">
          <h3 class="text-2xl font-semibold mb-6 text-white">Ticket Options</h3>
          
          <div class="space-y-6" id="ticketTypes">
            <!-- Populated by JS or PHP loop -->
          </div>
        </div>
      </div>

      <!-- Right Column - Sidebar -->
      <div class="lg:col-span-1">
        <div class="bg-gray-900 rounded-3xl p-8 border border-gray-800 sticky top-8">
          <h4 class="font-semibold text-lg mb-6 text-white">Select Tickets</h4>
          
          <div id="selectedTicketInfo" class="mb-8">
            <!-- Dynamic content from selection -->
          </div>

          <button onclick="proceedToBuy()" 
                  class="w-full bg-indigo-600 hover:bg-indigo-500 py-5 rounded-2xl text-xl font-bold transition">
            Buy Tickets Now
          </button>

          <p class="text-center text-xs text-gray-500 mt-6">
            Secure checkout • Instant ticket delivery
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- More Images / Gallery (optional) -->
  <div class="max-w-7xl mx-auto px-6 py-16">
    <h3 class="text-2xl font-semibold mb-6">Gallery</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <img src="https://picsum.photos/id/1015/400/250" class="rounded-2xl">
      <img src="https://picsum.photos/id/870/400/250" class="rounded-2xl">
      <img src="https://picsum.photos/id/201/400/250" class="rounded-2xl">
      <img src="https://picsum.photos/id/237/400/250" class="rounded-2xl">
    </div>
  </div>

  <script>
    // Sample ticket types (in real app, fetch from PHP/JSON)
    const ticketTypes = [
      {
        id: 1,
        name: "VIP Standing",
        price: 6500,
        available: 245,
        color: "bg-amber-500"
      },
      {
        id: 2,
        name: "Lower Box",
        price: 4500,
        available: 1200,
        color: "bg-blue-500"
      },
      {
        id: 3,
        name: "Upper Box A",
        price: 2800,
        available: