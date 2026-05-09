<?php
// events/event_2.php

$event = [
    "id"          => 2,
    "title"       => "PBA: Ginebra vs TNT",
    "category"    => "sports",
    "type"        => "Sports",
    "date"        => "May 15, 2026",
    "location"    => "Smart Araneta Coliseum",
    "price"       => "₱500",
    "images"      => [
        "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToBiCMqMOD48wLnF7cLJWIty31xw8Dmf3gOw&s",
        "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStfpu5gL8vKcfQNhvj8FgkE42A4QNO-3uxmA&s",
        "https://cdn-0001.qstv.on.epicgames.com/LZGCXcoMsVIGYlcyBG/image/landscape_comp.jpeg",
        "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWnjhwzD22W08_Pu0on6saTiwQhpnTQ5gRaw&s",
    ],
    "description" => "Barangay Ginebra faces off against the TNT Tropang Giga in a highly anticipated PBA clash. Don't miss the action!",
    "dates" => [
        ["label" => "Wed, May 15", "time" => "7:00 PM"],
        ["label" => "Sat, May 18", "time" => "4:00 PM"],
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