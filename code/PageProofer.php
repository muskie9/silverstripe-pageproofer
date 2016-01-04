<?php

/**
 * Class PageProofer
 */
class PageProofer extends Extension
{

    /**
     *
     */
    public function onAfterInit()
    {
        if ($code = PageProoferConfig::get_page_proofer()) {
            $data = ArrayData::create(array(
                'Code' => $code->Code
            ));

            Requirements::customScript($data->renderWith('PageProofer'));
            ;
        }
    }
}
