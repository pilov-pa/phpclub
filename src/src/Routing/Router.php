<?php

namespace App\Routing;

class Router implements RouterInterface
{
    private array $routes;

    public function match($path): RouteInterface
    {
        //TODO
        foreach ($this->routes as $routeName => $route) {
            $pattern = $route['pattern'];

            $pattern = preg_replace('/\{.*?\}/', '.*', $pattern);

            preg_match('~' . $pattern . '~', $path, $matches);

            if ($matches) {
                return $routeName;
            }
        }

        return "";
    }

    public function resolve($path): string
    {
        $routeName = $this->match($path);
        $route = $this->routes[$routeName];

        $pattern = $route['pattern'];

        preg_match_all('/\{[a-zA-Z0-9]*?\}/', $pattern, $matches);
        $patternVariables = $matches[0];

        $pattern = preg_replace('/\{.*?\}/', '(.*)', $pattern);
        preg_match('~' . $pattern . '~', $path, $matches);

        $varValues = [];
        foreach ($patternVariables as $i => $var) {
            $var = rtrim(ltrim($var, '{'), '}');
            $varValues[$var] = $matches[$i + 1];
        }

        $closure = $route['action'];

        return call_user_func($closure, ...array_values($varValues));
    }

    public function setRoutes(array $routes): void
    {
        $this->routes = $routes;
    }
}