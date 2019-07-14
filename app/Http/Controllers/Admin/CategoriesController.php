<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {

        $catSearch = $request->get('search');
        $q = Category::query();
        if ($catSearch !== null) {
            $q->where('title', 'like', "%{$catSearch}%");
        }
        $categories = $q->get();

        return view('admin.categories.index', ['categories'=>$categories]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(\App\Http\Requests\Category $request)
    {
        $category = $request->validated();
        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', ['category'=>$category]);
    }


    public function update(\App\Http\Requests\Category $request, $id)
    {
        $category = $request->validated();
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('categories.index');
    }

}
