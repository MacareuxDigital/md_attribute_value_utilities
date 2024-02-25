<?php

namespace Macareux\AttributeValueUtilities\Search\SelectValueOption;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\Search\AbstractSearchProvider;
use Concrete\Core\Search\Field\ManagerFactory;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\ColumnSet\Available;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\ColumnSet\ColumnSet;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\ColumnSet\DefaultSet;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\Result\Result;

class SearchProvider extends AbstractSearchProvider implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    public function getBaseColumnSet()
    {
        return new ColumnSet();
    }

    public function getDefaultColumnSet()
    {
        return new DefaultSet();
    }

    public function getCurrentColumnSet()
    {
        return ColumnSet::getCurrent();
    }

    public function getAvailableColumnSet()
    {
        return new Available();
    }

    public function createSearchResultObject($columns, $list)
    {
        return new Result($columns, $list);
    }

    public function getCustomAttributeKeys()
    {
        // Not attribute keys
        return [];
    }

    public function getItemList()
    {
        return $this->app->make(SelectValueOptionList::class);
    }

    public function getSavedSearch()
    {
        // Does not support presets
        return null;
    }

    public function getSessionNamespace()
    {
        return 'select_value_option';
    }

    public function getFieldManager()
    {
        return ManagerFactory::get('select_option');
    }
}
