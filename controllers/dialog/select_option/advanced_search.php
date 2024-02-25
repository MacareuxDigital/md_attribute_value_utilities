<?php

namespace Concrete\Package\MdAttributeValueUtilities\Controller\Dialog\SelectOption;

use Concrete\Controller\Dialog\Search\AdvancedSearch as AdvancedSearchController;
use Concrete\Core\Entity\Search\SavedSearch;
use Concrete\Core\Page\Page;
use Concrete\Core\Permission\Checker;
use Concrete\Core\Search\Field\ManagerFactory;
use Concrete\Core\Support\Facade\Url;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\SearchProvider;

class AdvancedSearch extends AdvancedSearchController
{
    protected $supportsSavedSearch = false;

    public function getFieldManager()
    {
        return ManagerFactory::get('select_option');
    }

    public function getSavedSearchBaseURL(SavedSearch $search)
    {
        // Does not support presets
        return '';
    }

    public function getBasicSearchBaseURL()
    {
        return (string) Url::to('/dashboard/system/attributes/select_options');
    }

    public function getCurrentSearchBaseURL()
    {
        return (string) Url::to('/dashboard/system/attributes/select_options');
    }

    public function getSavedSearchEntity()
    {
        // Does not support presets
        return null;
    }

    public function getSearchProvider()
    {
        return $this->app->make(SearchProvider::class);
    }

    public function getSearchPresets()
    {
        // Does not support presets
        return [];
    }

    protected function canAccess()
    {
        $dashboardPage = Page::getByPath('/dashboard/system/attributes/select_options');
        $checker = new Checker($dashboardPage);

        return $checker->canViewPage();
    }
}
