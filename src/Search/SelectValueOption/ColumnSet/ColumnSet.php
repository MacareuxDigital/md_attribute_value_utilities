<?php

namespace Macareux\AttributeValueUtilities\Search\SelectValueOption\ColumnSet;

use Concrete\Core\Search\Column\Set;
use Concrete\Core\Support\Facade\Facade;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\SearchProvider;

class ColumnSet extends Set
{
    public static function getCurrent()
    {
        $app = Facade::getFacadeApplication();
        /**
         * @var $provider SearchProvider
         */
        $provider = $app->make(SearchProvider::class);
        $query = $provider->getSessionCurrentQuery();
        if ($query) {
            return $query->getColumns();
        }

        return new DefaultSet();
    }
}