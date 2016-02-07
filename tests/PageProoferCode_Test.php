<?php

class PageProoferCode_Test extends PP_Test
{

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

        $pageProoferCodeFields = singleton('PageProoferCode');
        $fields = $pageProoferCodeFields->getCMSFields();

        $this->assertInstanceOf('TextField', $fields->fieldByName('Root.Main.Title'));
        $this->assertInstanceOf('TextField', $fields->fieldByName('Root.Main.Code'));
        $this->assertInstanceOf('TextField', $fields->fieldByName('Root.Main.Domain'));
        $this->assertInstanceOf('CheckboxField', $fields->fieldByName('Root.Main.Enabled'));

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
        $this->setExpectedException('ValidationException');
        $code1->write();
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
        $this->setExpectedException('ValidationException');
        $code1->write();
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
        $this->setExpectedException('ValidationException');
        $code1->write();
    }

}