<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   ZendGData
 */

namespace ZendGDataTest\GApps;

use ZendGData\GApps\Extension;

/**
 * @category   Zend
 * @package    ZendGData\GApps
 * @subpackage UnitTests
 * @group      ZendGData
 * @group      ZendGData\GApps
 */
class LoginTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->loginText = file_get_contents(
                'ZendGData/GApps/_files/LoginElementSample1.xml',
                true);
        $this->login = new Extension\Login();
    }

    public function testEmptyLoginShouldHaveNoExtensionElements()
    {
        $this->assertTrue(is_array($this->login->extensionElements));
        $this->assertTrue(count($this->login->extensionElements) == 0);
    }

    public function testEmptyLoginShouldHaveNoExtensionAttributes()
    {
        $this->assertTrue(is_array($this->login->extensionAttributes));
        $this->assertTrue(count($this->login->extensionAttributes) == 0);
    }

    public function testSampleLoginShouldHaveNoExtensionElements()
    {
        $this->login->transferFromXML($this->loginText);
        $this->assertTrue(is_array($this->login->extensionElements));
        $this->assertTrue(count($this->login->extensionElements) == 0);
    }

    public function testSampleLoginShouldHaveNoExtensionAttributes()
    {
        $this->login->transferFromXML($this->loginText);
        $this->assertTrue(is_array($this->login->extensionAttributes));
        $this->assertTrue(count($this->login->extensionAttributes) == 0);
    }

    public function testNormalLoginShouldHaveNoExtensionElements()
    {
        $this->login->username = "johndoe";
        $this->login->password = "abcdefg1234567890";
        $this->login->hashFunctionName = "Foo";
        $this->login->suspended = true;
        $this->login->admin = true;
        $this->login->changePasswordAtNextLogin = true;
        $this->login->agreedToTerms = false;

        $this->assertEquals("johndoe", $this->login->username);
        $this->assertEquals("abcdefg1234567890", $this->login->password);
        $this->assertEquals("Foo", $this->login->hashFunctionName);
        $this->assertEquals(true, $this->login->suspended);
        $this->assertEquals(true, $this->login->admin);
        $this->assertEquals(true, $this->login->changePasswordAtNextLogin);
        $this->assertEquals(false, $this->login->agreedToTerms);

        $this->assertEquals(0, count($this->login->extensionElements));
        $newLogin = new Extension\Login();
        $newLogin->transferFromXML($this->login->saveXML());
        $this->assertEquals(0, count($newLogin->extensionElements));
        $newLogin->extensionElements = array(
                new \ZendGData\App\Extension\Element('foo', 'atom', null, 'bar'));
        $this->assertEquals(1, count($newLogin->extensionElements));
        $this->assertEquals("johndoe", $newLogin->username);
        $this->assertEquals("abcdefg1234567890", $newLogin->password);
        $this->assertEquals("Foo", $newLogin->hashFunctionName);
        $this->assertEquals(true, $newLogin->suspended);
        $this->assertEquals(true, $newLogin->admin);
        $this->assertEquals(true, $newLogin->changePasswordAtNextLogin);
        $this->assertEquals(false, $newLogin->agreedToTerms);

        /* try constructing using magic factory */
        $gdata = new \ZendGData\GApps();
        $newLogin2 = $gdata->newLogin();
        $newLogin2->transferFromXML($newLogin->saveXML());
        $this->assertEquals(1, count($newLogin2->extensionElements));
        $this->assertEquals("johndoe", $newLogin2->username);
        $this->assertEquals("abcdefg1234567890", $newLogin2->password);
        $this->assertEquals("Foo", $newLogin2->hashFunctionName);
        $this->assertEquals(true, $newLogin2->suspended);
        $this->assertEquals(true, $newLogin2->admin);
        $this->assertEquals(true, $newLogin2->changePasswordAtNextLogin);
        $this->assertEquals(false, $newLogin2->agreedToTerms);
    }

    public function testEmptyLoginToAndFromStringShouldMatch()
    {
        $loginXml = $this->login->saveXML();
        $newLogin = new Extension\Login();
        $newLogin->transferFromXML($loginXml);
        $newLoginXml = $newLogin->saveXML();
        $this->assertTrue($loginXml == $newLoginXml);
    }

    public function testLoginWithValueToAndFromStringShouldMatch()
    {
        $this->login->username = "johndoe";
        $this->login->password = "abcdefg1234567890";
        $this->login->hashFunctionName = "Foo";
        $this->login->suspended = true;
        $this->login->admin = true;
        $this->login->changePasswordAtNextLogin = true;
        $this->login->agreedToTerms = false;
        $loginXml = $this->login->saveXML();
        $newLogin = new Extension\Login();
        $newLogin->transferFromXML($loginXml);
        $newLoginXml = $newLogin->saveXML();
        $this->assertTrue($loginXml == $newLoginXml);
        $this->assertEquals("johndoe", $this->login->username);
        $this->assertEquals("abcdefg1234567890", $this->login->password);
        $this->assertEquals("Foo", $this->login->hashFunctionName);
        $this->assertEquals(true, $this->login->suspended);
        $this->assertEquals(true, $this->login->admin);
        $this->assertEquals(true, $this->login->changePasswordAtNextLogin);
        $this->assertEquals(false, $this->login->agreedToTerms);

    }

    public function testExtensionAttributes()
    {
        $extensionAttributes = $this->login->extensionAttributes;
        $extensionAttributes['foo1'] = array('name'=>'foo1', 'value'=>'bar');
        $extensionAttributes['foo2'] = array('name'=>'foo2', 'value'=>'rab');
        $this->login->extensionAttributes = $extensionAttributes;
        $this->assertEquals('bar', $this->login->extensionAttributes['foo1']['value']);
        $this->assertEquals('rab', $this->login->extensionAttributes['foo2']['value']);
        $loginXml = $this->login->saveXML();
        $newLogin = new Extension\Login();
        $newLogin->transferFromXML($loginXml);
        $this->assertEquals('bar', $newLogin->extensionAttributes['foo1']['value']);
        $this->assertEquals('rab', $newLogin->extensionAttributes['foo2']['value']);
    }

    public function testConvertFullLoginToAndFromString()
    {
        $this->login->transferFromXML($this->loginText);
        $this->assertEquals("SusanJones-1321", $this->login->username);
        $this->assertEquals("123\$\$abc", $this->login->password);
        $this->assertEquals("SHA-1", $this->login->hashFunctionName);
        $this->assertEquals(false, $this->login->suspended);
        $this->assertEquals(false, $this->login->admin);
        $this->assertEquals(false, $this->login->changePasswordAtNextLogin);
        $this->assertEquals(true, $this->login->agreedToTerms);
    }

}
