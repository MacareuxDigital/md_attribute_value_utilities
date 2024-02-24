<?php

namespace Macareux\AttributeValueUtilities\Search\SelectValueOption\Field;

use Concrete\Core\Search\Field\Field\KeywordsField;
use Concrete\Core\Search\Field\Manager as FieldManager;

class Manager extends FieldManager
{
    public function __construct()
    {
        $this->addGroup(t('Properties'), [
            new KeywordsField(),
        ]);
    }
}
