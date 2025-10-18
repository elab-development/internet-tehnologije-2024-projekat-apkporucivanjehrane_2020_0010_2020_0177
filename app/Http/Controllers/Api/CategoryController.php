<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Prikaz svih kategorija
     */
    public function index(): JsonResponse
    {
        $categories = Category::withCount('restorani')->get();
        
        return response()->json([
            'success' => true,
            'data' => CategoryResource::collection($categories)
        ]);
    }

    /**
     * Prikaz jedne kategorije
     */
    public function show(Category $category): JsonResponse
    {
        $category->loadCount('restorani');
        
        return response()->json([
            'success' => true,
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * Kreiranje nove kategorije (samo admin)
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kategorija uspešno kreirana',
            'data' => new CategoryResource($category)
        ], 201);
    }

    /**
     * Ažuriranje kategorije (samo admin)
     */
    public function update(Request $request, Category $category): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:categories,name,' . $category->id,
            'slug' => 'sometimes|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kategorija uspešno ažurirana',
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * Brisanje kategorije (samo admin)
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategorija uspešno obrisana'
        ]);
    }
}
