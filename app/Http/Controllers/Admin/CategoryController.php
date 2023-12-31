<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gate;
use App\Category;
use App\User;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoriesRequest;

class CategoryController extends Controller
{
    //
    public function index()
    {
        abort_if(Gate::denies('categories_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('categories_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');



        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {

        $project = Category::create($request->all());

        return redirect()->route('admin.categories.index');
    }

    public function show(Category $category)
    {
        abort_if(Gate::denies('categories_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        abort_if(Gate::denies('categories_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category)
    {
        abort_if(Gate::denies('categories_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->delete();

        return back();
    }

    public function massDestroy(MassDestroyCategoryRequest $request)
    {

        Category::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
