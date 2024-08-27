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
use App\Http\Requests\MassDestroySaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;



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
                'user_id' => $request->user_id,
                'amount_paid' => $request->amount_paid,
                'change_due' => $request->change_due,
                'sale_date' => $request->sale_date,
                'transaction_code' => $request->transaction_code,
                'grand_total' => $request->grand_total,
            ]);

            $soldProducts = json_decode($request->sold_product, true);

            foreach ($soldProducts as $product) {
                $this->decreaseProductQuantity($product['product_id'], $product['quantity']);
                SoldProduct::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product['product_id'],
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

    public function show(Sale $sale)
    {
        abort_if(Gate::denies('sales_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleId = $sale->id;

        $soldProducts = SoldProduct::where('sale_id', $saleId)->get();

        $soldWithProduct = [];

        foreach ($soldProducts as $soldProduct) {
            $productId = $soldProduct->product_id;

            $product = Product::find($productId);

            if ($product) {
                $soldWithProduct[] = [
                    'product_id' => $product->id,
                    'sold_product_id' => $soldProduct->id,
                    'product_name' => $product->product_name,
                    'quantity' => $soldProduct->quantity,
                    'discount' =>  $soldProduct->discount,
                    'unit_price' =>  $soldProduct->unit_price,
                    'total_amount' =>  $soldProduct->total_amount,
                ];
            }
        }


        $pdf = Pdf::loadView('admin.sales.print', compact('sale', 'soldWithProduct'));
        return $pdf->stream();
    }

    public function edit(Sale $sale)
    {
        abort_if(Gate::denies('sales_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saleId = $sale->id;

        $soldProducts = SoldProduct::where('sale_id', $saleId)->get();

        $soldWithProduct = [];

        foreach ($soldProducts as $soldProduct) {
            $productId = $soldProduct->product_id;

            $product = Product::find($productId);
            $productList = Product::all();

            if ($product) {
                $soldWithProduct[] = [
                    'product_id' => $product->id,
                    'sold_product_id' => $soldProduct->id,
                    'product_name' => $product->product_name,
                    'quantity' => $soldProduct->quantity,
                    'discount' =>  $soldProduct->discount,
                    'unit_price' =>  $soldProduct->unit_price,
                    'total_amount' =>  $soldProduct->total_amount,
                ];
            }
        }

        return view('admin.sales.edit', compact('sale', 'soldWithProduct', 'productList', 'soldProducts'));
    }



    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        // Decode the JSON data from the request
        $soldProducts = json_decode($request->input('sold_product'), true);

        // Loop through the sold products and update the database
        foreach ($soldProducts as $product) {
            // Decrease product quantity (assuming this is a custom function in your controller)
            $this->decreaseProductQuantity($product['product_id'][0], $product['quantity']);

            // Create or update the sold product record
            $sale->soldProducts()->create([
                'product_id' => $product['product_id'][0],
                'quantity' => $product['quantity'],
                'unit_price' => $product['unit_price'],
                'discount' => $product['discount'],
                'total_amount' => $product['total_amount'],
            ]);
        }

        // Redirect back to the edit page with a success message
        return redirect()->route('admin.sales.edit ', $sale->id)->with('success', 'Sale updated successfully');
    }

    public function destroy(Sale $sale)
    {
        abort_if(Gate::denies('sales_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sale->delete();

        return back();
    }

    public function massDestroy(MassDestroySaleRequest $request)
    {

        Sale::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }



}
