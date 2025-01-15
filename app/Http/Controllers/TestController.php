<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users,create:create|update:update|delete:delete');
//        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
    }

    public function index()
    {
        return 'index';
    }

    public function create()
    {
        return 'create';
    }
}
