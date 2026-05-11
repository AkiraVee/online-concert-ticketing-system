<?php
// events/event_6.php

$event = [
    "id"          => 6,
    "title"       => "Music Festival 2026",
    "category"    => "festival",
    "type"        => "Festival",
    "date"        => "June 20, 2026",
    "location"    => "Mall of Asia Arena",
    "price"       => "₱1,800",
    "images"      => [
        "Images/musicfesposter.png",
        "Images/musicfespic1.png",
        "Images/musicfespic2.png",
        "Images/musicfesseatplan.jpg",
    ],
    "description" => "A massive outdoor festival featuring the best local and international acts. Three stages, 12 hours of music.",
    "dates" => [
        ["label" => "Sat, Jun 20", "time" => "12:00 PM"],
    ],
    "tiers" => [
        ["name" => "Moshpit", "price" => 11500, "available" => 2800, "color" => "violet"],
        ["name" => "SVIP Seated & Center", "price" => 10500, "available" => 950, "color" => "violet"],
        ["name" => "VIP A", "price" => 8950, "available" => 650, "color" => "blue"],
        ["name" => "VIP B", "price" => 7950, "available" => 850, "color" => "blue"],
        ["name" => "Gold", "price" => 5950, "available" => 1800, "color" => "zinc"],
        ["name" => "Silver", "price" => 4950, "available" => 3200, "color" => "zinc"],
        ["name" => "Bronze", "price" => 3450, "available" => 4500, "color" => "zinc"],
    ]
];