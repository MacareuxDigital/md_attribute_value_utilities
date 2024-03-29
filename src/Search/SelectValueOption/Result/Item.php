<?php

namespace Macareux\AttributeValueUtilities\Search\SelectValueOption\Result;

use Concrete\Core\Search\Column\Set;
use Concrete\Core\Search\Result\Item as SearchResultItem;
use Concrete\Core\Search\Result\Result as SearchResult;

class Item extends SearchResultItem
{
    protected $selectValueOption;

    public function __construct(SearchResult $result, Set $columns, $item)
    {
        parent::__construct($result, $columns, $item);
        $this->populateDetails($item);
    }

    /**
     * @return \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption
     */
    public function getSelectValueOption()
    {
        return $this->selectValueOption;
    }

    protected function populateDetails($selectValueOption)
    {
        $this->selectValueOption = $selectValueOption;
    }
}
