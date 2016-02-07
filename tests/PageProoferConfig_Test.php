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

}