<?php
// events/event_10.php

$event = [
    "id"          => 10,
    "title"       => "Bruno Mars 24K Magic Tour",
    "category"    => "concert",
    "type"        => "Concert",
    "date"        => "November 20, 2026",
    "location"    => "Philippine Arena, Bulacan",
    "price"       => "₱2,750",
    "images"      => [
        "Images/marsposter.png",
        "Images/bruno.png",
        "Images/test.jpg",
        "Images/brunoseatplannnnnnnnnnnnnn.jpg",
    ],
    "description" => "Bruno Mars is back and bringing the 24K Magic tour to the Philippines. Expect an electrifying night of his biggest hits.",
    "dates" => [
        ["label" => "Fri, Nov 20", "time" => "8:00 PM"],
    ],
    "tiers" => [
        ["name" => "FLOOR", "price" => 18750, "status" => "Floor Standing", "available" => 2800, "color" => "violet"],
        ["name" => "LBA PREMIUM", "price" => 17750, "status" => "Reserved Seating", "available" => 1450, "color" => "blue"],
        ["name" => "LBA REGULAR", "price" => 16000, "status" => "Reserved Seating", "available" => 1850, "color" => "blue"],
        ["name" => "LBB PREMIUM", "price" => 13750, "status" => "Reserved Seating", "available" => 1650, "color" => "blue"],
        ["name" => "LBB REGULAR", "price" => 11250, "status" => "Reserved Seating", "available" => 2200, "color" => "blue"],
        ["name" => "UBA", "price" => 7250, "status" => "Reserved Seating", "available" => 3200, "color" => "zinc"],
        ["name" => "UBB", "price" => 5500, "status" => "Reserved Seating", "available" => 3800, "color" => "zinc"],
        ["name" => "UBC", "price" => 2750, "status" => "Reserved Seating", "available" => 6500, "color" => "zinc"],
    ]
];