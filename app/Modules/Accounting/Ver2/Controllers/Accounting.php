<?php

declare(strict_types=1);

namespace App\Modules\Accounting\Ver2\Controllers;

class Accounting extends BaseAccounting
{
    // #[Module('accounting', 'ver2')]
    public function index(): string
    {
        return $this->viewModule( 'ver2/index' );
    }
}