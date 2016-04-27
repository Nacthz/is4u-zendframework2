<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   ZendGData
 */

namespace ZendGDataTest;

use ZendGData\Extension;

/**
 * @category   Zend
 * @package    ZendGData
 * @subpackage UnitTests
 * @group      ZendGData
 */
class ReminderTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->reminderText = file_get_contents(
                'ZendGData/_files/ReminderElementSample1.xml',
                true);
        $this->reminder = new Extension\Reminder();
    }

    public function testEmptyReminderShouldHaveNoExtensionElements()
    {
        $this->assertTrue(is_array($this->reminder->extensionElements));
        $this->assertTrue(count($this->reminder->extensionElements) == 0);
    }

    public function testEmptyReminderShouldHaveNoExtensionAttributes()
    {
        $this->assertTrue(is_array($this->reminder->extensionAttributes));
        $this->assertTrue(count($this->reminder->extensionAttributes) == 0);
    }

    public function testSampleReminderShouldHaveNoExtensionElements()
    {
        $this->reminder->transferFromXML($this->reminderText);
        $this->assertTrue(is_array($this->reminder->extensionElements));
        $this->assertTrue(count($this->reminder->extensionElements) == 0);
    }

    public function testSampleReminderShouldHaveNoExtensionAttributes()
    {
        $this->reminder->transferFromXML($this->reminderText);
        $this->assertTrue(is_array($this->reminder->extensionAttributes));
        $this->assertTrue(count($this->reminder->extensionAttributes) == 0);
    }

    public function testNormalReminderShouldHaveNoExtensionElements()
    {
        $this->reminder->days = "12";
        $this->reminder->minutes = "64";
        $this->reminder->absoluteTime = "2007-06-19T12:42:19-06:00";
        $this->reminder->method = "email";
        $this->reminder->hours = "80";

        $this->assertEquals("12", $this->reminder->days);
        $this->assertEquals("64", $this->reminder->minutes);
        $this->assertEquals("2007-06-19T12:42:19-06:00", $this->reminder->absoluteTime);
        $this->assertEquals("email", $this->reminder->method);
        $this->assertEquals("80", $this->reminder->hours);

        $this->assertEquals(0, count($this->reminder->extensionElements));
        $newReminder = new Extension\Reminder();
        $newReminder->transferFromXML($this->reminder->saveXML());
        $this->assertEquals(0, count($newReminder->extensionElements));
        $newReminder->extensionElements = array(
                new \ZendGData\App\Extension\Element('foo', 'atom', null, 'bar'));
        $this->assertEquals(1, count($newReminder->extensionElements));
        $this->assertEquals("12", $newReminder->days);
        $this->assertEquals("64", $newReminder->minutes);
        $this->assertEquals("2007-06-19T12:42:19-06:00", $newReminder->absoluteTime);
        $this->assertEquals("email", $newReminder->method);
        $this->assertEquals("80", $newReminder->hours);

        /* try constructing using magic factory */
        $gdata = new \ZendGData\GData();
        $newReminder2 = $gdata->newReminder();
        $newReminder2->transferFromXML($newReminder->saveXML());
        $this->assertEquals(1, count($newReminder2->extensionElements));
        $this->assertEquals("12", $newReminder2->days);
        $this->assertEquals("64", $newReminder2->minutes);
        $this->assertEquals("2007-06-19T12:42:19-06:00", $newReminder2->absoluteTime);
        $this->assertEquals("email", $newReminder2->method);
        $this->assertEquals("80", $newReminder2->hours);
    }

    public function testEmptyReminderToAndFromStringShouldMatch()
    {
        $reminderXml = $this->reminder->saveXML();
        $newReminder = new Extension\Reminder();
        $newReminder->transferFromXML($reminderXml);
        $newReminderXml = $newReminder->saveXML();
        $this->assertTrue($reminderXml == $newReminderXml);
    }

    public function testReminderWithValueToAndFromStringShouldMatch()
    {
        $this->reminder->days = "12";
        $this->reminder->minutes = "64";
        $this->reminder->absoluteTime = "2007-06-19T12:42:19-06:00";
        $this->reminder->method = "email";
        $this->reminder->hours = "80";
        $reminderXml = $this->reminder->saveXML();
        $newReminder = new Extension\Reminder();
        $newReminder->transferFromXML($reminderXml);
        $newReminderXml = $newReminder->saveXML();
        $this->assertTrue($reminderXml == $newReminderXml);
        $this->assertEquals("12", $this->reminder->days);
        $this->assertEquals("64", $this->reminder->minutes);
        $this->assertEquals("2007-06-19T12:42:19-06:00", $this->reminder->absoluteTime);
        $this->assertEquals("email", $this->reminder->method);
        $this->assertEquals("80", $this->reminder->hours);
    }

    public function testExtensionAttributes()
    {
        $extensionAttributes = $this->reminder->extensionAttributes;
        $extensionAttributes['foo1'] = array('name'=>'foo1', 'value'=>'bar');
        $extensionAttributes['foo2'] = array('name'=>'foo2', 'value'=>'rab');
        $this->reminder->extensionAttributes = $extensionAttributes;
        $this->assertEquals('bar', $this->reminder->extensionAttributes['foo1']['value']);
        $this->assertEquals('rab', $this->reminder->extensionAttributes['foo2']['value']);
        $reminderXml = $this->reminder->saveXML();
        $newReminder = new Extension\Reminder();
        $newReminder->transferFromXML($reminderXml);
        $this->assertEquals('bar', $newReminder->extensionAttributes['foo1']['value']);
        $this->assertEquals('rab', $newReminder->extensionAttributes['foo2']['value']);
    }

    public function testConvertFullReminderToAndFromString()
    {
        $this->reminder->transferFromXML($this->reminderText);
        $this->assertEquals("42", $this->reminder->days);
        $this->assertEquals("50", $this->reminder->minutes);
        $this->assertEquals("2005-06-06T16:55:00-08:00", $this->reminder->absoluteTime);
        $this->assertEquals("sms", $this->reminder->method);
        $this->assertEquals("20", $this->reminder->hours);
    }

}
