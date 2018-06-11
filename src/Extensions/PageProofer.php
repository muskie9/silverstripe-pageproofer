<?php

namespace Muskie9\PageProofer\Extensions;

use Muskie9\PageProofer\Model\PageProoferCode;
use SilverStripe\Core\Extension;
use SilverStripe\View\ArrayData;
use SilverStripe\View\Requirements;

/**
 * Class PageProofer
 * @package Muskie9\PageProofer\Extensions
 */
class PageProofer extends Extension
{
    /**
     *
     */
    public function onAfterInit()
    {
        if ($code = PageProoferCode::get_page_proofer()) {
            $data = ArrayData::create([
                'Code' => $code->Code,
            ]);

            Requirements::customScript($data->renderWith('PageProofer'));
        }
    }
}
