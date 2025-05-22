<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function getAllRecipes()
    {
        $recipes = Recipe::where('status', 'published')->with(['ingredients', 'steps'])->get();

        return response()->json($recipes, 200);
    }

    public function createRecipe(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.quantity' => 'required|string',
            'steps' => 'required|array',
            'steps.*.description' => 'required|string',
        ]);

        $recipe = Recipe::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        foreach ($validated['ingredients'] as $ingredient) {
            $recipe->ingredients()->create($ingredient);
        }
        foreach ($validated['steps'] as $step) {
            $recipe->steps()->create($step);
        }

        return response()->json($recipe->load(['ingredients', 'steps']), 201);
    }
}
