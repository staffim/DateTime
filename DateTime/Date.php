<?php

namespace Staffim\DateTime;

class Date extends DateTime
{
    /**
     * @inheritdoc
     */
    public function __construct($dt = null, $tz = null)
    {
        $date = new \DateTime($dt, $tz);
        $date->setTime(0, 0, 0);

        parent::__construct($date->format(\DateTime::ISO8601), $tz);
    }

    /**
     * @throws \RuntimeException
     */
    public function setTime($hour, $minute, $second = 0)
    {
        throw new \RuntimeException('Can\'t set time on date');
    }

    /**
     * @param string $modify
     * @return \Staffim\DateTime\Date
     */
    public function modify($modify)
    {
        return new static(parent::modify($modify));
    }

    /**
     * @return \Staffim\DateTime\DateTime
     */
    public function asDateTime()
    {
        return new DateTime($this->format(static::FULL_ISO8601), $this->getTimezone());
    }
}
