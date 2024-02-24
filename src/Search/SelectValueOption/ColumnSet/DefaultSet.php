<?php

namespace Macareux\AttributeValueUtilities\Search\SelectValueOption\ColumnSet;

use Concrete\Core\Search\Column\Column;
use Concrete\Core\Support\Facade\Application;
use Macareux\AttributeValueUtilities\Service\SelectValueOptionService;

class DefaultSet extends ColumnSet
{
    public function getAttribute($mixed)
    {
        $app = Application::getFacadeApplication();
        /** @var SelectValueOptionService $service */
        $service = $app->make(SelectValueOptionService::class);
        $ak = $service->getAttributeKey($mixed);

        return $ak->getAttributeKeyDisplayName();
    }

    public function getValue($mixed)
    {
        return $mixed->getSelectAttributeOptionValue();
    }

    public function getBackgroundColor($mixed)
    {
        $app = Application::getFacadeApplication();
        /** @var SelectValueOptionService $service */
        $service = $app->make(SelectValueOptionService::class);
        $option = $service->getSelectValueOptionOption($mixed);
        $backgroundColor = $option ? $option->getBackgroundColor() : '';
        $textColor = $option ? $option->getTextColor() : '';

        return $backgroundColor ? sprintf('<div style="background-color: %s; color: %s; padding: 0 1em; line-height: 2">%s</div>', $backgroundColor, $textColor, $backgroundColor) : '';
    }

    public function getTextColor($mixed)
    {
        $app = Application::getFacadeApplication();
        /** @var SelectValueOptionService $service */
        $service = $app->make(SelectValueOptionService::class);
        $option = $service->getSelectValueOptionOption($mixed);
        $textColor = $option ? $option->getTextColor() : '';
        $backgroundColor = $option ? $option->getBackgroundColor() : '';

        return $textColor ? sprintf('<div style="background-color: %s; color: %s; padding: 0 1em; line-height: 2">%s</div>', $backgroundColor, $textColor, $textColor) : '';
    }

    public function getCssClass($mixed)
    {
        $app = Application::getFacadeApplication();
        /** @var SelectValueOptionService $service */
        $service = $app->make(SelectValueOptionService::class);
        $option = $service->getSelectValueOptionOption($mixed);

        return $option ? $option->getCssClass() : '';
    }

    public function __construct()
    {
        $this->addColumn(new Column('ak', t('Attribute'), [DefaultSet::class, 'getAttribute'], false));
        $this->addColumn(new Column('a.value', t('Value'), [DefaultSet::class, 'getValue']));
        $this->addColumn(new Column('background_color', t('Background Color'), [DefaultSet::class, 'getBackgroundColor'], false));
        $this->addColumn(new Column('text_color', t('Text Color'), [DefaultSet::class, 'getTextColor'], false));
        $this->addColumn(new Column('css_class', t('Css Class'), [DefaultSet::class, 'getCssClass'], false));
        $column = $this->getColumnByKey('a.value');
        $this->setDefaultSortColumn($column, 'asc');
    }
}
