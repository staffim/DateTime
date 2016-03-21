<?php

use Staffim\DateTime\Calendar;
use Staffim\DateTime\DateTime;

class CalendarTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMonday()
    {
        $monday = Calendar::monday();

        $this->assertEquals($monday->format('w'), 1);
        $this->assertStringEndsWith('00:00:00.000000+0000', $monday->toIsoString());
    }

    public function testGetMondayFromDate()
    {
        $nativeDate = new \DateTime('now');
        $this->assertStringEndsNotWith('00:00:00+0000', $nativeDate->format(\DateTime::ISO8601));

        $monday = Calendar::monday($nativeDate);
        $this->assertEquals($monday->format('w'), 1);
        $this->assertStringEndsWith('00:00:00.000000+0000', $monday->toIsoString());

        $date = new DateTime('now');
        $this->assertStringEndsNotWith('00:00:00.000000+0000', $date->toIsoString());

        $monday = Calendar::monday($date);
        $this->assertEquals($monday->format('w'), 1);
        $this->assertStringEndsWith('00:00:00.000000+0000', $monday->toIsoString());
    }

    public function testMondayAsDate()
    {
        $monday = Calendar::monday();

        $this->assertEquals($monday->toIsoString(), $monday->asDate()->toIsoString());
    }
}
