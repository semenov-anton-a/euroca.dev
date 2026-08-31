<?php

declare(strict_types=1);

namespace App\Modules\Accounting\Ver1\Controllers;

class Accounting extends BaseAccounting
{
    #[Module('accounting', 'ver1')]
    public function index(): string
    {
        return $this->viewModule( 'ver1/index' );
    }
}