<?php


namespace App\Routing;


interface RouteInterface
{
    public function getName();
    public function getPattern();
    public function getAction();
    public function match();
}