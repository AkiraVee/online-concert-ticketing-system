<?php
// events/event_13.php

$event = [
    "id"          => 13,
    "title"       => "Hatsune Miku Expo 2026",
    "category"    => "festival",
    "type"        => "Festival",
    "date"        => "February 20, 2027",
    "location"    => "Mall of Asia Arena",
    "price"       => "₱1,500",
    "images"      => [
        "Images/MikuExpo.jpg",
        "Images/mikupic.png",
        "Images/mikupic2.png",
        "Images/mikuseatplan.png",
    ],
    "description" => "The virtual idol phenomenon comes to life with stunning holographic performances and a full festival experience.",
    "dates" => [
        ["label" => "Mon, Nov 16", "time" => "8:00 PM"],
    ],
    "tiers" => [
        ["name" => "VIP", "price" => 10880, "available" => 450, "color" => "violet"],
        ["name" => "Premium", "price" => 8880, "available" => 1200, "color" => "blue"],
        ["name" => "Patron", "price" => 7880, "available" => 1000, "color" => "blue"],
        ["name" => "Lower Box A", "price" => 6880, "available" => 2200, "color" => "zinc"],
        ["name" => "Lower Box B", "price" => 5880, "available" => 1800, "color" => "zinc"],
        ["name" => "Lower Box C", "price" => 4880, "available" => 1200, "color" => "zinc"],
        ["name" => "Upper Box", "price" => 3880, "available" => 3500, "color" => "zinc"],
        ["name" => "Gen Ad", "price" => 2880, "available" => 2500, "color" => "zinc"],
    ]
];