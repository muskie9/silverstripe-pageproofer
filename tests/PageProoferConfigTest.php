<?php

namespace Muskie9\PageProofer\Tests;

use Muskie9\PageProofer\Model\PageProoferCode;
use SilverStripe\Control\Director;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\ORM\ValidationException;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * Class PageProoferConfigTest
 * @package Muskie9\PageProofer\Tests
 */
class PageProoferConfigTest extends SapphireTest
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
     * Test that our PageProoferCodes GridField exists in SiteConfig
     */
    public function testSiteConfigFields()
    {
        $siteConfig = SiteConfig::singleton();
        $fields = $siteConfig->getCMSFields();

        $this->assertTrue($fields->fieldPosition('PageProoferCodes') != false);
    }
}
