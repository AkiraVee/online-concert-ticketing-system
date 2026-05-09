<?php
// event-details.php
$eventId = isset($_GET['eventId']) ? (int)$_GET['eventId'] : 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Event Details — Absolute Cinema</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body class="bg-zinc-950 text-zinc-300 min-h-screen">

  <!-- Nav -->
  <nav class="border-b border-zinc-800 sticky top-0 z-50 bg-zinc-950/90 backdrop-blur">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center gap-4">
      <a href="homepage.php" 
         class="flex items-center gap-2 text-white hover:text-violet-400 transition-colors">
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

  <!-- Content -->
  <div id="pageContent" class="fade-in"></div>

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
        <span id="nameError" class="hidden text-red-500 text-xs mt-1 block"></span>
      </div>

      <div class="mb-5">
        <label class="block text-xs text-zinc-400 mb-1.5 font-medium uppercase tracking-wide">Email</label>
        <input type="email" id="modalEmail" placeholder="juan@example.com"
          class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-white text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500">
        <span id="emailError" class="hidden text-red-500 text-xs mt-1 block"></span>
      </div>

      <div class="mb-6">
        <label class="block text-xs text-zinc-400 mb-1.5 font-medium uppercase tracking-wide">Payment Method</label>
        <div class="grid grid-cols-3 gap-2">
          <button onclick="selectPayment(this)" class="pay-btn border border-zinc-700 rounded-xl py-2 text-xs text-zinc-400 hover:border-violet-500 hover:text-white transition-all">GCash</button>
          <button onclick="selectPayment(this)" class="pay-btn border border-zinc-700 rounded-xl py-2 text-xs text-zinc-400 hover:border-violet-500 hover:text-white transition-all">Maya</button>
          <button onclick="selectPayment(this)" class="pay-btn border border-zinc-700 rounded-xl py-2 text-xs text-zinc-400 hover:border-violet-500 hover:text-white transition-all">Card</button>
        </div>
      </div>

      <span id="paymentError" class="hidden text-red-500 text-xs mt-1 block"></span>

      <button onclick="submitOrder()" 
        class="w-full bg-violet-600 hover:bg-violet-500 text-white py-3 rounded-xl font-semibold text-sm">
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
    // Full Event Data (same as before)
    const events = { 
      1: {
        "id": 1,
        "title": "Taylor Swift | The Eras Tour",
        "category": "concert",
        "type": "Concert",
        "date": "May 20, 2026",
        "location": "Philippine Arena, Bulacan",
        "price": "₱3,500",
        "images": [
            "https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/88477c99-c357-4758-a37e-b1b750215b2f/compose?aspectRatio=1.78&format=webp&width=1200",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
        "description": "The most spectacular tour of the decade returns to the Philippines. Taylor Swift brings all her eras to life in one unforgettable night.",
        "dates": [
          { label: "Sat, May 16", time: "6:00 PM" },
          { label: "Sun, May 17", time: "5:30 PM" },
          { label: "Fri, May 20", time: "7:00 PM" },
        ],
        "tiers": [
          {
              name: "VIP PIT",
              price: 26000,
              status: "Seated/Standing",
              available: 5000,
              color: "violet",
            },
            {
              name: "Floor Standing",
              price: 19500,
              status: "General Admission",
              available: 8000,
              color: "violet",
            },
            {
              name: "LBA Lower Box A Premium",
              price: 18500,
              status: "Reserved Seating",
              available: 4500,
              color: "blue",
            },
            {
              name: "LBA Lower Box A Regular",
              price: 16500,
              status: "Reserved Seating",
              available: 6000,
              color: "blue",
            },
            {
              name: "LBB Lower Box B Premium",
              price: 15500,
              status: "Reserved Seating",
              available: 5500,
              color: "blue",
            },
            {
              name: "LBB Lower Box B Regular",
              price: 13500,
              status: "Reserved Seating",
              available: 7000,
              color: "blue",
            },
            {
              name: "UBA Upper Box A Premium",
              price: 11000,
              status: "Reserved Seating",
              available: 6000,
              color: "zinc",
            },
            {
              name: "UBB Upper Box B Premium",
              price: 9000,
              status: "Reserved Seating",
              available: 4000,
              color: "zinc",
            },
            {
              name: "UBB Upper Box B Sides",
              price: 7500,
              status: "Reserved Seating",
              available: 2500,
              color: "zinc",
            },
            {
              name: "UBB Upper Box B Regular",
              price: 6000,
              status: "Reserved Seating",
              available: 4000,
              color: "zinc",
            },
            {
              name: "UBC Upper Box C Premium",
              price: 5000,
              status: "Reserved Seating",
              available: 3000,
              color: "zinc",
            },
            {
              name: "UBC Upper Box C Regular",
              price: 3500,
              status: "Reserved Seating",
              available: 1500,
              color: "zinc",
            },
        ],
      },
      2: {
        "id": 2,
        "title": "PBA: Ginebra vs TNT",
        "category": "sports",
        "type": "Sports",
        "date": "May 15, 2026",
        "location": "Smart Araneta Coliseum",
        "price": "₱500",
        "images": [
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToBiCMqMOD48wLnF7cLJWIty31xw8Dmf3gOw&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
          "description": "Barangay Ginebra faces off against the TNT Tropang Giga in a highly anticipated PBA clash. Don't miss the action!",
        "dates": [
          { label: "Wed, May 15", time: "7:00 PM" },
          { label: "Sat, May 18", time: "4:00 PM" },
        ],
        "tiers": [
          {
              name: "SEATED VIP",
              price: 3300,
              status: "Reserved Seating",
              available: 150,
              color: "violet",
            },
            {
              name: "PATRON A",
              price: 1000,
              status: "Reserved Seating",
              available: 800,
              color: "violet",
            },
            {
              name: "PATRON B",
              price: 950,
              status: "Reserved Seating",
              available: 1200,
              color: "violet",
            },
            {
              name: "PATRON C",
              price: 900,
              status: "Reserved Seating",
              available: 1500,
              color: "violet",
            },
            {
              name: "LOWER BOX A",
              price: 600,
              status: "Reserved Seating",
              available: 2000,
              color: "blue",
            },
            {
              name: "LOWER BOX B",
              price: 500,
              status: "Reserved Seating",
              available: 2500,
              color: "blue",
            },
          ],
        },
        
      3: {
        "id": 3,
        "title": "Miss Saigon - Manila",
        "category": "theatre",
        "type": "Theatre",
        "date": "June 10, 2026",
        "location": "Newport Performing Arts Theater",
        "price": "₱2,200",
        "images": [
            "https://theaterfansmanila.com/wp-content/uploads/2023/10/Miss-Saigon-feat-pic.jpg",
            "https://deadline.com/wp-content/uploads/2019/07/miss-saigon.jpg?w=1000",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBTUuVJH8ovV-Qzn48k8NFv41p7nLmAHJk5g&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRKzX1SR_ebc2cByW5MRSuB69z53MF-H8bMcg&shttps://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
          "description": "The legendary West End and Broadway musical comes to Manila. A timeless story of love and war set in the final days of the Vietnam War.",
        "dates": [
          { label: "Tue, Jun 10", time: "8:00 PM" },
          { label: "Wed, Jun 11", time: "3:00 PM" },
          { label: "Sat, Jun 14", time: "8:00 PM" },
          { label: "Sun, Jun 15", time: "2:00 PM" },
        ],
        "tiers": [
          {
              name: "PLATINUM",
              price: 8500,
              status: "Reserved Seating",
              available: 250,
              color: "violet",
            },
            {
              name: "SVIP",
              price: 7500,
              status: "Reserved Seating",
              available: 350,
              color: "violet",
            },
            {
              name: "VIP",
              price: 6500,
              status: "Reserved Seating",
              available: 400,
              color: "blue",
            },
            {
              name: "GOLD",
              price: 4500,
              status: "Reserved Seating",
              available: 300,
              color: "blue",
            },
            {
              name: "SILVER",
              price: 3500,
              status: "Reserved Seating",
              available: 200,
              color: "zinc",
            },
            {
              name: "BRONZE",
              price: 1500,
              status: "Reserved Seating",
              available: 240,
              color: "zinc",
            },
        ],
      },
      4: {
        "id": 4,
        "title": "Coldplay World Tour",
        "category": "concert",
        "type": "Concert",
        "date": "July 5, 2026",
        "location": "MOA Arena, Pasay",
        "price": "₱1,500",
        "images": [
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuEJOC_Sm2eUoa629dYjjw-A7rfs4q0sx7ZA&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
          "description": "Coldplay's Music of the Spheres World Tour arrives in Manila. Expect a breathtaking light show and all your favourite anthems.",
        "dates": [
          { label: "Sun, Jul 5", time: "7:30 PM" },
          { label: "Mon, Jul 6", time: "7:30 PM" },
        ],
        "tiers": [
          {
              name: "SVIP SEATED",
              price: 22500,
              status: "Reserved Seating",
              available: 800,
              color: "violet",
            },
            {
              name: "VIP A PREMIUM",
              price: 17500,
              status: "Reserved Seating",
              available: 1200,
              color: "blue",
            },
            {
              name: "VIP A REGULAR",
              price: 12500,
              status: "Reserved Seating",
              available: 1500,
              color: "blue",
            },
            {
              name: "VIP A REGULAR RESTRICTED VIEW",
              price: 11000,
              status: "Reserved Seating",
              available: 400,
              color: "blue",
            },
            {
              name: "VIP B PREMIUM",
              price: 7500,
              status: "Reserved Seating",
              available: 2000,
              color: "blue",
            },
            {
              name: "VIP B REGULAR",
              price: 6500,
              status: "Reserved Seating",
              available: 2500,
              color: "blue",
            },
            {
              name: "VIP B REGULAR RESTRICTED VIEW",
              price: 5500,
              status: "Reserved Seating",
              available: 600,
              color: "blue",
            },
            {
              name: "SVIP STANDING",
              price: 18000,
              status: "Standing",
              available: 2500,
              color: "violet",
            },
            {
              name: "BOX A PREMIUM",
              price: 4500,
              status: "Reserved Seating",
              available: 1800,
              color: "zinc",
            },
            {
              name: "BOX B PREMIUM",
              price: 3500,
              status: "Reserved Seating",
              available: 2200,
              color: "zinc",
            },
            {
              name: "BOX B RESTRICTED VIEW",
              price: 2800,
              status: "Reserved Seating",
              available: 500,
              color: "zinc",
            },
            {
              name: "BOX REGULAR",
              price: 1800,
              status: "Reserved Seating",
              available: 3000,
              color: "zinc",
            },
            {
              name: "BOX REGULAR RESTRICTED VIEW",
              price: 1500,
              status: "Reserved Seating",
              available: 1000,
              color: "zinc",
            },
        ],
      },
      5: {
        "id": 5,
        "title": "UAAP Men's Basketball: Ateneo vs La Salle",
        "category": "sports",
        "type": "Sports",
        "date": "May 25, 2026",
        "location": "Smart Araneta Coliseum",
        "price": "₱500",
        "images": [
            "https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/88477c99-c357-4758-a37e-b1b750215b2f/compose?aspectRatio=1.78&format=webp&width=1200",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
          "description": "The most intense rivalry in Philippine college basketball. Blue Eagles vs Green Archers — who will reign supreme?",
        "dates": [
          { label: "Sun, May 25", time: "12:00 PM" },
          { label: "Sat, May 31", time: "2:00 PM" },
        ],
        "tiers": [
          {
              name: "SEATED VIP",
              price: 3300,
              status: "Reserved Seating",
              available: 150,
              color: "violet",
            },
            {
              name: "PATRON A",
              price: 1000,
              status: "Reserved Seating",
              available: 800,
              color: "violet",
            },
            {
              name: "PATRON B",
              price: 950,
              status: "Reserved Seating",
              available: 1200,
              color: "violet",
            },
            {
              name: "PATRON C",
              price: 900,
              status: "Reserved Seating",
              available: 1500,
              color: "violet",
            },
            {
              name: "LOWER BOX A",
              price: 600,
              status: "Reserved Seating",
              available: 2000,
              color: "blue",
            },
            {
              name: "LOWER BOX B",
              price: 500,
              status: "Reserved Seating",
              available: 2500,
              color: "blue",
            },
        ],
      },
      6: {
        "id": 6,
        "title": "Music Festival 2026",
        "category": "festival",
        "type": "Festival",
        "date": "June 20, 2026",
        "location": "Mall of Asia Grounds",
        "price": "₱1,800",
        "images": [
            "https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/88477c99-c357-4758-a37e-b1b750215b2f/compose?aspectRatio=1.78&format=webp&width=1200",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
        "description": "A massive outdoor festival featuring the best local and international acts. Three stages, 12 hours of music.",
        "dates": [
          { label: "Sat, Jun 20", time: "12:00 PM" },
          { label: "Sun, Jun 21", time: "12:00 PM" },
        ],
        "tiers": [
          {
              name: "General Admission",
              price: 1200,
              available: 5000,
              color: "zinc",
            },
            {
              name: "Day + Night Pass",
              price: 1800,
              available: 1500,
              color: "blue",
            },
            {
              name: "VIP Lounge",
              price: 4500,
              available: 200,
              color: "violet",
            },
        ],
      },
      7: {
        "id": 7,
        "title": "Hamilton - Manila",
        "category": "theatre",
        "type": "Theatre",
        "date": "August 15, 2026",
        "location": "Newport Performing Arts Theater",
        "price": "₱3,000",
        "images": [
            "https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/88477c99-c357-4758-a37e-b1b750215b2f/compose?aspectRatio=1.78&format=webp&width=1200",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
        "description": "The award-winning Broadway phenomenon finally arrives in Manila. Hamilton tells the story of America's Founding Father through hip-hop, jazz, and R&B.",
        "dates": [
          { label: "Fri, Aug 14", time: "8:00 PM" },
          { label: "Sat, Aug 15", time: "3:00 PM" },
          { label: "Sat, Aug 15", time: "8:00 PM" },
          { label: "Sun, Aug 16", time: "2:00 PM" },
        ],
        "tiers": [
          {
              name: "PLATINUM",
              price: 8993,
              status: "Reserved Seating",
              available: 250,
              color: "violet",
            },
            {
              name: "SVIP",
              price: 6348,
              status: "Reserved Seating",
              available: 350,
              color: "violet",
            },
            {
              name: "VIP",
              price: 5819,
              status: "Reserved Seating",
              available: 400,
              color: "blue",
            },
            {
              name: "GOLD",
              price: 4761,
              status: "Reserved Seating",
              available: 300,
              color: "blue",
            },
            {
              name: "SILVER",
              price: 3703,
              status: "Reserved Seating",
              available: 200,
              color: "zinc",
            },
            {
              name: "BRONZE",
              price: 2645,
              status: "Reserved Seating",
              available: 240,
              color: "zinc",
            },
        ],
      },
      8: {
        "id": 8,
        "title": "Daniel Caesar Live in Manila",
        "category": "concert",
        "type": "Concert",
        "date": "September 10, 2026",
        "location": "Philippine Arena, Bulacan",
        "price": "₱2,750",
        "images": [
            "https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/88477c99-c357-4758-a37e-b1b750215b2f/compose?aspectRatio=1.78&format=webp&width=1200",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
        "description": "Grammy-winning R&B artist Daniel Caesar brings his soulful sounds to Manila for one night only.",
        "dates": [
          { label: "Sat, Sep 13", time: "8:00 PM" },
        ],
        "tiers": [
          {
              name: "EARLY ENTRANCE PACKAGE",
              price: 10600,
              status: "Reserved Seating",
              available: 600,
              color: "violet",
            },
            {
              name: "VIP A PREMIUM",
              price: 9500,
              status: "Reserved Seating",
              available: 1200,
              color: "blue",
            },
            {
              name: "VIP A REGULAR",
              price: 8250,
              status: "Reserved Seating",
              available: 1500,
              color: "blue",
            },
            {
              name: "VIP A REGULAR RESTRICTED VIEW",
              price: 8250,
              status: "Reserved Seating",
              available: 400,
              color: "blue",
            },
            {
              name: "VIP B PREMIUM",
              price: 7500,
              status: "Reserved Seating",
              available: 1800,
              color: "blue",
            },
            {
              name: "VIP B REGULAR",
              price: 6500,
              status: "Reserved Seating",
              available: 2200,
              color: "blue",
            },
            {
              name: "VIP RESTRICTED VIEW",
              price: 6500,
              status: "Reserved Seating",
              available: 500,
              color: "blue",
            },
            {
              name: "SVIP STANDING",
              price: 5500,
              status: "Standing",
              available: 2500,
              color: "violet",
            },
            {
              name: "BOX A PREMIUM",
              price: 5500,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
            {
              name: "BOX B PREMIUM",
              price: 4500,
              status: "Reserved Seating",
              available: 2500,
              color: "zinc",
            },
            {
              name: "BOX PREMIUM RESTRICTED VIEW",
              price: 4500,
              status: "Reserved Seating",
              available: 600,
              color: "zinc",
            },
            {
              name: "BOX REGULAR",
              price: 2750,
              status: "Reserved Seating",
              available: 3500,
              color: "zinc",
            },
            {
              name: "BOX REGULAR RESTRICTED VIEW",
              price: 2750,
              status: "Reserved Seating",
              available: 1000,
              color: "zinc",
            },
        ],
      },
      9: {
        "id": 9,
        "title": "My Chemical Romance Reunion Tour",
        "category": "concert",
        "type": "Concert",
        "date": "October 5, 2026",
        "location": "MOA Arena, Pasay",
        "price": "₱1,800",
        "images": [
            "https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/88477c99-c357-4758-a37e-b1b750215b2f/compose?aspectRatio=1.78&format=webp&width=1200",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
        "description": "They're not okay — they're BACK. My Chemical Romance reunites for a world tour and Manila is on the list.",
        "dates": [
          { label: "Sat, Oct 10", time: "8:00 PM" },
        ],
        "tiers": [
          {
              name: "SVIP SEATED",
              price: 15900,
              status: "Reserved Seating",
              available: 2000,
              color: "violet",
            },
            {
              name: "VIP A PREMIUM",
              price: 13250,
              status: "Reserved Seating",
              available: 2000,
              color: "blue",
            },
            {
              name: "VIP A REGULAR",
              price: 11130,
              status: "Reserved Seating",
              available: 2000,
              color: "blue",
            },
            {
              name: "VIP A REGULAR RESTRICTED VIEW",
              price: 9500,
              status: "Reserved Seating",
              available: 2000,
              color: "blue",
            },
            {
              name: "VIP B PREMIUM",
              price: 7950,
              status: "Reserved Seating",
              available: 2000,
              color: "blue",
            },
            {
              name: "VIP B REGULAR",
              price: 6890,
              status: "Reserved Seating",
              available: 2000,
              color: "blue",
            },
            {
              name: "VIP B REGULAR RESTRICTED VIEW",
              price: 5500,
              status: "Reserved Seating",
              available: 2000,
              color: "blue",
            },
            {
              name: "SVIP STANDING",
              price: 21200,
              status: "Standing",
              available: 2000,
              color: "violet",
            },
            {
              name: "BOX A PREMIUM",
              price: 4770,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
            {
              name: "BOX B PREMIUM",
              price: 3180,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
            {
              name: "BOX B RESTRICTED VIEW",
              price: 2500,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
            {
              name: "BOX REGULAR",
              price: 2120,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
            {
              name: "BOX REGULAR RESTRICTED VIEW",
              price: 1800,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
        ],
      },
      10: {
        "id": 10,
        "title": "Bruno Mars 24K Magic Tour",
        "category": "concert",
        "type": "Concert",
        "date": "November 20, 2026",
        "location": "Philippine Arena, Bulacan",
        "price": "₱2,500",
        "images": [
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKOSUoBKa_EU2RjXxdYvmpNWacBQHSG-XyGw&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
          "description": "Bruno Mars is back and bringing the 24K Magic tour to the Philippines. Expect an electrifying night of his biggest hits.",
        "dates": [
          { label: "Sat, Nov 14", time: "8:00 PM" },
        ],
        "tiers": [
          {
              name: "SVIP SEATED",
              price: 23850,
              status: "Reserved Seating",
              available: 600,
              color: "violet",
            },
            {
              name: "SVIP STANDING",
              price: 18750,
              status: "Standing",
              available: 2500,
              color: "violet",
            },
            {
              name: "VIP A PREMIUM",
              price: 18850,
              status: "Reserved Seating",
              available: 1200,
              color: "blue",
            },
            {
              name: "VIP A REGULAR",
              price: 13250,
              status: "Reserved Seating",
              available: 1500,
              color: "blue",
            },
            {
              name: "VIP A REGULAR RESTRICTED VIEW",
              price: 11500,
              status: "Reserved Seating",
              available: 400,
              color: "blue",
            },
            {
              name: "VIP B PREMIUM",
              price: 8480,
              status: "Reserved Seating",
              available: 1800,
              color: "blue",
            },
            {
              name: "VIP B REGULAR",
              price: 7250,
              status: "Reserved Seating",
              available: 2200,
              color: "blue",
            },
            {
              name: "VIP B REGULAR RESTRICTED VIEW",
              price: 6500,
              status: "Reserved Seating",
              available: 500,
              color: "blue",
            },
            {
              name: "BOX A PREMIUM",
              price: 5550,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
            {
              name: "BOX B PREMIUM",
              price: 4770,
              status: "Reserved Seating",
              available: 2500,
              color: "zinc",
            },
            {
              name: "BOX B RESTRICTED VIEW",
              price: 3800,
              status: "Reserved Seating",
              available: 600,
              color: "zinc",
            },
            {
              name: "BOX REGULAR",
              price: 2750,
              status: "Reserved Seating",
              available: 3500,
              color: "zinc",
            },
            {
              name: "BOX REGULAR RESTRICTED VIEW",
              price: 2500,
              status: "Reserved Seating",
              available: 1000,
              color: "zinc",
            },
        ],
      },
      11: {
        "id": 11,
        "title": "Epic: The Musical - Manila",
        "category": "theatre",
        "type": "Theatre",
        "date": "December 10, 2026",
        "location": "Newport Performing Arts Theater",
        "price": "₱2,800",
        "images": [
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLyeZHMjAKjedyosMPPtKMDEkhXOUGP-FKLQ&s",
            "https://cdn.prod.website-files.com/67934a6191c320fb7fdaa5b1/67aa94b9bf59fb4e0b5eda15_ggPN1WwpGzuLgAb34peoX_7f7ac2c46789459eac5ff6e40f0c155e.jpeg",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
        "description": "The internet-famous musical adaptation of Homer's Odyssey comes to Manila's stage for a limited run.",
        "dates": [
          { label: "Sat, Dec 12", time: "8:00 PM" },
        ],
        "tiers": [
          {
              name: "PLATINUM",
              price: 6180,
              status: "Reserved Seating",
              available: 250,
              color: "violet",
            },
            {
              name: "SVIP",
              price: 5768,
              status: "Reserved Seating",
              available: 350,
              color: "violet",
            },
            {
              name: "VIP",
              price: 5150,
              status: "Reserved Seating",
              available: 400,
              color: "blue",
            },
            {
              name: "GOLD",
              price: 4120,
              status: "Reserved Seating",
              available: 300,
              color: "blue",
            },
            {
              name: "SILVER",
              price: 3090,
              status: "Reserved Seating",
              available: 200,
              color: "zinc",
            },
            {
              name: "BRONZE",
              price: 1545,
              status: "Reserved Seating",
              available: 240,
              color: "zinc",
            },
        ],
      },
      12: {
        "id": 12,
        "title": "The 1975 Live in Manila",
        "category": "concert",
        "type": "Concert",
        "date": "January 15, 2027",
        "location": "MOA Arena, Pasay",
        "price": "₱1,975",
        "images": [
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLuM0qZr-iQVhiWeomcFN_JFBMxGoP5FTiow&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1savZ0blaQBem92gJaSjeuoInGrt8WjaRCA&s",
            "https://od2-image-api.abs-cbn.com/prod/20241025161052/7f87a45b6eebf670c62a8c1397c3dfcb3d18e2b64651b08c07ae737321bd1e8f.jpg?w=1200&h=800",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnS4ea81J7kQQWrtBr40i1JmJSErqfTXU85A&s",
          ],
        "description": "The 1975 bring their unique blend of pop, rock, and electronic music to Manila for an unforgettable night.",
        "dates": [
          { label: "Sat, Jan 18", time: "8:00 PM" },
        ],
        "tiers": [
          {
              name: "SVIP SEATED",
              price: 10340,
              status: "Reserved Seating",
              available: 600,
              color: "violet",
            },
            {
              name: "SVIP STANDING",
              price: 9750,
              status: "Standing",
              available: 2500,
              color: "violet",
            },
            {
              name: "VIP A PREMIUM",
              price: 8480,
              status: "Reserved Seating",
              available: 1200,
              color: "blue",
            },
            {
              name: "VIP A REGULAR",
              price: 7950,
              status: "Reserved Seating",
              available: 1500,
              color: "blue",
            },
            {
              name: "VIP A REGULAR RESTRICTED VIEW",
              price: 7420,
              status: "Reserved Seating",
              available: 400,
              color: "blue",
            },
            {
              name: "VIP B PREMIUM",
              price: 7000,
              status: "Reserved Seating",
              available: 1800,
              color: "blue",
            },
            {
              name: "VIP B REGULAR",
              price: 6360,
              status: "Reserved Seating",
              available: 2200,
              color: "blue",
            },
            {
              name: "VIP B REGULAR RESTRICTED VIEW",
              price: 6000,
              status: "Reserved Seating",
              available: 500,
              color: "blue",
            },
            {
              name: "BOX A PREMIUM",
              price: 5300,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
            {
              name: "BOX B PREMIUM",
              price: 4240,
              status: "Reserved Seating",
              available: 2500,
              color: "zinc",
            },
            {
              name: "BOX B RESTRICTED VIEW",
              price: 4000,
              status: "Reserved Seating",
              available: 600,
              color: "zinc",
            },
            {
              name: "BOX REGULAR",
              price: 2650,
              status: "Reserved Seating",
              available: 3500,
              color: "zinc",
            },
            {
              name: "BOX REGULAR RESTRICTED VIEW",
              price: 1975,
              status: "Reserved Seating",
              available: 1000,
              color: "zinc",
            },
        ],
      },
      13: {
        "id": 13,
        "title": "Hatsune Miku Expo 2026",
        "category": "festival",
        "type": "Festival",
        "date": "February 20, 2027",
        "location": "Mall of Asia Grounds",
        "price": "₱1,500",
        "images": [
            "https://mikuexpo.com/europe2026/images/og.jpg",
            "https://mikuexpo.com/na2026/images/og.jpg",
            "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
          ],
        "description": "The virtual idol phenomenon comes to life with stunning holographic performances and a full festival experience.",
        "dates": [
          { label: "Sat, Feb 14", time: "8:00 PM" },
        ],
        "tiers": [
          {
              name: "General Admission", price: 1500, available: 2000, color: "zinc",
            },
            {
              name: "VIP Experience", price: 4500, available: 300, color: "blue",
            },
        ],
      },
      14: {
        "id": 14,
        "title": "Ado Live in Manila",
        "category": "concert",
        "type": "Concert",
        "date": "March 10, 2027",
        "location": "Philippine Arena, Bulacan",
        "price": "₱2,500",
        "images": [
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDxe35dj5YviHHBSRHrEZH3wuk_e70X3CM0Q&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfWI7Mh6JBh31cfnSwC4cgVkwbZkqV6hTqzg&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8sdipMzzOIiULnbYU9gkS0e72Nw4apkj5lg&s",
            "https://aphrodite.gmanetwork.com/entertainment/articles/900_675_3_-20250509142608.jpg",
          ],
        "description": "Japan's most powerful voice, Ado, makes her Philippine debut in what promises to be an electrifying performance.",
        "dates": [
          { label: "Sat, Mar 14", time: "8:00 PM" },
        ],
        "tiers": [
          {
              name: "VIP PIT (Floor Standing)",
              price: 11000,
              status: "Standing",
              available: 8000,
              color: "violet",
            },
            {
              name: "LBA Lower Box A Premium",
              price: 22000,
              status: "Reserved Seating",
              available: 4500,
              color: "blue",
            },
            {
              name: "LBA Lower Box A Regular",
              price: 17000,
              status: "Reserved Seating",
              available: 6000,
              color: "blue",
            },
            {
              name: "LBB Lower Box B Premium",
              price: 15500,
              status: "Reserved Seating",
              available: 5500,
              color: "blue",
            },
            {
              name: "LBB Lower Box B Regular",
              price: 11000,
              status: "Reserved Seating",
              available: 7000,
              color: "blue",
            },
            {
              name: "UBA Upper Box A Premium",
              price: 10000,
              status: "Reserved Seating",
              available: 6000,
              color: "zinc",
            },
            {
              name: "UBB Upper Box B Premium",
              price: 6500,
              status: "Reserved Seating",
              available: 5000,
              color: "zinc",
            },
            {
              name: "UBB Upper Box B Regular",
              price: 6500,
              status: "Reserved Seating",
              available: 5000,
              color: "zinc",
            },
            {
              name: "UBB Upper Box B Sides",
              price: 3000,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
            {
              name: "UBC Upper Box C Premium",
              price: 5000,
              status: "Reserved Seating",
              available: 4000,
              color: "zinc",
            },
            {
              name: "UBC Upper Box C Regular",
              price: 2500,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
        ],
      },
      15: {
        "id": 15,
        "title": "Laufey A Matter of Time Tour",
        "category": "concert",
        "type": "Concert",
        "date": "April 5, 2027",
        "location": "MOA Arena, Pasay",
        "price": "₱2,500",
        "images": [
            "https://climatepledgearena.com/wp-content/uploads/2025/05/25-Laufey_CPA-Web_1600x900.jpg",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZUxdFxyQcz9MEuK2E-G0OcpoxRyjBoSZ5_A&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRCTWr3Ftww1RBbBltWMX6_EhwvTv9Jj6znrQ&s",
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSEvdRPIeEcBgWfLVZf_IbaEI--7E-A2aUgbg&s",
          ],
        "description": "Icelandic singer-songwriter Laufey enchants Manila with her jazz-pop sound and stunning orchestral arrangements.",
        "dates": [
          { label: "Sat, Apr 18", time: "8:00 PM" },
        ],
        "tiers": [
          {
              name: "SVIP SEATED",
              price: 9500,
              status: "Reserved Seating",
              available: 800,
              color: "violet",
            },
            {
              name: "VIP A PREMIUM",
              price: 8500,
              status: "Reserved Seating",
              available: 1200,
              color: "blue",
            },
            {
              name: "VIP A REGULAR",
              price: 7750,
              status: "Reserved Seating",
              available: 1500,
              color: "blue",
            },
            {
              name: "VIP A REGULAR RESTRICTED VIEW",
              price: 7750,
              status: "Reserved Seating",
              available: 400,
              color: "blue",
            },
            {
              name: "VIP B PREMIUM",
              price: 7250,
              status: "Reserved Seating",
              available: 1800,
              color: "blue",
            },
            {
              name: "VIP B REGULAR",
              price: 6500,
              status: "Reserved Seating",
              available: 2200,
              color: "blue",
            },
            {
              name: "VIP B REGULAR RESTRICTED VIEW",
              price: 6500,
              status: "Reserved Seating",
              available: 500,
              color: "blue",
            },
            {
              name: "SVIP STANDING",
              price: 5500,
              status: "Standing",
              available: 2500,
              color: "violet",
            },
            {
              name: "BOX A PREMIUM",
              price: 4500,
              status: "Reserved Seating",
              available: 2000,
              color: "zinc",
            },
            {
              name: "BOX B PREMIUM",
              price: 3500,
              status: "Reserved Seating",
              available: 2500,
              color: "zinc",
            },
            {
              name: "BOX B RESTRICTED VIEW",
              price: 3500,
              status: "Reserved Seating",
              available: 600,
              color: "zinc",
            },
            {
              name: "BOX REGULAR",
              price: 2500,
              status: "Reserved Seating",
              available: 3500,
              color: "zinc",
            },
            {
              name: "BOX REGULAR RESTRICTED VIEW",
              price: 2500,
              status: "Reserved Seating",
              available: 1000,
              color: "zinc",
            },
        ],
      },
      16: {
        "id": 16,
        "title": "The Greatest Showman Live Experience",
        "category": "theatre",
        "type": "Theatre",
        "date": "May 20, 2027",
        "location": "Newport Performing Arts Theater",
        "price": "₱3,200",
        "images": [
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqkgJb8uKCbWDDTQnM53jlsgiNOc-2gjbkew&s",
            "https://cms.entertainmentquarter.com.au/wp-content/uploads/2025/11/COME-ALIVE-The-Greatest-Showman-Sydney-Entertainment-Quarter-1.jpg",
            "https://images.ctfassets.net/6pezt69ih962/5huqPQaQKnc4m8MO33rL7m/471608242ed51c75fc2aa776ccb9ded7/Come_Alive_-_2nd_October_2024_by_Luke_Dyson_-_LD1_0895-Enhanced-NR.jpg?h=200&fm=webp&q=90",
            "https://www.westendtheatre.com/wp-content/uploads/2024/10/Come-Alive-The-Greatest-Showman-Circus-Spectacular.-Photos-by-Luke-Dyson-1024x576.jpg",
          ],
        "description": "A dazzling live stage adaptation of the hit film, complete with acrobats, aerialists, and live orchestral music.",
        "dates": [
          { label: "Sat, May 16", time: "8:00 PM" },
        ],
        "tiers": [
          {
              name: "PLATINUM",
              price: 8500,
              status: "Reserved Seating",
              available: 250,
              color: "violet",
            },
            {
              name: "SVIP",
              price: 7500,
              status: "Reserved Seating",
              available: 350,
              color: "violet",
            },
            {
              name: "VIP",
              price: 6500,
              status: "Reserved Seating",
              available: 400,
              color: "blue",
            },
            {
              name: "GOLD",
              price: 4500,
              status: "Reserved Seating",
              available: 300,
              color: "blue",
            },
            {
              name: "SILVER",
              price: 3500,
              status: "Reserved Seating",
              available: 200,
              color: "zinc",
            },
            {
              name: "BRONZE",
              price: 1500,
              status: "Reserved Seating",
              available: 240,
              color: "zinc",
            },
        ],
      }
    };

    let state = {
      event: null,
      activeImg: 0,
      selectedDate: 0,
      selectedTier: 0,
      qty: 1,
    };

    function init() {
      const params = new URLSearchParams(window.location.search);
      const id = parseInt(params.get("eventId")) || 1;
      state.event = events[id];

      if (!state.event) {
        document.getElementById("pageContent").innerHTML = 
          '<p class="text-center text-zinc-500 py-32">Event not found.</p>';
        return;
      }

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
            <!-- Left: Images -->
            <div class="lg:col-span-2 space-y-6">
              <!-- Main Image -->
              <div class="relative rounded-2xl overflow-hidden" style="height: 400px;">
                <img id="mainImg" src="${e.images[0]}" alt="${e.title}" class="w-full h-full object-cover transition-opacity duration-300">
              </div>
              
              <!-- Thumbnails -->
              <div class="flex gap-2">
                ${e.images.map((img, i) => `
                  <div class="thumb ${i === 0 ? 'active' : 'opacity-50'} rounded-lg overflow-hidden flex-1 cursor-pointer" style="height: 80px;" onclick="switchImage(${i})">
                    <img src="${img}" alt="Image ${i + 1}" class="w-full h-full object-cover hover:opacity-100 transition-opacity">
                  </div>
                `).join('')}
              </div>
            </div>

            <!-- Right: Details -->
            <div class="space-y-6">
              <div>
                <h1 class="serif text-4xl text-white mb-2">${e.title}</h1>
                <div class="flex items-center gap-2 text-zinc-400">
                  <i class="fa-solid fa-tag text-sm"></i>
                  <span class="text-sm uppercase tracking-wide">${e.type}</span>
                </div>
              </div>

              <div class="border-t border-zinc-800 pt-4">
                <p class="text-zinc-400 text-sm mb-2">Event Details</p>
                <div class="space-y-2 text-sm">
                  <div class="flex items-center gap-2">
                    <i class="fa-solid fa-calendar text-violet-400 w-4"></i>
                    <span>${e.date}</span>
                  </div>
                  <div class="flex items-center gap-2">
                    <i class="fa-solid fa-map-pin text-violet-400 w-4"></i>
                    <span>${e.location}</span>
                  </div>
                </div>
              </div>

              <div class="border-t border-zinc-800 pt-4">
                <p class="text-zinc-400 text-sm mb-3">Select Date</p>
                <div class="space-y-2">
                  ${e.dates.map((d, i) => `
                    <button onclick="selectDate(${i})" 
                      class="w-full date-btn py-2.5 px-3 rounded-lg border text-sm transition-all ${state.selectedDate === i ? 'border-violet-500 bg-violet-500/20 text-white' : 'border-zinc-700 text-zinc-300 hover:border-zinc-600'}">
                      ${d.label} • ${d.time}
                    </button>
                  `).join('')}
                </div>
              </div>

              <div class="border-t border-zinc-800 pt-4">
                <p class="text-zinc-400 text-sm mb-3">Ticket Tier</p>
                <div class="space-y-2">
                  ${e.tiers.map((t, i) => `
                    <button onclick="selectTier(${i})" 
                      class="w-full tier-btn py-2.5 px-3 rounded-lg border text-sm transition-all text-left ${state.selectedTier === i ? 'border-violet-500 bg-violet-500/20' : 'border-zinc-700 hover:border-zinc-600'}">
                      <div class="flex justify-between items-center">
                        <span class="${state.selectedTier === i ? 'text-white' : 'text-zinc-300'}">${t.name}</span>
                        <span class="text-violet-400">₱${t.price.toLocaleString()}</span>
                      </div>
                    </button>
                  `).join('')}
                </div>
              </div>

              <div class="border-t border-zinc-800 pt-4">
                <p class="text-zinc-400 text-sm mb-3">Quantity</p>
                <div class="flex items-center gap-3">
                  <button onclick="changeQty(-1)" class="w-10 h-10 rounded-lg border border-zinc-700 hover:border-violet-500 text-zinc-300">-</button>
                  <span class="flex-1 text-center text-white font-semibold">${state.qty}</span>
                  <button onclick="changeQty(1)" class="w-10 h-10 rounded-lg border border-zinc-700 hover:border-violet-500 text-zinc-300">+</button>
                </div>
              </div>

              <div class="border-t border-zinc-800 pt-4">
                <div class="flex justify-between mb-4">
                  <span class="text-zinc-400">Subtotal:</span>
                  <span class="text-white font-semibold">₱${(tier.price * state.qty).toLocaleString()}</span>
                </div>
                <button onclick="openModal()" class="w-full bg-violet-600 hover:bg-violet-500 text-white py-3 rounded-xl font-semibold">
                  Buy Tickets
                </button>
              </div>
            </div>
          </div>

          <!-- Description -->
          <div class="mt-12 border-t border-zinc-800 pt-8">
            <h2 class="serif text-2xl text-white mb-4">About This Event</h2>
            <p class="text-zinc-300 leading-relaxed max-w-3xl">${e.description}</p>
          </div>
        </div>
      `;

      document.getElementById("pageContent").innerHTML = html;
    }

    function selectDate(index) {
      state.selectedDate = index;
      renderPage();
    }

    function selectTier(index) {
      state.selectedTier = index;
      renderPage();
    }

    function changeQty(delta) {
      const newQty = state.qty + delta;
      if (newQty > 0 && newQty <= 10) {
        state.qty = newQty;
        renderPage();
      }
    }

    function switchImage(index) {
      state.activeImg = index;
      const e = state.event;
      document.getElementById("mainImg").src = e.images[index];
      
      // Update thumbnail active state
      document.querySelectorAll(".thumb").forEach((thumb, i) => {
        if (i === index) {
          thumb.classList.remove("opacity-50");
          thumb.classList.add("active");
        } else {
          thumb.classList.add("opacity-50");
          thumb.classList.remove("active");
        }
      });
    }

    function openModal() {
      if (localStorage.getItem("userLoggedIn") !== "true") {
        alert("Please log in first to purchase tickets.");
        window.location.href = "login.php";
        return;
      }

      const e = state.event;
      const tier = e.tiers[state.selectedTier];
      const date = e.dates[state.selectedDate];
      const total = tier.price * state.qty;

      const summary = `
        <div class="space-y-2">
          <div class="flex justify-between text-zinc-300">
            <span>${e.title}</span>
          </div>
          <div class="flex justify-between text-zinc-400 text-sm">
            <span>${tier.name}</span>
            <span>₱${tier.price.toLocaleString()}</span>
          </div>
          <div class="flex justify-between text-zinc-400 text-sm">
            <span>Qty: ${state.qty}</span>
          </div>
          <div class="border-t border-zinc-700 pt-2 flex justify-between text-white font-semibold">
            <span>Total</span>
            <span>₱${total.toLocaleString()}</span>
          </div>
        </div>
      `;

      document.getElementById("modalSummary").innerHTML = summary;
      document.getElementById("modalName").value = "";
      document.getElementById("modalEmail").value = "";
      document.getElementById("buyModal").classList.remove("hidden");
      document.getElementById("buyModal").classList.add("flex");
    }

    function closeModal() {
      document.getElementById("buyModal").classList.add("hidden");
      document.getElementById("buyModal").classList.remove("flex");
    }

    function selectPayment(btn) {
      document.querySelectorAll(".pay-btn").forEach(b => {
        b.classList.remove("border-violet-500", "text-white");
        b.classList.add("border-zinc-700", "text-zinc-400");
      });
      btn.classList.add("border-violet-500", "text-white");
      btn.classList.remove("border-zinc-700", "text-zinc-400");
    }

    function submitOrder() {
      const name = document.getElementById("modalName").value.trim();
      const email = document.getElementById("modalEmail").value.trim();
      const selectedPayment = document.querySelector(".pay-btn.border-violet-500");

      // Validation
      if (!name) {
        document.getElementById("nameError").textContent = "Full name is required";
        document.getElementById("nameError").classList.remove("hidden");
        return;
      }
      document.getElementById("nameError").classList.add("hidden");

      if (!email || !email.includes("@")) {
        document.getElementById("emailError").textContent = "Valid email is required";
        document.getElementById("emailError").classList.remove("hidden");
        return;
      }
      document.getElementById("emailError").classList.remove("hidden");

      if (!selectedPayment) {
        document.getElementById("paymentError").textContent = "Select a payment method";
        document.getElementById("paymentError").classList.remove("hidden");
        return;
      }
      document.getElementById("paymentError").classList.add("hidden");

      const e = state.event;
      const tier = e.tiers[state.selectedTier];
      const date = e.dates[state.selectedDate];
      const total = tier.price * state.qty;

      const params = new URLSearchParams({
        eventTitle: e.title,
        date: date.label + " • " + date.time,
        location: e.location,
        tier: tier.name,
        quantity: state.qty,
        total: total,
        name: name,
        email: email,
        payment: selectedPayment.textContent
      });

      window.location.href = `order-summary.php?${params.toString()}`;
    }

    init();
  </script>
</body>
</html>