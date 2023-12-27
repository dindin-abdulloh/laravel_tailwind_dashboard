<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Sale;
use App\Product;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreSalesRequest;


class SaleController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('sales_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sales = Sale::all();

        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        abort_if(Gate::denies('sales_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all(['id', 'product_name', 'price']);

        return view('admin.sales.create', compact('products'));
    }

    public function store(StoreSalesRequest $request)
    {
        $sales = Sale::create($request->all());

        return redirect()->route('admin.sales.index');
    }

}
