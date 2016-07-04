<?php

use Staffim\DateTime\Date;
use Staffim\DateTime\DateTime;

class DateTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateDate()
    {
        $date = new Date('now');

        $this->assertEquals($date->format('H:i:s'), '00:00:00');
        $this->assertEquals($date->format('u'), '0');
    }

    /**
     * @expectedException RuntimeException
     */
    public function testSetTime()
    {
        $date = new Date('now');

        $date->setTime(0, 2, 3);
    }

    public function testModify()
    {
        $date = new Date('now');

        $modifiedDate = $date->modify('+1 minute');
        $this->assertEquals($modifiedDate->format('H:i:s'), '00:00:00');

        $modifiedDate = $date->modify('+1 day');
        $this->assertNotEquals($modifiedDate->format('d'), $date->format('d'));
    }

    public function testAsDateTime()
    {
        $date = new Date('now');

        $this->assertStringEndsWith('.000000+0000', $date->toIsoString());

        $dateTime = $date->asDateTime();
        $this->assertInstanceOf('\Staffim\DateTime\DateTime', $dateTime);

        $this->assertStringEndsWith('.000000+0000', $dateTime->toIsoString());
    }

    public function testFormatToIso()
    {
        $date = new Date('now');
        $this->assertStringEndsWith('.000000+0000', $date->toIsoString());
    }

    public function testDateBeforeUnixTime()
    {
        $date = DateTime::createFromFormat('d.m.Y u', '06.06.1799 654321');
        $nativeDate = $date->asNativeDate();
        $this->assertNotFalse($nativeDate);
        $this->assertNotFalse($date->asDate());
        $this->assertEquals($date->format(DateTime::FULL_ISO8601), $nativeDate->format(DateTime::FULL_ISO8601));
    }
}
