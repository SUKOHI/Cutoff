# Cutoff
A Laravel package to manage cutoff day.
(As of now, only for Laravel 4)

Installation
====

Add this package name in composer.json

    "require": {
      "sukohi/cutoff": "1.*"
    }

Execute composer command.

    composer update

Register the service provider in app.php

    'providers' => [
        ...Others...,  
        'Sukohi\Cutoff\CutoffServiceProvider',
    ]

Also alias

    'aliases' => [
        ...Others...,  
        'Cutoff' => 'Sukohi\Cutoff\Facades\Cutoff',
    ]
    
Usage
====

*Next Cutoff Date*

    $base_dt = new Carbon('2015-2-28');
    $cutoff_day = 25;
    echo Cutoff::nextDate($base_dt, $cutoff_day)->toDateString();   // 2015-03-25

*Prev Cutoff Date*

    $base_dt = new Carbon('2015-2-28');
    $cutoff_day = 25;
    echo Cutoff::prevDate($base_dt, $cutoff_day)->toDateString();   // 2015-01-25

*Range*

    $year = 2015;
    $month = 2;
    $day = 31;
    Cutoff::range($year, $month, $day);  // start => 2015-02-01, end => 2015-02-28 23:59:59
        
License
====
This package is licensed under the MIT License.

Copyright 2015 Sukohi Kuhoh