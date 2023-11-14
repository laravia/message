<?php

namespace Laravia\Message\App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravia\Heart\App\Traits\ServiceProviderTrait;

class MessageServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait;

    protected $name = "message";

    public function boot(): void
    {
        $this->defaultBootMethod();
    }
}
