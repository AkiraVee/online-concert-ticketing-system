<?php
// events/event_4.php

$event = [
    "id"          => 4,
    "title"       => "Coldplay World Tour",
    "category"    => "concert",
    "type"        => "Concert",
    "date"        => "July 5, 2026",
    "location"    => "Philippine Arena, Bulacan",
    "price"       => "₱1,500",
    "images"      => [
        "Images/coldpayposter.png",
        "Images/coldplaypicture.jpg",
        "Images/coldplaypicture2.jpg",
        "Images/coldplayseatplan.jpg",
    ],
    "description" => "Coldplay's Music of the Spheres World Tour arrives in Manila. Expect a breathtaking light show and all your favourite anthems.",
    "dates" => [
        ["label" => "Sun, Jul 5", "time" => "7:30 PM"],
        ["label" => "Mon, Jul 6", "time" => "7:30 PM"],
    ],
    "tiers" => [
        ["name" => "FLOOR STANDING", "price" => 11000, "status" => "Standing", "available" => 2500, "color" => "white"],
        ["name" => "LBA PREMIUM 1", "price" => 22000, "status" => "Reserved Seating", "available" => 800, "color" => "pink"],
        ["name" => "LBA PREMIUM 2", "price" => 21000, "status" => "Reserved Seating", "available" => 900, "color" => "red"],
        ["name" => "LBA REGULAR 1", "price" => 20000, "status" => "Reserved Seating", "available" => 1200, "color" => "purple"],
        ["name" => "LBA REGULAR 2", "price" => 17000, "status" => "Reserved Seating", "available" => 1500, "color" => "darkred"],
        ["name" => "LBB PREMIUM", "price" => 15000, "status" => "Reserved Seating", "available" => 1800, "color" => "orange"],
        ["name" => "LBB REGULAR 1", "price" => 13000, "status" => "Reserved Seating", "available" => 2200, "color" => "lightorange"],
        ["name" => "LBB REGULAR 2", "price" => 11000, "status" => "Reserved Seating", "available" => 2000, "color" => "brown"],
        ["name" => "UBA PREMIUM", "price" => 10000, "status" => "Reserved Seating", "available" => 2500, "color" => "violet"],
        ["name" => "UBA REGULAR", "price" => 8500, "status" => "Reserved Seating", "available" => 3000, "color" => "yellow"],
        ["name" => "UBB", "price" => 6500, "status" => "Reserved Seating", "available" => 2800, "color" => "lightpurple"],
        ["name" => "UBC", "price" => 5000, "status" => "Reserved Seating", "available" => 3500, "color" => "cyan"],
        ["name" => "UBD", "price" => 4000, "status" => "Reserved Seating", "available" => 4000, "color" => "darkblue"],
        ["name" => "UBB SIDES", "price" => 3000, "status" => "Reserved Seating", "available" => 1500, "color" => "lightgreen"],
        ["name" => "UBC SIDES", "price" => 2500, "status" => "Reserved Seating", "available" => 1800, "color" => "green"]
    ]
];