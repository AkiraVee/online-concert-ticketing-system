<?php
// events/event_16.php

$event = [
    "id"          => 16,
    "title"       => "The Greatest Showman Live Experience",
    "category"    => "theatre",
    "type"        => "Theatre",
    "date"        => "May 20, 2027",
    "location"    => "Newport Performing Arts Theater",
    "price"       => "₱1,500",
    "images"      => [
        "Images/poster1great.png",
        "Images/poster2great.png",
        "Images/poster3great.png",
        "Images/greatseatplan.png",
    ],
    "description" => "A dazzling live stage adaptation of the hit film, complete with acrobats, aerialists, and live orchestral music.",
    "dates" => [
        ["label" => "Sat, May 20", "time" => "8:00 PM"],
    ],
    "tiers" => [
        ["name" => "PLATINUM", "price" => 8500, "status" => "Reserved Seating", "available" => 250, "color" => "violet"],
        ["name" => "SVIP", "price" => 7500, "status" => "Reserved Seating", "available" => 350, "color" => "violet"],
        ["name" => "VIP", "price" => 6500, "status" => "Reserved Seating", "available" => 400, "color" => "blue"],
        ["name" => "GOLD", "price" => 4500, "status" => "Reserved Seating", "available" => 300, "color" => "blue"],
        ["name" => "SILVER", "price" => 3500, "status" => "Reserved Seating", "available" => 200, "color" => "zinc"],
        ["name" => "BRONZE", "price" => 1500, "status" => "Reserved Seating", "available" => 240, "color" => "zinc"],
    ]
];