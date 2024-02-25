<?php

namespace Macareux\AttributeValueUtilities\Service;

use Concrete\Core\Foundation\Service\Provider as CoreServiceProvider;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\Field\Manager;

class ServiceProvider extends CoreServiceProvider
{
    public function register()
    {
        $this->app->singleton('manager/search_field/select_option', function ($app) {
            return $app->make(Manager::class);
        });
    }
}
