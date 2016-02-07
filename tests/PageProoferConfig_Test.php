<?php

/**
 * Class PageProoferConfig_Test
 */
class PageProoferConfig_Test extends PP_Test
{

    /**
     *
     */
    public function testGetPageProofer()
    {
        $this->assertTrue(PageProoferConfig::get_page_proofer()->ID != 0);
    }

    /**
     * Test that our PageProoferCodes GridField exists in SiteConfig
     */
    public function testSiteConfigFields()
    {
        $siteConfig = singleton('SiteConfig');
        $fields = $siteConfig->getCMSFields();

        $this->assertTrue($fields->fieldPosition('PageProoferCodes') != false);

    }

}