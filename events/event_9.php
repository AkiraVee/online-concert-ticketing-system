<?php
// events/event_9.php

$event = [
    "id"          => 9,
    "title"       => "My Chemical Romance Reunion Tour",
    "category"    => "concert",
    "type"        => "Concert",
    "date"        => "November 14, 2026",
    "location"    => "Philippine Arena, Bulacan",
    "price"       => "₱2,120",
    "images"      => [
        "Images/mcrposter.png",
        "Images/mcrpic1.png",
        "Images/mcrpic2.png",
        "Images/mcrseatplan.jpg",
    ],
    "description" => "They're not okay — they're BACK. My Chemical Romance reunites for a world tour and Manila is on the list.",
    "dates" => [
        ["label" => "Sat, Nov 14", "time" => "8:00 PM"],
    ],
    "tiers" => [
        ["name" => "VIP Standing", "price" => 21200, "status" => "Standing", "available" => 1800, "color" => "red"],
        ["name" => "Standing A", "price" => 18550, "status" => "Standing", "available" => 2200, "color" => "red"],
        ["name" => "Standing B", "price" => 14840, "status" => "Standing", "available" => 3500, "color" => "red"],
        ["name" => "VIP Seated", "price" => 15900, "status" => "Reserved Seating", "available" => 3200, "color" => "orange"],
        ["name" => "Lower Box A Premium", "price" => 13250, "status" => "Reserved Seating", "available" => 2800, "color" => "orange"],
        ["name" => "Lower Box A Regular", "price" => 11130, "status" => "Reserved Seating", "available" => 4500, "color" => "yellow"],
        ["name" => "Lower Box B Premium", "price" => 7950, "status" => "Reserved Seating", "available" => 3800, "color" => "blue"],
        ["name" => "Lower Box B Regular", "price" => 6890, "status" => "Reserved Seating", "available" => 5200, "color" => "green"],
        ["name" => "Upper Box A", "price" => 4770, "status" => "Reserved Seating", "available" => 6500, "color" => "purple"],
        ["name" => "Upper Box B Premium", "price" => 3180, "status" => "Reserved Seating", "available" => 5800, "color" => "violet"],
        ["name" => "Upper Box B Regular", "price" => 2120, "status" => "Reserved Seating", "available" => 8500, "color" => "pink"]
    ]
];