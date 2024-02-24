<?php

namespace Concrete\Package\MdAttributeValueUtilities;

use Concrete\Core\Package\Package;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Single;
use Doctrine\ORM\Tools\SchemaTool;
use Macareux\AttributeValueUtilities\Entity\SelectValueOptionOption;
use Macareux\AttributeValueUtilities\Service\ServiceProvider;

class Controller extends Package
{
    protected $pkgHandle = 'md_attribute_value_utilities';
    protected $appVersionRequired = '8.5.0';
    protected $pkgVersion = '0.0.1';
    protected $pkgAutoloaderRegistries = [
        'src' => '\Macareux\AttributeValueUtilities',
    ];

    public function getPackageName()
    {
        return t('Macareux Attribute Value Utilities');
    }

    public function getPackageDescription()
    {
        return t('A package that provides a set of utilities to work with attribute values.');
    }

    public function install()
    {
        $pkg = parent::install();

        $this->installSinglePages();

        return $pkg;
    }

    public function uninstall()
    {
        $em = $this->getPackageEntityManager();
        $schemaTool = new SchemaTool($em);
        $classes = [
            $em->getClassMetadata(SelectValueOptionOption::class),
        ];
        $schemaTool->dropSchema($classes);

        parent::uninstall();
    }

    public function on_start()
    {
        $provider = new ServiceProvider($this->app);
        $provider->register();
    }

    private function installSinglePages()
    {
        $page = Page::getByPath('/dashboard/system/attributes/select_options');
        if (!is_object($page) || $page->isError()) {
            Single::add('/dashboard/system/attributes/select_options', $this);
        }
    }
}