<?php
// events/event_5.php

$event = [
    "id"          => 5,
    "title"       => "UAAP Men's Basketball: Ateneo vs La Salle",
    "category"    => "sports",
    "type"        => "Sports",
    "date"        => "May 25, 2026",
    "location"    => "Smart Araneta Coliseum",
    "price"       => "₱500",
    "images"      => [
        "Images/uaapposter2.png",
        "Images/uaapateneo.png",
        "Images/uaaplasalle.png",
        "Images/uaapseatplan.jpg",
    ],
    "description" => "The most intense rivalry in Philippine college basketball. Blue Eagles vs Green Archers — who will reign supreme?",
    "dates" => [
        ["label" => "Mon, May 25", "time" => "12:00 PM"],
        ["label" => "Sun, May 31", "time" => "2:00 PM"],
    ],
    "tiers" => [
        ["name" => "SEATED VIP", "price" => 3300, "status" => "Reserved Seating", "available" => 150, "color" => "violet"],
        ["name" => "PATRON A", "price" => 1000, "status" => "Reserved Seating", "available" => 800, "color" => "violet"],
        ["name" => "PATRON B", "price" => 950, "status" => "Reserved Seating", "available" => 1200, "color" => "violet"],
        ["name" => "PATRON C", "price" => 900, "status" => "Reserved Seating", "available" => 1500, "color" => "violet"],
        ["name" => "LOWER BOX A", "price" => 600, "status" => "Reserved Seating", "available" => 2000, "color" => "blue"],
        ["name" => "LOWER BOX B", "price" => 500, "status" => "Reserved Seating", "available" => 2500, "color" => "blue"],
    ]
];