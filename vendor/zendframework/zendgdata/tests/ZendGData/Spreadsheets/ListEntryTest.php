<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   ZendGData
 */

namespace ZendGDataTest\Spreadsheets;

use ZendGData\Spreadsheets;
use ZendGData\Spreadsheets\Extension;
use ZendGData\App;

/**
 * @category   Zend
 * @package    ZendGData\Spreadsheets
 * @subpackage UnitTests
 * @group      ZendGData
 * @group      ZendGData\Spreadsheets
 */
class ListEntryTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->listEntry = new Spreadsheets\ListEntry();
        $this->rowData = array();
        $this->rowData[] = new Extension\Custom(
            'column_1', 'value 1');
        $this->rowData[] = new Extension\Custom(
            'column_2', 'value 2');
    }

    public function testToAndFromString()
    {
        $this->listEntry->setCustom($this->rowData);
        $rowDataOut = $this->listEntry->getCustom();

        $this->assertEquals(count($this->rowData), count($rowDataOut));
        for ($i = 0; $i < count($this->rowData); $i++) {
        $this->assertEquals($this->rowData[$i]->getText(),
             $rowDataOut[$i]->getText());
        $this->assertEquals($this->rowData[$i]->getColumnName(),
            $rowDataOut[$i]->getColumnName());
        }

        $newListEntry = new Spreadsheets\ListEntry();
        $doc = new \DOMDocument();
        $doc->loadXML($this->listEntry->saveXML());
        $newListEntry->transferFromDom($doc->documentElement);
        $rowDataFromXML = $newListEntry->getCustom();

        $this->assertEquals(count($this->rowData), count($rowDataFromXML));
        for ($i = 0; $i < count($this->rowData); $i++) {
        $this->assertEquals($this->rowData[$i]->getText(),
             $rowDataFromXML[$i]->getText());
        $this->assertEquals($this->rowData[$i]->getColumnName(),
            $rowDataFromXML[$i]->getColumnName());
        }
    }

    public function testCustomElementOrderingPreserved()
    {
        $this->listEntry->setCustom($this->rowData);

        $this->assertEquals(count($this->rowData),
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));
        for ($i = 0; $i < count($this->rowData); $i++) {
            $this->assertEquals($this->rowData[$i],
                $this->listEntry->custom[$i]);
        }
    }

    public function testCustomElementsCanBeRetrievedByName()
    {
        $this->listEntry->setCustom($this->rowData);

        $this->assertEquals(count($this->rowData),
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));
        for ($i = 0; $i < count($this->rowData); $i++) {
            $this->assertEquals($this->rowData[$i],
                $this->listEntry->getCustomByName(
                    $this->rowData[$i]->getColumnName()));
        }
    }

    public function testCustomElementsCanBeRetrievedByNameUsingArrayNotation()
    {
        $this->listEntry->setCustom($this->rowData);

        $this->assertEquals(count($this->rowData),
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));
        for ($i = 0; $i < count($this->rowData); $i++) {
            $this->assertEquals($this->rowData[$i],
                $this->listEntry->getCustomByName(
                    $this->rowData[$i]->getColumnName()));
        }
    }

    public function testCanAddIndividualCustomElements()
    {
        for ($i = 0; $i < count($this->rowData); $i++) {
            $this->listEntry->addCustom($this->rowData[$i]);
        }

        $this->assertEquals(count($this->rowData),
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));
        for ($i = 0; $i < count($this->rowData); $i++) {
            $this->assertEquals($this->rowData[$i],
                $this->listEntry->custom[$i]);
        }
    }

    public function testRetrievingNonexistantCustomElementReturnsNull()
    {
        $this->assertNull($this->listEntry->getCustomByName('nonexistant'));
    }

    public function testCanReplaceAllCustomElements()
    {
        $this->listEntry->setCustom($this->rowData);
        $this->assertEquals(count($this->rowData),
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));
        $this->listEntry->setCustom(array());
        $this->assertEquals(0, count($this->listEntry->getCustom()));
    }

    public function testCanDeleteCustomElementById()
    {
        $this->listEntry->setCustom($this->rowData);
        $this->assertEquals(count($this->rowData),
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));
        $this->assertEquals($this->rowData[0], $this->listEntry->custom[0]);

        $this->listEntry->removeCustom(0);
        $this->assertEquals(count($this->rowData) - 1,
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));
        $this->assertEquals($this->rowData[1], $this->listEntry->custom[0]);
    }

    public function testCanDeleteCustomElementByName()
    {
        $this->listEntry->setCustom($this->rowData);
        $this->assertEquals(count($this->rowData),
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));
        $this->assertEquals($this->rowData[0],
            $this->listEntry->getCustomByName(
                $this->rowData[0]->getColumnName()));

        $this->listEntry->removeCustomByName('column_1');
        $this->assertEquals(count($this->rowData) - 1,
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));
        $this->assertNull($this->listEntry->getCustomByName(
            $this->rowData[0]->getColumnName()));
    }

    public function testDeletingNonexistantElementByIdThrowsException()
    {
        $this->listEntry->setCustom($this->rowData);
        $this->assertEquals(count($this->rowData),
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));

        $exceptionCaught = false;
        try {
            $this->listEntry->removeCustom(9999);
        } catch (App\InvalidArgumentException $e) {
            $exceptionCaught = true;
            $this->assertEquals('Element does not exist.', $e->getMessage());
        }
        $this->assertTrue($exceptionCaught);
    }

    public function testDeletingNonexistantElementByNameThrowsException()
    {
        $this->listEntry->setCustom($this->rowData);
        $this->assertEquals(count($this->rowData),
            count($this->listEntry->getCustom()));
        $this->assertEquals(count($this->listEntry->getCustom()),
            count($this->listEntry->getCustomByName()));

        $exceptionCaught = false;
        try {
            $this->listEntry->removeCustomByName('nonexistant');
        } catch (App\InvalidArgumentException $e) {
            $exceptionCaught = true;
            $this->assertEquals('Element does not exist.', $e->getMessage());
        }
        $this->assertTrue($exceptionCaught);
    }

}