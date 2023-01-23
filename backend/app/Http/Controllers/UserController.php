<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends CrudController
{
    protected $entity = User::class;

    protected $index_page = 'Users/Index';
}
