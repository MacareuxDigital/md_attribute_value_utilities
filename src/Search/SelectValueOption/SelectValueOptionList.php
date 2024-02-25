<?php

namespace Macareux\AttributeValueUtilities\Search\SelectValueOption;

use Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption;
use Concrete\Core\Search\ItemList\Database\ItemList;
use Concrete\Core\Search\ItemList\Pager\PagerProviderInterface;
use Concrete\Core\Search\ItemList\Pager\QueryString\VariableFactory;
use Concrete\Core\Search\Pagination\PaginationProviderInterface;
use Concrete\Core\Support\Facade\Application;
use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Adapter\DoctrineDbalAdapter;

class SelectValueOptionList extends ItemList implements PagerProviderInterface, PaginationProviderInterface
{
    /**
     * @var Closure|int|null
     */
    protected $permissionsChecker = -1;

    protected $autoSortColumns = [
        'a.value',
    ];

    public function filterByKeywords($keywords)
    {
        $this->query->andWhere($this->query->expr()->like('value', ':keywords'))
            ->setParameter('keywords', '%' . $keywords . '%')
        ;
    }

    public function createQuery()
    {
        $this->query->select('avSelectOptionID')
            ->from('atSelectOptions', 'a')
        ;
    }

    public function finalizeQuery(\Doctrine\DBAL\Query\QueryBuilder $query)
    {
        $query->andWhere('a.isDeleted = 0');

        return $query;
    }

    public function getResult($mixed)
    {
        $app = Application::getFacadeApplication();
        /** @var EntityManagerInterface $em */
        $em = $app->make(EntityManagerInterface::class);

        return $em->find(SelectValueOption::class, $mixed['avSelectOptionID']);
    }

    public function getTotalResults()
    {
        return $this->deliverQueryObject()
            ->resetQueryParts(['groupBy', 'orderBy'])
            ->select('count(distinct a.avSelectOptionID)')
            ->setMaxResults(1)
            ->execute()
            ->fetchColumn()
        ;
    }

    public function getPagerManager()
    {
        return new SelectValueOptionListPagerManager($this);
    }

    public function getPagerVariableFactory()
    {
        return new VariableFactory($this, $this->getSearchRequest());
    }

    public function getPaginationAdapter()
    {
        return new DoctrineDbalAdapter($this->deliverQueryObject(), function ($query) {
            $query->resetQueryParts(['groupBy', 'orderBy'])
                ->select('count(distinct a.avSelectOptionID)')
                ->setMaxResults(1)
            ;
        });
    }

    public function checkPermissions($mixed)
    {
        return true;
    }

    public function setPermissionsChecker(\Closure $callback)
    {
        $this->permissionsChecker = $callback;
    }

    public function ignorePermissions()
    {
        $this->permissionsChecker = -1;
    }

    public function getPermissionsChecker()
    {
        return $this->permissionsChecker;
    }

    public function enablePermissions()
    {
        unset($this->permissionsChecker);
    }
}
