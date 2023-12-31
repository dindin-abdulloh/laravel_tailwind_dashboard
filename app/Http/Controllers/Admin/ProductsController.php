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
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\MassDestroyProductRequest;


class ProductsController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('products_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::all();


        $productsRunningLow = Product::where('stock_quantity', '<=', 10)->get();


        $productsExpiringSoon = Product::whereDate('expired_date', '<=', now()->addDays(30))->get();

        return view('admin.products.index', compact('products', 'productsRunningLow', 'productsExpiringSoon'));
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

    public function edit(Product $product)
    {
        abort_if(Gate::denies('products_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = Category::all()->pluck('category_name', 'id');
        $supplier = Supplier::all()->pluck('supplier_name', 'id');

        return view('admin.products.edit', compact( 'product', 'category', 'supplier'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('products_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.products.show', compact('product'));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('products_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroySaleRequest $request)
    {

        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
