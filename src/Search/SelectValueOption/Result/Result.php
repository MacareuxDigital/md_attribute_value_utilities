<?php

namespace Macareux\AttributeValueUtilities\Search\SelectValueOption\Result;

use Concrete\Core\Search\Result\Result as SearchResult;

class Result extends SearchResult
{
    public function getItemDetails($item)
    {
        $node = new Item($this, $this->listColumns, $item);

        return $node;
    }

    public function getColumnDetails($column)
    {
        $node = new Column($this, $column);

        return $node;
    }

    /**
     * @return \Concrete\Core\Search\Pagination\Pagination
     */
    public function getPagination()
    {
        return $this->pagination;
    }
}