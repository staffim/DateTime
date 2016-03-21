<?php

if (!function_exists('now')) {
    function now() {
        return \Staffim\DateTime\Calendar::now();
    }
}

if (!function_exists('today')) {
    function today() {
        return \Staffim\DateTime\Calendar::today();
    }
}

if (!function_exists('monday')) {
    function monday(\DateTimeInterface $date = null) {
        return \Staffim\DateTime\Calendar::monday($date);
    }
}
