<?php

namespace Concrete\Package\MdAttributeValueUtilities\Controller\Element\SelectOptions\Header;

use Concrete\Core\Controller\ElementController;

class Menu extends ElementController
{
    public function getElement()
    {
        return 'select_options/header/menu';
    }

    public function view()
    {
        $this->set('token', $this->app->make('token'));
    }
}