<?php

namespace App\Routing;

interface RouterInterface
{
    /** Returns route name by path */
    public function match($path): RouteInterface;

    /** Calls action by path */
    public function resolve($path): string;

    public function addRoute(RouteInterface $route): void;
}