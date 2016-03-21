<?php

namespace Staffim\DateTime;

class Calendar
{
    public static function now()
    {
        return new DateTime('now');
    }

    public static function today()
    {
        return self::now()->asDate()->asDateTime();
    }

    public static function monday(\DateTimeInterface $date = null)
    {
        if ($date) {
            $today = DateTime::createFromFormat('U', $date->format('U'), $date->getTimezone())->asDate()->asDateTime();
        } else {
            $today = self::today();
        }

        if ($today->format('w') < 1) {
            $monday = $today->modify('-6 day');
        } else {
            $monday = $today->modify('-' . ($today->format('w') - 1) . ' day');
        }

        return $monday;
    }
}
