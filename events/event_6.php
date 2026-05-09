<?php
// events/event_6.php

$event = [
    "id"          => 6,
    "title"       => "Music Festival 2026",
    "category"    => "festival",
    "type"        => "Festival",
    "date"        => "June 20, 2026",
    "location"    => "Mall of Asia Grounds",
    "price"       => "₱1,800",
    "images"      => [
        "https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/88477c99-c357-4758-a37e-b1b750215b2f/compose?aspectRatio=1.78&format=webp&width=1200",
        "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
        "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
        "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
    ],
    "description" => "A massive outdoor festival featuring the best local and international acts. Three stages, 12 hours of music.",
    "dates" => [
        ["label" => "Sat, Jun 20", "time" => "12:00 PM"],
        ["label" => "Sun, Jun 21", "time" => "12:00 PM"],
    ],
    "tiers" => [
        ["name" => "General Admission", "price" => 1200, "available" => 5000, "color" => "zinc"],
        ["name" => "Day + Night Pass", "price" => 1800, "available" => 1500, "color" => "blue"],
        ["name" => "VIP Lounge", "price" => 4500, "available" => 200, "color" => "violet"],
    ]
];