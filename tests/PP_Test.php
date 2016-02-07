<?php

class PP_Test extends FunctionalTest
{
    //protected static $fixture_file = '';
    protected static $disable_themes = true;
    protected static $use_draft_site = false;

    public function setUp()
    {
        parent::setUp();
        ini_set('display_errors', 1);
        ini_set("log_errors", 1);
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

        $code1 = PageProoferCode::create();
        $code1->Title = 'Test code 1';
        $code1->Code = '12345345';
        $code1->Domain = 'http://muskie9.com/';
        $code1->Enabled = true;
        $code1->write();

        $code2 = PageProoferCode::create();
        $code2->Title = 'Test code 2';
        $code2->Code = '123456789';
        $code2->Enabled = true;
        $code2->Domain = rtrim(Director::absoluteBaseURL(), '/');
        $code2->write();

    }

    public function logOut()
    {
        $this->session()->clear('loggedInAs');
    }

    public function testPP()
    {
    }
}