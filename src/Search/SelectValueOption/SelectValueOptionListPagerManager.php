<?php

namespace Macareux\AttributeValueUtilities\Search\SelectValueOption;

use Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption;
use Concrete\Core\Search\ItemList\Pager\Manager\AbstractPagerManager;
use Concrete\Core\Search\ItemList\Pager\PagerProviderInterface;
use Concrete\Core\Support\Facade\Application;
use Doctrine\ORM\EntityManagerInterface;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\ColumnSet\Available;

class SelectValueOptionListPagerManager extends AbstractPagerManager
{
    /**
     * @param SelectValueOption $mixed
     *
     * @return void
     */
    public function getCursorStartValue($mixed)
    {
        return $mixed->getSelectAttributeOptionID();
    }

    public function getCursorObject($cursor)
    {
        $app = Application::getFacadeApplication();
        /** @var EntityManagerInterface $em */
        $em = $app->make(EntityManagerInterface::class);

        return $em->find(SelectValueOption::class, $cursor);
    }

    public function sortListByCursor(PagerProviderInterface $itemList, $direction)
    {
        $itemList->getQueryObject()->addOrderBy('a.avSelectOptionID', $direction);
    }

    public function getAvailableColumnSet()
    {
        return new Available();
    }
}
