<?php
// events/event_3.php

$event = [
    "id"          => 3,
    "title"       => "Miss Saigon - Manila",
    "category"    => "theatre",
    "type"        => "Theatre",
    "date"        => "June 10, 2026",
    "location"    => "Newport Performing Arts Theater",
    "price"       => "₱2,200",
    "images"      => [
        "https://theaterfansmanila.com/wp-content/uploads/2023/10/Miss-Saigon-feat-pic.jpg",
        "https://deadline.com/wp-content/uploads/2019/07/miss-saigon.jpg?w=1000",
        "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBTUuVJH8ovV-Qzn48k8NFv41p7nLmAHJk5g&s",
        "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRKzX1SR_ebc2cByW5MRSuB69z53MF-H8bMcg&s",
    ],
    "description" => "The legendary West End and Broadway musical comes to Manila. A timeless story of love and war set in the final days of the Vietnam War.",
    "dates" => [
        ["label" => "Tue, Jun 10", "time" => "8:00 PM"],
        ["label" => "Wed, Jun 11", "time" => "3:00 PM"],
        ["label" => "Sat, Jun 14", "time" => "8:00 PM"],
        ["label" => "Sun, Jun 15", "time" => "2:00 PM"],
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