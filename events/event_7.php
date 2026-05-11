<?php
// events/event_7.php

$event = [
    "id"          => 7,
    "title"       => "Hamilton - Manila",
    "category"    => "theatre",
    "type"        => "Theatre",
    "date"        => "August 15, 2026",
    "location"    => "Newport Performing Arts Theater",
    "price"       => "₱2,645",
    "images"      => [
        "Images/hamiltonposter.png",
        "Images/hamiltonpic1.png",
        "Images/hamiltonpic2.webp",
        "Images/hamiltonseatplan.png",
    ],
    "description" => "The award-winning Broadway phenomenon finally arrives in Manila. Hamilton tells the story of America's Founding Father through hip-hop, jazz, and R&B.",
    "dates" => [
        ["label" => "Fri, Aug 14", "time" => "8:00 PM"],
        ["label" => "Sat, Aug 15", "time" => "3:00 PM"],
        ["label" => "Sun, Aug 16", "time" => "2:00 PM"],
    ],
    "tiers" => [
        ["name" => "PLATINUM", "price" => 8993, "status" => "Reserved Seating", "available" => 250, "color" => "violet"],
        ["name" => "SVIP", "price" => 6348, "status" => "Reserved Seating", "available" => 350, "color" => "violet"],
        ["name" => "VIP", "price" => 5819, "status" => "Reserved Seating", "available" => 400, "color" => "blue"],
        ["name" => "GOLD", "price" => 4761, "status" => "Reserved Seating", "available" => 300, "color" => "blue"],
        ["name" => "SILVER", "price" => 3703, "status" => "Reserved Seating", "available" => 200, "color" => "zinc"],
        ["name" => "BRONZE", "price" => 2645, "status" => "Reserved Seating", "available" => 240, "color" => "zinc"],
    ]
];