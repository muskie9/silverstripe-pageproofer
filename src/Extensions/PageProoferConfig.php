<?php

namespace Muskie9\PageProofer\Extensions;

use Muskie9\PageProofer\Model\PageProoferCode;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\TabSet;
use SilverStripe\ORM\DataExtension;

/**
 * Class PageProoferConfig
 * @package Muskie9\PageProofer\Extensions
 */
class PageProoferConfig extends DataExtension
{
    /**
     * @var array
     */
    private static $has_many = [
        'PageProoferCodes' => PageProoferCode::class,
    ];

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root', new TabSet('PageProofer', 'PageProofer'));

        $fields->addFieldToTab(
            'Root.PageProofer.PageProoferCodes',
            GridField::create(
                'PageProoferCodes',
                'Page Proofer Codes',
                PageProoferCode::get(),
                GridFieldConfig_RecordEditor::create()
            )
        );
    }
}
