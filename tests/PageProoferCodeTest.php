<?php

namespace Muskie9\PageProofer\Tests;

use Muskie9\PageProofer\Model\PageProoferCode;
use SilverStripe\Control\Director;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\ValidationResult;
use SilverStripe\Security\Member;

/**
 * Class PageProoferCodeTest
 * @package Muskie9\PageProofer\Tests
 */
class PageProoferCodeTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'fixtures.yml';

    /**
     * @throws ValidationException
     */
    public function setUp()
    {
        parent::setUp();

        if (!$code = PageProoferCode::get_by_code('123456789')) {
            $code = PageProoferCode::create();
            $code->Title = 'Test code 2';
            $code->Code = '123456789';
            $code->Enabled = true;
            $code->Domain = rtrim(Director::absoluteBaseURL(), '/');
            $code->write();
        }
    }

    /**
     * Test that PageProoferCode::get_by_code() returns
     * proper object or false
     */
    public function testGetByCode()
    {
        $code1 = PageProoferCode::get_by_code('12345345');
        $code2 = PageProoferCode::get_by_code('123456789');
        $code3 = PageProoferCode::get_by_code(0);
        $code4 = PageProoferCode::get_by_code();

        $this->assertEquals($code1->Code, '12345345');
        $this->assertEquals($code2->Code, '123456789');
        $this->assertNull($code3);
        $this->assertFalse($code4);
    }

    /**
     * Test that PageProoferCode::getIsActive() is returning
     * proper boolean based on it's parameters
     */
    public function testGetIsActiveCode()
    {
        $code1 = PageProoferCode::get_by_code('12345345');
        $this->assertFalse($code1->getIsActiveCode());

        $code2 = PageProoferCode::get_by_code('123456789');
        $this->assertTrue($code2->getIsActiveCode());
    }

    /**
     * Test that PageProoferCode has all fields intended
     */
    public function testPageProoferCodeFields()
    {
        $pageProoferCodeFields = PageProoferCode::singleton();
        $fields = $pageProoferCodeFields->getCMSFields();

        $this->assertInstanceOf(TextField::class, $fields->fieldByName('Root.Main.Title'));
        $this->assertInstanceOf(TextField::class, $fields->fieldByName('Root.Main.Code'));
        $this->assertInstanceOf(TextField::class, $fields->fieldByName('Root.Main.Domain'));
        $this->assertInstanceOf(CheckboxField::class, $fields->fieldByName('Root.Main.Enabled'));
    }

    /**
     * Test for ValidationException if no Title
     */
    public function testNoTitleValidation()
    {
        $code1 = PageProoferCode::create();
        $code1->Code = '12345345';
        $code1->Domain = 'http://muskie9.com/';
        $code1->Enabled = true;
        $this->assertFalse($code1->validate()->isValid());
    }

    /**
     * Test for ValidationException if no Code
     */
    public function testNoCodeValidation()
    {
        $code1 = PageProoferCode::create();
        $code1->Title = 'Test Code';
        $code1->Domain = 'http://muskie9.com/';
        $code1->Enabled = true;
        $this->assertFalse($code1->validate()->isValid());
    }

    /**
     * Test for ValidationException if no Domain
     */
    public function testNoDomainValidation()
    {
        $code1 = PageProoferCode::create();
        $code1->Title = 'Test Code';
        $code1->Code = '12345345';
        $code1->Enabled = true;
        $this->assertFalse($code1->validate()->isValid());
    }

    /**
     *
     */
    public function testProvidePermissions()
    {
        $permissions = ['PageProofer_MANAGE' => 'Manage Page Proofer Codes'];
        $this->assertEquals($permissions, PageProoferCode::singleton()->providePermissions());
    }

    /**
     *
     */
    public function testCanCreate()
    {
        $code = PageProoferCode::singleton();

        $manager = $this->objFromFixture(Member::class, 'site-owner');
        $this->assertTrue($code->canCreate($manager));

        $blank = Member::singleton();
        $this->assertFalse($code->canCreate($blank));
    }

    /**
     *
     */
    public function testCanEdit()
    {
        $code = PageProoferCode::singleton();

        $manager = $this->objFromFixture(Member::class, 'site-owner');
        $this->assertTrue($code->canEdit($manager));

        $blank = Member::singleton();
        $this->assertFalse($code->canEdit($blank));
    }

    /**
     *
     */
    public function testCanDelete()
    {
        $code = PageProoferCode::singleton();

        $manager = $this->objFromFixture(Member::class, 'site-owner');
        $this->assertTrue($code->canDelete($manager));

        $blank = Member::singleton();
        $this->assertFalse($code->canDelete($blank));
    }

    /**
     *
     */
    public function testCanView()
    {
        $code = PageProoferCode::singleton();

        $manager = $this->objFromFixture(Member::class, 'site-owner');
        $this->assertTrue($code->canView($manager));

        $blank = Member::singleton();
        $this->assertTrue($code->canView($blank));
    }
}
