<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function category()
    {
        $data = [
            'categories' => Category::where('is_delete', 0)->orderBy('id', 'desc')->get()
        ];
        return view('admin.category')->with($data);
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:categories,name',
        'slug' => 'required|unique:categories,slug',
    ]);

    Category::create([
        'name' => $request->name,
        'slug' => $request->slug,
        'description' => $request->description,
        'status' => 1,
        'is_delete' => 0,
    ]);


    return back()->with('success', 'Category added successfully!');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->status = $request->status;

        $category->save();

        return redirect()->back()->with('success', 'Category updated.');
    }


    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->is_delete = 1;
        $category->status = 0;
        $category->save();
        return back()->with('success', 'Category deleted successfully!');
    }
}
