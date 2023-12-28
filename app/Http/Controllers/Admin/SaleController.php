<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Sale;
use App\Product;
use App\SoldProduct;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreSalesRequest;
use Illuminate\Support\Facades\DB;


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

        try {
            DB::beginTransaction();

            $sale = Sale::create([
                'user_id' => $request->input('user_id'),
                'amount_paid' => $request->input('amount_paid'),
                'change_due' => $request->input('change_due'),
                'sale_date' => $request->input('sale_date'),
                'transaction_code' => $request->input('transaction_code'),
                'grand_total' => $request->input('grand_total'),

            ]);

            $soldProducts = json_decode($request->input('sold_product'), true);

            foreach ($soldProducts as $product) {

                $this->decreaseProductQuantity($product['product_id'][0], $product['quantity']);
                $sale->soldProducts()->create([
                    'product_id' => $product['product_id'][0],
                    'quantity' => $product['quantity'],
                    'unit_price' => $product['unit_price'],
                    'discount' => $product['discount'],
                    'total_amount' => $product['total_amount'],

                ]);
            }

            DB::commit();

            return redirect()->route('admin.sales.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('admin.sales.index')->with('error', 'Gagal menyimpan data.');
        }


    }

    private function decreaseProductQuantity($productId, $quantity)
    {
        $product = Product::find($productId);

        if ($product) {
            $newQuantity = max(0, $product->stock_quantity - $quantity);
            $product->update(['stock_quantity' => $newQuantity]);
        }
    }

}
