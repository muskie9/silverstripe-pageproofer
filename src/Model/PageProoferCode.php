<?php

namespace Muskie9\PageProofer\Model;

use SilverStripe\Control\Director;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * Class PageProoferCode
 * @package Muskie9\PageProofer\Model
 */
class PageProoferCode extends DataObject implements PermissionProvider
{

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Code' => 'Varchar(255)',
        'Domain' => 'Varchar(255)',
        'Enabled' => 'Boolean',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'SiteConfig' => SiteConfig::class,
    ];

    /**
     * @var array
     */
    private static $defaults = [
        'Enabled' => true,
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Title' => 'Title',
        'Enabled.Nice' => 'Enabled',
    ];

    /**
     * @var array
     */
    private static $index = [
        'Code',
        'Domain',
    ];

    /**
     * @var string
     */
    private static $table_name = 'PageProoferCode';

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
            [
                TextField::create('Title')
                    ->setTitle('Code Title')
                    ->setRightTitle('example: Test Site'),
                TextField::create('Code')
                    ->setTitle('Code'),
                TextField::create('Domain')
                    ->setTitle('Domain'),
                CheckboxField::create('Enabled')
                    ->setTitle('Enabled'),
            ]
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
            $result->addError('A Title is required before you can save this PageProofer record.');
        }

        if (!$this->Code) {
            $result->addError('A Code is required before you can save this PageProofer record.');
        }

        if (!$this->Domain) {
            $result->addError('A Domain is required before you can save this PageProofer record.');
        }

        return $result;
    }

    /**
     * @return bool
     */
    public function getIsActiveCode()
    {
        $domain = preg_replace('#^https?://#', '', rtrim($this->Domain, '/'));
        $currentSite = preg_replace('#^https?://#', '', rtrim(Director::absoluteBaseURL(), '/'));
        return ($domain == $currentSite && $this->Enabled);
    }

    /**
     * returns a PageProoferCode based on a given code
     *
     * @param string|null $code
     * @return bool|PageProoferCode
     */
    public static function get_by_code($code = null)
    {
        if ($code === null) {
            return false;
        }
        return static::get()->filter('Code', $code)->first();
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

    /**
     * @return array
     */
    public function providePermissions()
    {
        return [
            'PageProofer_MANAGE' => 'Manage Page Proofer Codes',
        ];
    }

    /**
     * @param null $member
     * @param array $context
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        return Permission::check('PageProofer_MANAGE', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canEdit($member = null)
    {
        return Permission::check('PageProofer_MANAGE', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool|int
     */
    public function canDelete($member = null)
    {
        return Permission::check('PageProofer_MANAGE', 'any', $member);
    }

    /**
     * @param null $member
     * @return bool
     */
    public function canView($member = null)
    {
        return true;
    }
}
