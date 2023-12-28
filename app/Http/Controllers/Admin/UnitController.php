<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Unit;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreUnitRequest;

class UnitController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('units_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $units = Unit::all();

        return view('admin.units.index', compact('units'));
    }

    public function create()
    {
        abort_if(Gate::denies('units_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $users = Supplier::all()->pluck('name', 'id');

        return view('admin.units.create');
    }

    public function store(StoreUnitRequest $request)
    {
        // return response()->json($request->all());
        $units = Unit::create($request->all());

        return redirect()->route('admin.units.index');
    }
}
