<?php

namespace Macareux\AttributeValueUtilities\Search\SelectValueOption;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\Search\AbstractSearchProvider;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\ColumnSet\Available;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\ColumnSet\ColumnSet;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\ColumnSet\DefaultSet;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\Result\Result;

class SearchProvider extends AbstractSearchProvider implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    function getBaseColumnSet()
    {
        return new ColumnSet();
    }

    function getDefaultColumnSet()
    {
        return new DefaultSet();
    }

    function getCurrentColumnSet()
    {
        return ColumnSet::getCurrent();
    }

    function getAvailableColumnSet()
    {
        return new Available();
    }

    function createSearchResultObject($columns, $list)
    {
        return new Result($columns, $list);
    }

    function getCustomAttributeKeys()
    {
        // Not attribute keys
        return [];
    }

    function getItemList()
    {
        return $this->app->make(SelectValueOptionList::class);
    }

    function getSavedSearch()
    {
        // Does not support presets
        return null;
    }

    function getSessionNamespace()
    {
        return 'select_value_option';
    }
}
