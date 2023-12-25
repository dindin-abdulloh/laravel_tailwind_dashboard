<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Products;
use App\User;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('products_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Products::all();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('products_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id');

        return view('admin.products.create', compact('users'));
    }
}
