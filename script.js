const events = [
    {
      id: 1,
      title: "Taylor Swift | The Eras Tour",
      category: "concert",
      date: "May 20, 2026",
      location: "Philippine Arena, Bulacan",
      price: "₱3,500",
      image: "https://picsum.photos/id/1015/400/250",
      type: "Concert",
    },
    {
      id: 2,
      title: "PBA: Ginebra vs TNT",
      category: "sports",
      date: "May 15, 2026",
      location: "Smart Araneta Coliseum",
      price: "₱500",
      image: "https://picsum.photos/id/201/400/250",
      type: "Sports",
    },
    {
      id: 3,
      title: "Miss Saigon - Manila",
      category: "theatre",
      date: "June 10, 2026",
      location: "Newport Performing Arts Theater",
      price: "₱2,200",
      image: "https://picsum.photos/id/237/400/250",
      type: "Theatre",
    },
    {
      id: 4,
      title: "Coldplay World Tour",
      category: "concert",
      date: "July 5, 2026",
      location: "MOA Arena, Pasay",
      price: "₱1,500",
      image: "https://picsum.photos/id/870/400/250",
      type: "Concert",
    },
    {
      id: 5,
      title: "UAAP Men's Basketball: Ateneo vs La Salle",
      category: "sports",
      date: "May 25, 2026",
      location: "Smart Araneta Coliseum",
      price: "₱500",
      image: "https://picsum.photos/id/180/400/250",
      type: "Sports",
    },
    {
      id: 6,
      title: "Music Festival 2026",
      category: "festival",
      date: "June 20, 2026",
      location: "Mall of Asia Grounds",
      price: "₱1,800",
      image: "https://picsum.photos/id/1016/400/250",
      type: "Festival",
    },
    {
      id: 7,
      title: "Hamilton - Manila",
      category: "theatre",
      date: "August 15, 2026",
      location: "Newport Performing Arts Theater",
      price: "₱3,000",
      image: "https://picsum.photos/id/1025/400/250",
      type: "Theatre",
    },
    {
      id: 8,
      title: "Daniel Ceasar Live in Manila",
      category: "concert",
      date: "September 10, 2026",
      location: "Philippine Arena, Bulacan",
      price: "₱2,750",
      image: "https://picsum.photos/id/1027/400/250",
      type: "Concert",
    },
    {
      id: 9,
      title: "My Chemical Romance Reunion Tour",
      category: "concert",
      date: "October 5, 2026",
      location: "MOA Arena, Pasay",
      price: "₱1,800",
      image: "https://picsum.photos/id/1033/400/250",
      type: "Concert",
    },
    {
      id: 10,
      title: "Bruno Mars 24K Magic Tour",
      category: "concert",
      date: "November 20, 2026",
      location: "Philippine Arena, Bulacan",
      price: "₱2,500",
      image: "https://picsum.photos/id/1035/400/250",
      type: "Concert",
    },
    {
      id: 11,
      title: "Epic: The Musical - Manila",
      category: "theatre",
      date: "December 10, 2026",
      location: "Newport Performing Arts Theater",
      price: "₱2,800",
      image: "https://picsum.photos/id/1040/400/250",
      type: "Theatre",
    },
    {
      id: 12,
      title: "The 1975 Live in Manila",
      category: "concert",
      date: "January 15, 2027",
      location: "MOA Arena, Pasay",
      price: "₱1,975",
      image: "https://picsum.photos/id/1041/400/250",
      type: "Concert",
    },
    {
      id: 13,
      title: "Hatsune Miku Expo 2026",
      category: "festival",
      date: "February 20, 2027",
      location: "Mall of Asia Grounds",
      price: "₱1,500",
      image: "https://picsum.photos/id/1042/400/250",
      type: "Festival",
    },
    {
      id: 14,
      title: "Ado Live in Manila",
      category: "concert",
      date: "March 10, 2027",
      location: "Philippine Arena, Bulacan",
      price: "₱2,500",
      image: "https://picsum.photos/id/1043/400/250",
      type: "Concert",
    },
    {
      id: 15,
      title: "LAUFEY A MATTER OF TIME TOUR",
      category: "concert",
      date: "April 5, 2027",
      location: "MOA Arena, Pasay",
      price: "₱2,500",
      image: "https://picsum.photos/id/1044/400/250",
      type: "Concert",
    },
    {
      id: 16,
      title: "The Greatest Showman Live Experience",
      category: "theatre",
      date: "May 20, 2027",
      location: "Newport Performing Arts Theater",
      price: "₱3,200",
      image: "https://picsum.photos/id/1045/400/250",
      type: "Theatre",
    },
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
  
    grid.innerHTML = list
      .map(
        (e) => `
        <div class="card bg-zinc-900 border border-zinc-800 rounded-2xl overflow-hidden cursor-pointer" onclick="viewEvent(${e.id})">
          <img src="${e.image}" class="w-full h-44       <div class="flex justify-between mb-2">
              <span class="text-xs px-2.5 py-1 bg-violet-950 text-violet-400 rounded-full">${e.type}</span>
              <span class="text-xs text-zinc-500">${e.date}</span>
            </div>
            <h3 class="text-white font-semibold mb-1">${e.title}</h3>
            <p class="text-zinc-500 text-xs mb-4">${e.location}</p>
            <div class="flex justify-between">
              <span class="text-violet-400 font-semibold">${e.price}</span>
              <button class="text-xs bg-zinc-800 hover:bg-zinc-700 px-3 py-1.5 rounded-lg"
                onclick="event.stopPropagation(); isLoggedIn() ? viewEvent(${e.id}) : openLoginPrompt()">
                Buy →
              </button>
            </div>
          </div>
        </div>
      `
      )
      .join("");
  }
  
  function setFilter(cat) {
    currentFilter = cat;
    document.querySelectorAll(".filter-btn").forEach((b) => {
      const isActive = b.dataset.cat === cat;
      b.className = `filter-btn text-sm px-4 py-2 rounded-lg ${
        isActive
          ? "bg-violet-600 text-white"
          : "bg-zinc-800 text-zinc-300 hover:bg-zinc-700"
      }`;
    });
    applyFilters();
  }
  
  function applyFilters() {
    const q = document.getElementById("searchInput").value.toLowerCase().trim();
    let list =
      currentFilter === "all"
        ? events
        : events.filter((e) => e.category === currentFilter);
  
    if (q)
      list = list.filter(
        (e) =>
          e.title.toLowerCase().includes(q) ||
          e.location.toLowerCase().includes(q)
      );
  
    renderEvents(list);
  }
  
  function performSearch() {
    applyFilters();
  }
  
  function resetFilters() {
    document.getElementById("searchInput").value = "";
    setFilter("all");
  }
  
  function viewEvent(id) {
    window.location.href = `event-details.html?eventId=${id}`;
  }
  
  document.addEventListener("DOMContentLoaded", () => {
    document
      .getElementById("searchInput")
      .addEventListener("keypress", (e) => {
        if (e.key === "Enter") performSearch();
      });
    renderEvents(events);
  });