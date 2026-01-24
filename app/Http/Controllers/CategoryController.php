<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. GET /api/categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // 2. POST /api/categories
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:categories',
        ]);

        $category = Category::create($validated);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }
    
    // 3. GET /api/categories/{id}
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) return response()->json(['message' => 'Not found'], 404);
        return response()->json($category);
    }
    
    // (Opsional) Update dan Delete bisa ditambahkan nanti
}