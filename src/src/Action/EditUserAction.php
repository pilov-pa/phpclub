<?php


namespace App\Action;

class EditUserAction
{
    public function exec($id): string
    {
        return 'edit ' . $id;
    }
}
