<?php

// events/event_15.php

$event = [
    "id"          => 15,
    "title"       => "Laufey A Matter of Time Tour",
    "category"    => "concert",
    "type"        => "Concert",
    "date"        => "May 2026",
    "location"    => "MOA Arena, Pasay",
    "price"       => "₱2,500",
    "images"      => [
        "Images/laufey_30042026120056.jpg",
        "Images/laufeypic1.png",
        "Images/laufeypic2.png",
        "Images/laufeyseatplan.jpg",
    ],
    "description" => "Icelandic singer-songwriter Laufey enchants Manila with her jazz-pop sound and stunning orchestral arrangements.",
    "dates" => [
        ["label" => "Tue, May 26", "time" => "8:00 PM"],
        ["label" => "Wed, May 27", "time" => "8:00 PM"],
        ["label" => "Thu, May 28", "time" => "8:00 PM"],
    ],
    "tiers" => [
        ["name" => "SVIP SEATED", "price" => 9500, "status" => "Reserved Seating", "available" => 800, "color" => "violet"],
        ["name" => "VIP A PREMIUM", "price" => 8500, "status" => "Reserved Seating", "available" => 1200, "color" => "blue"],
        ["name" => "VIP A REGULAR", "price" => 7750, "status" => "Reserved Seating", "available" => 1500, "color" => "blue"],
        ["name" => "VIP A REGULAR RESTRICTED VIEW", "price" => 7750, "status" => "Reserved Seating", "available" => 400, "color" => "blue"],
        ["name" => "VIP B PREMIUM", "price" => 7250, "status" => "Reserved Seating", "available" => 1800, "color" => "blue"],
        ["name" => "VIP B REGULAR", "price" => 6500, "status" => "Reserved Seating", "available" => 2200, "color" => "blue"],
        ["name" => "VIP B REGULAR RESTRICTED VIEW", "price" => 6500, "status" => "Reserved Seating", "available" => 500, "color" => "blue"],
        ["name" => "SVIP STANDING", "price" => 5500, "status" => "Standing", "available" => 2500, "color" => "violet"],
        ["name" => "BOX A PREMIUM", "price" => 4500, "status" => "Reserved Seating", "available" => 2000, "color" => "zinc"],
        ["name" => "BOX B PREMIUM", "price" => 3500, "status" => "Reserved Seating", "available" => 2500, "color" => "zinc"],
        ["name" => "BOX B RESTRICTED VIEW", "price" => 3500, "status" => "Reserved Seating", "available" => 600, "color" => "zinc"],
        ["name" => "BOX REGULAR", "price" => 2500, "status" => "Reserved Seating", "available" => 3500, "color" => "zinc"],
        ["name" => "BOX REGULAR RESTRICTED VIEW", "price" => 2500, "status" => "Reserved Seating", "available" => 1000, "color" => "zinc"],
    ]
];