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

}