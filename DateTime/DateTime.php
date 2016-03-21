<?php

namespace Staffim\DateTime;

class DateTime extends \DateTimeImmutable implements \JsonSerializable
{
    const FULL_ISO8601 = 'Y-m-d\TH:i:s.uO';

    /**
     * @param string $dt
     * @param \DateTimeZone|null $tz
     */
    public function __construct($dt = 'now', $tz = null)
    {
        if (is_null($dt) || $dt === 'now') {
            $date = \DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
        } else {
            $date = new \DateTime($dt, $tz);
        }

        parent::__construct($date->format(self::FULL_ISO8601));
    }

    /**
     * @param \DateTimeInterface $dateTime
     * @return \Staffim\DateTime\DateTime
     */
    public static function createFromNativeDate(\DateTimeInterface $dateTime)
    {
        return new static($dateTime->format(self::FULL_ISO8601));
    }

    /**
     * @param string $format
     * @param string $time
     * @param \DateTimeZone $timezone
     *
     * @return \Staffim\DateTime\DateTime
     */
    public static function createFromFormat($format, $time, $timezone = null)
    {
        /**
         * @see https://bugs.php.net/bug.php?id=69565
         */
        if ($timezone) {
            return static::createFromNativeDate(parent::createFromFormat($format, $time, $timezone));
        } else {
            return static::createFromNativeDate(parent::createFromFormat($format, $time));
        }
    }


    /**
     * Complete date plus hours, minutes, seconds and microseconds in UTC timezone:
     * <code>
     * 1997-07-16T19:20:30.000231+0000
     * </code>
     *
     * @return string
     */
    public function toIsoString()
    {
        return $this->format(self::FULL_ISO8601);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toIsoString();
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->toIsoString();
    }

    /**
     * @return \Staffim\DateTime\Date
     */
    public function asDate()
    {
        return Date::createFromFormat('U.u', $this->format('U.u'), $this->getTimezone());
    }

    /**
     * @return \DateTime
     */
    public function asNativeDate()
    {
        return \DateTime::createFromFormat('U.u', $this->format('U.u'), $this->getTimezone());
    }
}
