<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use App\Models\Categories;
use App\Models\Videos;

class CategoriesController extends Controller
{
    public function index()
    {
        $allCategories = Categories::paginate();
        return response()->json($allCategories);
    }

    public function store(StoreCategoriesRequest $request)
    {
        $categoriesData = new Categories($request->all());
        $categoriesData->save();
        return response()->json($categoriesData);
    }

    public function show(int $id)
    {
        if (Categories::where('id',$id)->exists()) {
            $category = Categories::find($id);
            return response()->json($category);
        } else {
            return response()->json('Não encontrado', 404);
        }
    }

    public function update(Categories $category, UpdateCategoriesRequest $request)
    {
        $category->fill($request->all());
        $category->save();
        return response()->json($category);
    }

    public function destroy(int $id)
    {
        if (Categories::where('id',$id)->exists()) {
            Categories::find($id)->delete();
            return response()->json('Sucesso', 202);
        } else {
            return response()->json('Categoria não encontrada', 404);
        }
    }

    public function videosByCategory(int $id)
    {
        $videos = Videos::where('category_id',$id)->paginate();
        return response()->json($videos);
    }
}
