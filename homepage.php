<?php
// homepage.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Absolute Cinema Tickets</title>
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
      <div class="hidden md:flex items-center gap-6 text-sm text-zinc-400">
      <?php if (isset($_SESSION['UserID'])): ?>
        <a href="profile.php" class="hover:text-white">My Profile</a>
      <?php endif; ?>
      </div>
      <div class="flex items-center gap-3">
      <?php if (isset($_SESSION['UserID'])): ?>
        <a href="logout.php" class="text-sm text-zinc-400 hover:text-white px-3 py-1.5 flex items-center gap-2">
          <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
      <?php else: ?>
        <a href="login.php" class="text-sm text-zinc-400 hover:text-white px-3 py-1.5">Login</a>
        <a href="signup.php" class="text-sm bg-violet-600 hover:bg-violet-500 text-white px-4 py-1.5 rounded-lg">Sign Up</a>
      <?php endif; ?>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <header class="py-20 px-6 text-center"
    style="background: radial-gradient(ellipse at 50% 0%, rgba(124, 58, 237, 0.15) 0%, transparent 70%);">
    <p class="text-violet-400 text-sm font-medium mb-3 tracking-widest uppercase">Live Events</p>
    <h2 class="text-5xl text-white mb-4">Find Your Next<br />Live Experience</h2>
    <p class="text-zinc-400 mb-8 max-w-md mx-auto">Concerts, sports, theatre — all in one place.</p>
    
    <div class="max-w-lg mx-auto flex gap-2">
      <input id="searchInput" type="text" placeholder="Search events or artists..."
        class="flex-1 bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-violet-500" />
      <button onclick="performSearch()" 
        class="bg-violet-600 hover:bg-violet-500 text-white px-5 py-3 rounded-xl text-sm font-medium">Search</button>
    </div>
  </header>

  <!-- Filters -->
  <div class="max-w-6xl mx-auto px-6 pb-6 flex flex-wrap items-center gap-3">
    <button onclick="setFilter('all')" data-cat="all" class="filter-btn active text-sm px-4 py-2 rounded-lg bg-violet-600 text-white">All</button>
    <button onclick="setFilter('concert')" data-cat="concert" class="filter-btn text-sm px-4 py-2 rounded-lg bg-zinc-800 text-zinc-300 hover:bg-zinc-700">Concerts</button>
    <button onclick="setFilter('sports')" data-cat="sports" class="filter-btn text-sm px-4 py-2 rounded-lg bg-zinc-800 text-zinc-300 hover:bg-zinc-700">Sports</button>
    <button onclick="setFilter('theatre')" data-cat="theatre" class="filter-btn text-sm px-4 py-2 rounded-lg bg-zinc-800 text-zinc-300 hover:bg-zinc-700">Theatre</button>
    <button onclick="setFilter('festival')" data-cat="festival" class="filter-btn text-sm px-4 py-2 rounded-lg bg-zinc-800 text-zinc-300 hover:bg-zinc-700">Festivals</button>
    <button onclick="resetFilters()" class="ml-auto text-xs text-zinc-500 hover:text-white flex items-center gap-1.5">
      <i class="fa-solid fa-rotate"></i> Reset
    </button>
  </div>

  <!-- Grid -->
  <main class="max-w-6xl mx-auto px-6 pb-20">
    <div id="eventsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5"></div>
    <p id="emptyMsg" class="hidden text-center text-zinc-500 py-16 text-sm">No events found.</p>
  </main>

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

  <!-- Login Prompt Modal -->
  <div id="loginPromptModal" class="hidden fixed inset-0 z-50 bg-black/70 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-zinc-900 border border-zinc-700 rounded-2xl w-full max-w-sm p-6 relative text-center">
      <button onclick="closeLoginPrompt()" class="absolute top-4 right-4 text-zinc-500 hover:text-white">
        <i class="fa-solid fa-xmark text-lg"></i>
      </button>
      <i class="fa-solid fa-lock text-violet-400 text-4xl mb-4 block"></i>
      <h3 class="text-xl text-white font-semibold mb-2">Sign In Required</h3>
      <p class="text-zinc-400 text-sm mb-6">You need to be logged in to purchase tickets.</p>
      <div class="flex flex-col gap-3">
        <a href="login.php" class="w-full bg-violet-600 hover:bg-violet-500 text-white py-3 rounded-xl font-medium text-sm">Sign In</a>
        <a href="signup.php" class="w-full bg-zinc-800 hover:bg-zinc-700 text-white py-3 rounded-xl font-medium text-sm">Create Account</a>
      </div>
    </div>
  </div>

  <script>
    const events = [
      { id: 1, title: "Taylor Swift | The Eras Tour", category: "concert", date: "May 20, 2026", location: "Philippine Arena, Bulacan", price: "₱3,500", image: "https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/88477c99-c357-4758-a37e-b1b750215b2f/compose?aspectRatio=1.78&format=webp&width=1200", type: "Concert" },
      { id: 2, title: "PBA: Ginebra vs TNT", category: "sports", date: "May 15, 2026", location: "Smart Araneta Coliseum", price: "₱500", image: "Images/bballhomepage.png", type: "Sports" },
      { id: 3, title: "Miss Saigon - Manila", category: "theatre", date: "June 10, 2026", location: "Newport Performing Arts Theater", price: "₱1,500", image: "https://theaterfansmanila.com/wp-content/uploads/2023/10/Miss-Saigon-feat-pic.jpg", type: "Theatre" },
      { id: 4, title: "Coldplay World Tour", category: "concert", date: "July 5, 2026", location: "Philippine Arena, Bulacan", price: "₱1,500", image: "Images/coldpayposter.png", type: "Concert" },
      { id: 5, title: "UAAP Men's Basketball: Ateneo vs La Salle", category: "sports", date: "May 25, 2026", location: "Smart Araneta Coliseum", price: "₱500", image: "Images/uaapposter.png", type: "Sports" },
      { id: 6, title: "Music Festival 2026", category: "festival", date: "June 20, 2026", location: "Mall of Asia Arena", price: "₱1,800", image: "Images/musicfesposter.png", type: "Festival" },
      { id: 7, title: "Hamilton - Manila", category: "theatre", date: "August 15, 2026", location: "Newport Performing Arts Theater", price: "₱2,645", image: "Images/hamiltonposter.png", type: "Theatre" },
      { id: 8, title: "Daniel Caesar Live in Manila", category: "concert", date: "September 10, 2026", location: "Mall of Asia Arena", price: "₱2,750", image: "https://aphrodite.gmanetwork.com/entertainment/articles/1200_675_11_07-04-2026-1513_-20260407151314.jpg", type: "Concert" },
      { id: 9, title: "My Chemical Romance Reunion Tour", category: "concert", date: "October 5, 2026", location: "Philippine Arena, Bulacan", price: "₱2,120", image: "Images/mcrposter.png", type: "Concert" },
      { id: 10, title: "Bruno Mars 24K Magic Tour", category: "concert", date: "November 20, 2026", location: "Philippine Arena, Bulacan", price: "₱2,500", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKOSUoBKa_EU2RjXxdYvmpNWacBQHSG-XyGw&s", type: "Concert" },
      { id: 11, title: "Epic: The Musical - Manila", category: "theatre", date: "December 10, 2026", location: "Newport Performing Arts Theater", price: "₱1,545", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLyeZHMjAKjedyosMPPtKMDEkhXOUGP-FKLQ&s", type: "Theatre" },
      { id: 12, title: "The 1975 Live in Manila", category: "concert", date: "January 15, 2027", location: "MOA Arena, Pasay", price: "₱1,975", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLuM0qZr-iQVhiWeomcFN_JFBMxGoP5FTiow&s", type: "Concert" },
      { id: 13, title: "Hatsune Miku Expo 2026", category: "festival", date: "February 20, 2027", location: "Mall of Asia Arena", price: "₱2,880", image: "Images/MikuExpo.jpg", type: "Festival" },
      { id: 14, title: "Ado Live in Manila", category: "concert", date: "March 10, 2027", location: "Philippine Arena, Bulacan", price: "₱2,500", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDxe35dj5YviHHBSRHrEZH3wuk_e70X3CM0Q&s", type: "Concert" },
      { id: 15, title: "Laufey A Matter of Time Tour", category: "concert", date: "April 5, 2027", location: "MOA Arena, Pasay", price: "₱2,500", image: "https://climatepledgearena.com/wp-content/uploads/2025/05/25-Laufey_CPA-Web_1600x900.jpg", type: "Concert" },
      { id: 16, title: "The Greatest Showman Live Experience", category: "theatre", date: "May 20, 2027", location: "Newport Performing Arts Theater", price: "₱1,500", image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRqkgJb8uKCbWDDTQnM53jlsgiNOc-2gjbkew&s", type: "Theatre" }
    ];

    let currentFilter = "all";

    function isLoggedIn() {
      return localStorage.getItem("userLoggedIn") === "true";
    }

    function openLoginPrompt() {
      document.getElementById("loginPromptModal").classList.remove("hidden");
    }

    function closeLoginPrompt() {
      document.getElementById("loginPromptModal").classList.add("hidden");
    }

    function renderEvents(list) {
      const grid = document.getElementById("eventsGrid");
      const empty = document.getElementById("emptyMsg");

      if (!list.length) {
        grid.innerHTML = "";
        empty.classList.remove("hidden");
        return;
      }

      empty.classList.add("hidden");
      grid.innerHTML = list.map(e => `
        <div class="card bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden cursor-pointer" onclick="viewEvent(${e.id})">
          <img src="${e.image}" alt="${e.title}" class="w-full h-44 object-cover">
          <div class="p-4">
            <div class="flex items-center justify-between mb-2">
              <span class="text-xs px-2.5 py-1 bg-violet-950 text-violet-400 rounded-full">${e.type}</span>
              <span class="text-xs text-zinc-500">${e.date}</span>
            </div>
            <h3 class="text-white font-semibold text-base leading-snug mb-1 line-clamp-2">${e.title}</h3>
            <p class="text-zinc-500 text-xs mb-4 flex items-center gap-1"><i class="fa-solid fa-location-dot"></i> ${e.location}</p>
            <div class="flex items-center justify-between">
              <span class="text-violet-400 font-semibold">${e.price}</span>
              <button onclick="event.stopPropagation(); isLoggedIn() ? viewEvent(${e.id}) : openLoginPrompt()" 
                class="text-xs text-white bg-zinc-800 hover:bg-zinc-700 px-3 py-1.5 rounded-lg">Buy →</button>
            </div>
          </div>
        </div>
      `).join("");
    }

    function viewEvent(id) {
      window.location.href = `event-details.php?eventId=${id}`;
    }

    function setFilter(cat) {
      currentFilter = cat;
      document.querySelectorAll(".filter-btn").forEach((b) => {
        const isActive = b.dataset.cat === cat;
        b.className = `filter-btn text-sm px-4 py-2 rounded-lg ${isActive ? "bg-violet-600 text-white" : "bg-zinc-800 text-zinc-300 hover:bg-zinc-700"}`;
      });
      applyFilters();
    }

    function applyFilters() {
      const q = document.getElementById("searchInput").value.toLowerCase().trim();
      let list = currentFilter === "all" ? events : events.filter((e) => e.category === currentFilter);
      if (q) list = list.filter((e) => e.title.toLowerCase().includes(q) || e.location.toLowerCase().includes(q));
      renderEvents(list);
    }

    function performSearch() {
      applyFilters();
    }

    function resetFilters() {
      document.getElementById("searchInput").value = "";
      setFilter("all");
    }

    document.getElementById("searchInput").addEventListener("keypress", (e) => {
      if (e.key === "Enter") performSearch();
    });

    // Initial Render
    renderEvents(events);
  </script>
</body>
</html>