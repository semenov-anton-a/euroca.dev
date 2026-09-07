<?php

declare(strict_types=1);

namespace App\Modules\Accounting\Ver1\Controllers;

#[ Module('accounting', 'ver1') ]
class Accounting extends BaseAccounting
{
    #[ Permission('view') ]
    public function index(): string
    {
        return $this->viewModule( 'ver1/index' );
    }
}