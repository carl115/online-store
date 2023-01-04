<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /* VIEW */
    public function viewCategoryProducts(Category $category)
    {
        $category = $this->getCategoryWithProducts($category)->original;
        
        return view('categoryProducts', compact('category'));
    }
    /*-/-*/

    /* API */
    public function getCategories()
    {
        $categories = Category::get();

        return response()->json($categories, 200);
    }

    public function getCategory(Category $category)
    {
        return response()->json($category, 200);
    }

    public function getCategoriesWithProducts()
    {
        $categories = Category::with('products')->get();

        return response()->json($categories, 200);
    }

    public function getCategoryWithProducts(Category &$category)
    {
        $category = $category->load('products');

        return response()->json($category, 200);
    }

    public function createCategory(Request $request)
    {
        $category = new Category($request->all());
        $category->save();

        return response()->json($category, 201);
    }

    public function updateCategory(Request $request, Category $category)
    {
        $category->update($request->all());

        return response()->noContent();
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();

        return response()->noContent();
    }
    /*-/-*/
}
