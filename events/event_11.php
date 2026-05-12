<?php
// events/event_11.php

$event = [
    "id"          => 11,
    "title"       => "Epic: The Musical - Manila",
    "category"    => "theatre",
    "type"        => "Theatre",
    "date"        => "December 10, 2026",
    "location"    => "Newport Performing Arts Theater",
    "price"       => "₱1,545",
    "images"      => [
        "Images/poster1.png",
        "Images/poster2.png",
        "Images/poster3.png",
        "Images/seatplanepic.jpg",
    ],
    "description" => "The internet-famous musical adaptation of Homer's Odyssey comes to Manila's stage for a limited run.",
    "dates" => [
        ["label" => "Thu, Dec 10", "time" => "8:00 PM"],
    ],
    "tiers" => [
        ["name" => "PLATINUM", "price" => 6180, "status" => "Reserved Seating", "available" => 250, "color" => "violet"],
        ["name" => "SVIP", "price" => 5768, "status" => "Reserved Seating", "available" => 350, "color" => "violet"],
        ["name" => "VIP", "price" => 5150, "status" => "Reserved Seating", "available" => 400, "color" => "blue"],
        ["name" => "GOLD", "price" => 4120, "status" => "Reserved Seating", "available" => 300, "color" => "blue"],
        ["name" => "SILVER", "price" => 3090, "status" => "Reserved Seating", "available" => 200, "color" => "zinc"],
        ["name" => "BRONZE", "price" => 1545, "status" => "Reserved Seating", "available" => 240, "color" => "zinc"],
    ]
];