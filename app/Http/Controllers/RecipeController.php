<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function getAllPublishedRecipes()
    {
        $recipes = Recipe::where('status', 'published')->with(['ingredients', 'steps'])->get();

        return response()->json($recipes, 200);
    }

    public function getAllRecipes()
    {
        $recipes = Recipe::with(['ingredients', 'steps'])->get();

        return response()->json($recipes, 200);
    }

    public function createRecipe(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'portion' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,pending',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.quantity' => 'required|string',
            'steps' => 'required|array',
            'steps.*.step_number' => 'required|integer',
            'steps.*.instruction' => 'required|string',
        ]);

        $recipe = Recipe::create([
            'title' => $validated['title'],
            'user_id' => $request->user()->id,
            'description' => $validated['description'] ?? null,
            'portion' => $validated['portion'] ?? null,
            'image' => $validated['image'] ?? null,
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

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:recipes,id',
            'status' => 'required|in:rejected,published',
        ]);

        $recipe = Recipe::findOrFail($validated['id']);
        $recipe->status = $validated['status'];
        $recipe->save();

        return response()->json($recipe, 200);
    }

    public function getAllUserRecipes(Request $request)
    {
        $recipes = Recipe::where('user_id', $request->user()->id)
            ->with(['ingredients', 'steps'])
            ->get();

        return response()->json($recipes, 200);
    }
}
