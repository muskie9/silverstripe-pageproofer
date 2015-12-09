<?php

/**
 * Class PageProoferCode
 */
class PageProoferCode extends DataObject
{

    /**
     * @var array
     */
    private static $db = array(
        'Title' => 'Varchar(255)',
        'Code' => 'Varchar(255)',
        'Domain' => 'Varchar(255)',
        'Enabled' => 'Boolean',
    );

    /**
     * @var array
     */
    private static $has_one = array(
        'SiteConfig' => 'SiteConfig'
    );

    /**
     * @var array
     */
    private static $defaults = array(
        'Enabled' => true
    );

    /**
     * @var array
     */
    private static $summary_fields = array(
        'Title' => 'Title',
        'Enabled.Nice' => 'Enabled'
    );

    /**
     * @var array
     */
    private static $index = array(
        'Code',
        'Domain',
    );

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {

        $fields = FieldList::create(
            new TabSet(
                $name = "Root"
            )
        );

        $fields->addFieldsToTab(
            'Root.Main',
            array(
                TextField::create('Title')
                    ->setTitle('Code Title')
                    ->setRightTitle('example: Test Site'),
                TextField::create('Code')
                    ->setTitle('Code'),
                TextField::create('Domain')
                    ->setTitle('Domain'),
                CheckboxField::create('Enabled')
                    ->setTitle('Enabled')
            )
        );

        return $fields;

    }

    /**
     * @return ValidationResult
     */
    public function validate()
    {
        $result = parent::validate();

        if (!$this->Title) {
            $result->error('A Title is required before you can save this PageProofer record.');
        }

        if (!$this->Code) {
            $result->error('A Code is required before you can save this PageProofer record.');
        }

        if (!$this->Domain) {
            $result->error('A Domain is required before you can save this PageProofer record.');
        }

        return $result;

    }

    /**
     * @return bool
     */
    public function getIsActiveCode()
    {

        $domain = preg_replace('#^https?://#', '', rtrim($this->Domain,'/'));
        $currentSite = preg_replace('#^https?://#', '', rtrim(Director::absoluteBaseURL(),'/'));
        return ($domain == $currentSite && $this->Enabled);
    }

}