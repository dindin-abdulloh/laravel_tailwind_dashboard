<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;

use App\Category;
use App\Supplier;
use App\User;
use App\Product;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreProductRequest;


class ProductsController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('products_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('products_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = Category::all()->pluck('category_name', 'id');
        $supplier = Supplier::all()->pluck('supplier_name', 'id');

        return view('admin.products.create', compact('category', 'supplier'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        return redirect()->route('admin.products.index');
    }
}
