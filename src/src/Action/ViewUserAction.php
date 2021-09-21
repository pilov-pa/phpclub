<?php


namespace App\Action;

class ViewUserAction
{
    public function exec($id): string
    {
        return 'view ' . $id;
    }
}
