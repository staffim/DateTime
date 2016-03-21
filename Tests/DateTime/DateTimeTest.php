<?php

use Staffim\DateTime\DateTime;

class DateTimeTest extends \PHPUnit_Framework_TestCase
{

    public function testCreateWithMicroseconds()
    {
        $date = new DateTime('now');
        $this->assertStringEndsNotWith('.000000+0000', $date->toIsoString());
    }

    public function testSetOverTime()
    {
        $date = new DateTime('now');

        $newDate = $date->setTime(25, 0, 0);

        $this->assertNotEquals($date->format('d'), $newDate->format('d'));
        $this->assertEquals($newDate->format('h'), 1);
    }

    public function testAsDate()
    {
        $date = new DateTime('now');

        $day = $date->asDate();
        $this->assertInstanceOf('\Staffim\DateTime\Date', $day);
        $this->assertStringEndsWith('.000000+0000', $day->toIsoString());
    }

    public function testAsNativeDate()
    {
        $date = new DateTime('now');

        $this->assertInstanceOf('\DateTime', $date->asNativeDate());
    }

    public function testFormatToIso()
    {
        $date = DateTime::createFromFormat('U.u', (string) microtime(true));
        $this->assertStringEndsNotWith('.000000+0000', $date->toIsoString());
    }
}
