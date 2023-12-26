<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Supplier;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreSupplierRequest;

class SupplierController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('suppliers_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $suppliers = Supplier::all();

        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        abort_if(Gate::denies('suppliers_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $users = Supplier::all()->pluck('name', 'id');

        return view('admin.suppliers.create');
    }

    public function store(StoreSupplierRequest $request)
    {
        // return response()->json($request->all());
        $supplier = Supplier::create($request->all());
        // $project->users()->sync($request->input('users', []));

        return redirect()->route('admin.suppliers.index');
    }
}
