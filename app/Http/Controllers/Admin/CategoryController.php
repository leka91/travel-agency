<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $categories = Category::with('tours')->sortable()->paginate(10);
        
        return view('auth.categories.categories', compact('categories'));
    }

    public function newCategoryForm()
    {
        return view('auth.categories.add-new-category');
    }

    public function addNewCategory(AddCategoryRequest $request)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];
        

        Category::create($data);

        return back()->with('status', 'You have added category successfully');
    }
    
    public function editCategoryForm(Category $category)
    {
        return view('auth.categories.edit-category', compact('category'));
    }

    public function editCategory(EditCategoryRequest $request, Category $category)
    {
        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $category->update($data);

        return back()->with('status', 'You have updated category successfully');
    }
}
