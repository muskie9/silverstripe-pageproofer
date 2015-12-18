<?php

/**
 * Class PageProoferConfig
 */
class PageProoferConfig extends DataExtension
{

    /**
     * @var array
     */
    private static $has_many = array(
        'PageProoferCodes' => 'PageProoferCode',
    );

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab('Root', new TabSet('PageProofer', 'PageProofer'));

        $fields->addFieldToTab(
            'Root.PageProofer.PageProoferCodes',
            GridField::create('PageProoferCodes', 'Page Proofer Codes', PageProoferCode::get(), GridFieldConfig_RecordEditor::create())
        );
    }

    /**
     * @return mixed
     */
    public static function get_page_proofer()
    {
        return PageProoferCode::get()->filterByCallback(function ($code) {
            return $code->getIsActiveCode();
        })->first();
    }
}
