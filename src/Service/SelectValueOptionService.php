<?php

namespace Macareux\AttributeValueUtilities\Service;

use Concrete\Core\Application\ApplicationAwareInterface;
use Concrete\Core\Application\ApplicationAwareTrait;
use Concrete\Core\Entity\Attribute\Key\Settings\SelectSettings;
use Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption;
use Concrete\Core\Entity\Attribute\Value\Value\SelectValueOptionList;
use Macareux\AttributeValueUtilities\Entity\SelectValueOptionOption;

class SelectValueOptionService implements ApplicationAwareInterface
{
    use ApplicationAwareTrait;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $id
     *
     * @return SelectValueOption|object|null
     */
    public function getSelectValueOptionByID($id)
    {
        return $this->entityManager->getRepository(SelectValueOption::class)->find($id);
    }

    /**
     * @param \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption $option
     *
     * @return \Macareux\AttributeValueUtilities\Entity\SelectValueOptionOption|object|null
     */
    public function getSelectValueOptionOption(SelectValueOption $option)
    {
        return $this->entityManager->getRepository(SelectValueOptionOption::class)->findOneBy([
            'avSelectOptionID' => $option->getSelectAttributeOptionID(),
        ]);
    }

    /**
     * @param \Concrete\Core\Entity\Attribute\Value\Value\SelectValueOption $option
     *
     * @return \Concrete\Core\Entity\Attribute\Key\Key|null
     */
    public function getAttributeKey(SelectValueOption $option)
    {
        /** @var SelectValueOptionList $list */
        $list = $option->getOptionList();

        /** @var SelectSettings $selectSettings */
        $selectSettings = $this->entityManager->getRepository(SelectSettings::class)->findOneBy([
            'list' => $list,
        ]);

        return $selectSettings ? $selectSettings->getAttributeKey() : null;
    }
}
