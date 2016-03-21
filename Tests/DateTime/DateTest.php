<?php

use Staffim\DateTime\Date;

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
}
