<?php

namespace Botble\Tenant\Contracts;

interface Factory
{
    public function driver(string $driver);
}
