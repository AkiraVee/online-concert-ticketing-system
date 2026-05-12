<?php
// events/event_1.php

$event = [
    "id"          => 1,
    "title"       => "Taylor Swift | The Eras Tour",
    "category"    => "concert",
    "type"        => "Concert",
    "date"        => "May 20, 2026",
    "location"    => "Philippine Arena, Bulacan",
    "price"       => "₱3,500",
    "images"      => [
        "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
        "Images/taylor-swift-1681860050.jpg",
        "Images/taylor-swift-1681860494.jpg",
        "Images/SeatPlanTaylor.jpg",
    ],
    "description" => "The most spectacular tour of the decade returns to the Philippines. Taylor Swift brings all her eras to life in one unforgettable night.",
    "dates" => [
        ["label" => "Sat, May 16", "time" => "6:00 PM"],
        ["label" => "Sun, May 17", "time" => "5:30 PM"],
        ["label" => "Wed, May 20", "time" => "7:00 PM"]
    ],
    "tiers" => [
        ["name" => "VIP PIT", "price" => 26000, "status" => "Seated/Standing", "available" => 5000, "color" => "violet"],
        ["name" => "Floor Standing", "price" => 19500, "status" => "General Admission", "available" => 8000, "color" => "violet"],
        ["name" => "LBA Lower Box A Premium", "price" => 18500, "status" => "Reserved Seating", "available" => 4500, "color" => "blue"],
        ["name" => "LBA Lower Box A Regular", "price" => 16500, "status" => "Reserved Seating", "available" => 6000, "color" => "blue"],
        ["name" => "LBB Lower Box B Premium", "price" => 15500, "status" => "Reserved Seating", "available" => 5500, "color" => "blue"],
        ["name" => "LBB Lower Box B Regular", "price" => 13500, "status" => "Reserved Seating", "available" => 7000, "color" => "blue"],
        ["name" => "UBA Upper Box A Premium", "price" => 11000, "status" => "Reserved Seating", "available" => 6000, "color" => "zinc"],
        ["name" => "UBB Upper Box B Premium", "price" => 9000, "status" => "Reserved Seating", "available" => 4000, "color" => "zinc"],
        ["name" => "UBB Upper Box B Sides", "price" => 7500, "status" => "Reserved Seating", "available" => 2500, "color" => "zinc"],
        ["name" => "UBB Upper Box B Regular", "price" => 6000, "status" => "Reserved Seating", "available" => 4000, "color" => "zinc"],
        ["name" => "UBC Upper Box C Premium", "price" => 5000, "status" => "Reserved Seating", "available" => 3000, "color" => "zinc"],
        ["name" => "UBC Upper Box C Regular", "price" => 3500, "status" => "Reserved Seating", "available" => 1500, "color" => "zinc"],
    ]
];