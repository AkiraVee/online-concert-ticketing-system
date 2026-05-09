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
        "image": "https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/88477c99-c357-4758-a37e-b1b750215b2f/compose?aspectRatio=1.78&format=webp&width=1200",
        "description": "The most spectacular tour of the decade returns to the Philippines. Taylor Swift brings all her eras to life in one unforgettable night.",
        "dates": [
          {"label": "May 20, 2026", "time": "7:00 PM"},
          {"label": "May 21, 2026", "time": "7:00 PM"},
        ],
        "tiers": [
          {"name": "General Admission", "price": 3500,  "available": 120},
          {"name": "Lower Box",         "price": 6500,  "available": 60},
          {"name": "VIP Floor",         "price": 12000, "available": 20},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRel2BkhvraSCdtKrKVtE1undLe14McGM4AgQ&s",
        "description": "Barangay Ginebra faces off against the TNT Tropang Giga in a highly anticipated PBA clash. Don't miss the action!",
        "dates": [
          {"label": "May 15, 2026", "time": "6:30 PM"},
        ],
        "tiers": [
          {"name": "Upper Box",   "price": 500,  "available": 200},
          {"name": "Lower Box",   "price": 900,  "available": 80},
          {"name": "Courtside",   "price": 2500, "available": 15},
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
        "image": "https://theaterfansmanila.com/wp-content/uploads/2023/10/Miss-Saigon-feat-pic.jpg",
        "description": "The legendary West End and Broadway musical comes to Manila. A timeless story of love and war set in the final days of the Vietnam War.",
        "dates": [
          {"label": "June 10, 2026", "time": "8:00 PM"},
          {"label": "June 11, 2026", "time": "3:00 PM"},
          {"label": "June 12, 2026", "time": "8:00 PM"},
        ],
        "tiers": [
          {"name": "Orchestra",       "price": 2200, "available": 90},
          {"name": "Mezzanine",       "price": 3500, "available": 40},
          {"name": "Front Row",       "price": 5500, "available": 10},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuEJOC_Sm2eUoa629dYjjw-A7rfs4q0sx7ZA&s",
        "description": "Coldplay's Music of the Spheres World Tour arrives in Manila. Expect a breathtaking light show and all your favourite anthems.",
        "dates": [
          {"label": "July 5, 2026",  "time": "7:30 PM"},
          {"label": "July 6, 2026",  "time": "7:30 PM"},
        ],
        "tiers": [
          {"name": "General Admission", "price": 1500, "available": 300},
          {"name": "Lower Box",         "price": 3800, "available": 70},
          {"name": "VIP Pit",           "price": 8500, "available": 25},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQC9sHGXewX7wEEO0LOFJ-BBcUXAbiWpPNQ2A&s",
        "description": "The most intense rivalry in Philippine college basketball. Blue Eagles vs Green Archers — who will reign supreme?",
        "dates": [
          {"label": "May 25, 2026", "time": "4:00 PM"},
        ],
        "tiers": [
          {"name": "Upper Box",   "price": 500,  "available": 250},
          {"name": "Lower Box",   "price": 1000, "available": 100},
          {"name": "Courtside",   "price": 3000, "available": 12},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFTcjSKXMIKWe_V00j-0_ii0FUTkUI9nPmqw&s",
        "description": "A massive outdoor festival featuring the best local and international acts. Three stages, 12 hours of music.",
        "dates": [
          {"label": "June 20, 2026", "time": "2:00 PM"},
          {"label": "June 21, 2026", "time": "2:00 PM"},
        ],
        "tiers": [
          {"name": "1-Day Pass",  "price": 1800, "available": 400},
          {"name": "2-Day Pass",  "price": 3000, "available": 150},
          {"name": "VIP Package", "price": 6000, "available": 30},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMqFf1Wvg6byazp3YQ2qs-nlNDmNpBmZBm0Q&s",
        "description": "The award-winning Broadway phenomenon finally arrives in Manila. Hamilton tells the story of America's Founding Father through hip-hop, jazz, and R&B.",
        "dates": [
          {"label": "August 15, 2026", "time": "7:30 PM"},
          {"label": "August 16, 2026", "time": "2:00 PM"},
          {"label": "August 16, 2026", "time": "7:30 PM"},
        ],
        "tiers": [
          {"name": "Orchestra",   "price": 3000, "available": 80},
          {"name": "Mezzanine",   "price": 4500, "available": 50},
          {"name": "Premium Box", "price": 8000, "available": 8},
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
        "image": "https://aphrodite.gmanetwork.com/entertainment/articles/1200_675_11_07-04-2026-1513_-20260407151314.jpg",
        "description": "Grammy-winning R&B artist Daniel Caesar brings his soulful sounds to Manila for one night only.",
        "dates": [
          {"label": "September 10, 2026", "time": "8:00 PM"},
        ],
        "tiers": [
          {"name": "General Admission", "price": 2750, "available": 150},
          {"name": "Lower Box",         "price": 4500, "available": 50},
          {"name": "VIP",               "price": 9000, "available": 15},
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
        "image": "https://static.easyrock.com.ph/posts/2025/7/D24MN_6tBshHyzklGDfPC.jpeg",
        "description": "They're not okay — they're BACK. My Chemical Romance reunites for a world tour and Manila is on the list.",
        "dates": [
          {"label": "October 5, 2026", "time": "7:00 PM"},
        ],
        "tiers": [
          {"name": "General Admission", "price": 1800, "available": 200},
          {"name": "Lower Box",         "price": 3200, "available": 60},
          {"name": "VIP Floor",         "price": 7500, "available": 20},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKOSUoBKa_EU2RjXxdYvmpNWacBQHSG-XyGw&s",
        "description": "Bruno Mars is back and bringing the 24K Magic tour to the Philippines. Expect an electrifying night of his biggest hits.",
        "dates": [
          {"label": "November 20, 2026", "time": "8:00 PM"},
          {"label": "November 21, 2026", "time": "8:00 PM"},
        ],
        "tiers": [
          {"name": "General Admission", "price": 2500, "available": 300},
          {"name": "Lower Box",         "price": 4800, "available": 80},
          {"name": "VIP Pit",           "price": 10000,"available": 20},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLyeZHMjAKjedyosMPPtKMDEkhXOUGP-FKLQ&s",
        "description": "The internet-famous musical adaptation of Homer's Odyssey comes to Manila's stage for a limited run.",
        "dates": [
          {"label": "December 10, 2026", "time": "7:30 PM"},
          {"label": "December 11, 2026", "time": "3:00 PM"},
          {"label": "December 12, 2026", "time": "7:30 PM"},
        ],
        "tiers": [
          {"name": "Orchestra",   "price": 2800, "available": 100},
          {"name": "Mezzanine",   "price": 4000, "available": 45},
          {"name": "Front Row",   "price": 7000, "available": 10},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLuM0qZr-iQVhiWeomcFN_JFBMxGoP5FTiow&s",
        "description": "The 1975 bring their unique blend of pop, rock, and electronic music to Manila for an unforgettable night.",
        "dates": [
          {"label": "January 15, 2027", "time": "7:30 PM"},
        ],
        "tiers": [
          {"name": "General Admission", "price": 1975, "available": 180},
          {"name": "Lower Box",         "price": 3500, "available": 55},
          {"name": "VIP Floor",         "price": 7000, "available": 18},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQBVRHWKBAate79pso9-qtG7KSGq5I2UprDsA&s",
        "description": "The virtual idol phenomenon comes to life with stunning holographic performances and a full festival experience.",
        "dates": [
          {"label": "February 20, 2027", "time": "5:00 PM"},
          {"label": "February 21, 2027", "time": "5:00 PM"},
        ],
        "tiers": [
          {"name": "General",    "price": 1500, "available": 350},
          {"name": "Premium",    "price": 3000, "available": 80},
          {"name": "Ultra VIP",  "price": 6500, "available": 20},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDxe35dj5YviHHBSRHrEZH3wuk_e70X3CM0Q&s",
        "description": "Japan's most powerful voice, Ado, makes her Philippine debut in what promises to be an electrifying performance.",
        "dates": [
          {"label": "March 10, 2027", "time": "7:00 PM"},
        ],
        "tiers": [
          {"name": "General Admission", "price": 2500, "available": 200},
          {"name": "Lower Box",         "price": 4000, "available": 60},
          {"name": "VIP",               "price": 8500, "available": 15},
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
        "image": "https://climatepledgearena.com/wp-content/uploads/2025/05/25-Laufey_CPA-Web_1600x900.jpg",
        "description": "Icelandic singer-songwriter Laufey enchants Manila with her jazz-pop sound and stunning orchestral arrangements.",
        "dates": [
          {"label": "April 5, 2027", "time": "7:30 PM"},
        ],
        "tiers": [
          {"name": "General Admission", "price": 2500, "available": 160},
          {"name": "Lower Box",         "price": 4200, "available": 50},
          {"name": "VIP Floor",         "price": 9000, "available": 12},
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
        "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqkgJb8uKCbWDDTQnM53jlsgiNOc-2gjbkew&s",
        "description": "A dazzling live stage adaptation of the hit film, complete with acrobats, aerialists, and live orchestral music.",
        "dates": [
          {"label": "May 20, 2027", "time": "7:00 PM"},
          {"label": "May 21, 2027", "time": "3:00 PM"},
          {"label": "May 22, 2027", "time": "7:00 PM"},
        ],
        "tiers": [
          {"name": "Orchestra",   "price": 3200, "available": 85},
          {"name": "Mezzanine",   "price": 5000, "available": 40},
          {"name": "Premium Box", "price": 9500, "available": 8},
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
            <div class="lg:col-span-2">
              <div class="relative">
                <img src="${e.image}" alt="${e.title}" class="w-full h-96 object-cover rounded-2xl">
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
      renderPage();
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