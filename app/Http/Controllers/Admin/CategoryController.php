<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Category;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('categories_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all();
        // return response()->json($categories);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('categories_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // $users = User::all()->pluck('name', 'id');

        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        // return response()->json($request->all());
        $project = Category::create($request->all());
        // $project->users()->sync($request->input('users', []));

        return redirect()->route('admin.projects.index');
    }

    public function show(Category $category)
    {
        abort_if(Gate::denies('categories_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.categories.show', compact('category'));
    }
}
