<?php

namespace Macareux\AttributeValueUtilities\Service;

use Concrete\Core\Foundation\Service\Provider as CoreServiceProvider;
use Macareux\AttributeValueUtilities\Search\SelectValueOption\Field\Manager;

class ServiceProvider extends CoreServiceProvider
{
    public function register()
    {
        $this->app['manager/search_field/select_option'] = $this->app->share(function ($app) {
            return $this->app->make(Manager::class);
        });
    }
}
