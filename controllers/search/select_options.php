<?php

namespace Concrete\Package\MdAttributeValueUtilities\Controller\Search;

use Concrete\Controller\Search\Standard;
use Concrete\Core\Page\Page;
use Concrete\Core\Permission\Checker;
use Concrete\Core\Search\Field\Field\KeywordsField;
use Concrete\Package\MdAttributeValueUtilities\Controller\Dialog\SelectOption\AdvancedSearch;

class SelectOptions extends Standard
{
    protected function canAccess()
    {
        $dashboardPage = Page::getByPath('/dashboard/system/attributes/select_options');
        $checker = new Checker($dashboardPage);

        return $checker->canViewPage();
    }

    protected function getAdvancedSearchDialogController()
    {
        return $this->app->make(AdvancedSearch::class);
    }

    protected function getSavedSearchPreset($presetID)
    {
        // Does not support presets
        return null;
    }

    protected function getBasicSearchFieldsFromRequest()
    {
        $fields = parent::getBasicSearchFieldsFromRequest();
        $keywords = h($this->request->get('keywords'));
        if ($keywords) {
            $fields[] = new KeywordsField($keywords);
        }

        return $fields;
    }
}
