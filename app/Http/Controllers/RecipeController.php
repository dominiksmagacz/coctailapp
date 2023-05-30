<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateRecipeRequest;
use App\Http\Requests\StoreRecipeRequest;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all()->toQuery()->paginate(10);
        $ingredients = Ingredient::all();

        return view('recipes.index', compact('recipes', 'ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('recipes.create', compact('ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request)
    {
        // dd($request);

        $recipe = Recipe::create([
            'title' => $request->title,
            'description' => $request->description,
            'yt_link' => $request->yt_link,
            'image_path' => $this->storeImageinStore($request),
            'author_id' => auth()->id()
        ]);
        $recipe->ingredients()->sync($request->ingredients);

        return redirect()->route('recipes.index')->with('message', 'Przepis został dodany.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe, $id)
    {
        $recipe = Recipe::find($id);

        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe, $id)
    {
        $recipe = Recipe::find($id);
        $ingredients = Ingredient::orderBy('name', 'ASC')->get();

        $selectedingredients = [];
        foreach ($recipe->ingredients as $ingredient) {
            $selectedingredients[] = $ingredient->id;
        }
        // dd($recipe);
        return view('recipes.edit', compact('recipe', 'ingredients', 'selectedingredients'));
    }

    // public function edit(Recipe $recipe)
    // {
    //     abort_if(Gate::denies('recipe_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $recipe->load('ingredients');

    //     $ingredients = Ingredient::get()->map(function($ingredient) use ($recipe) {
    //         $ingredient->value = data_get($recipe->ingredients->firstWhere('id', $ingredient->id), 'pivot.amount') ?? null;
    //         return $ingredient;
    //     });

    //     return view('admin.recipes.edit', [
    //         'ingredients' => $ingredients,
    //         'recipe' => $recipe,
    //     ]);
    // }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe, $id)
    {
        // dd($request->ingredients);
        // dd($id);

        $recipe = Recipe::findOrFail($id);


        $recipe->update($request->all());
        // $recipe->update($request->except(['_token', '_method']));
        // Recipe::where('id', $id)->update($request->except(['_token', '_method']));
        $recipe->ingredients()->sync($request->ingredients);

        if(count($request->files) > 0)
        Recipe::where('id', $id)->update(['image_path' => $this->storeImageinStore($request)]);
        // $recipe->ingredients()->syncWithPivotValues(
        // $id,
        //  ['cos']);

        // $recipe->ingredients()->sync($id);



        return redirect(route('recipes.index'))->with('message', 'Przepis został zmodyfikowany.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd('test');
        Recipe::destroy($id);

        return redirect(route('recipes.index'))->with('message', 'Przepis został usunięty.');
    }

    public function search(Request $request)
    {

        $data = request('searchInput');
        $recipes = Recipe::with('ingredients')
            ->where('title', 'like', '%' . $data . '%')
            ->orWhere('description', 'like', '%' . $data . '%')
            ->orWhereHas('ingredients', function ($query) use ($data) {
                $query->where('name', 'like', '%' . $data . '%');
            })
            ->paginate(5);

        return view('recipes.index', compact('recipes'));
    }

    private function storeImageinStore($request)
    {

        $path = $request->file('image_path')->store('public');
        return $path;
    }


    // public function search(Request $request)
    // {
    //     $search = $request->input('searchInput');
    //     $recipes = Recipe::where('title', 'LIKE', '%' . $search . '%')->paginate(5);

    //     if (count($recipes) > 0)
    //         return view('recipes.index', compact('recipes'));
    //         else 
    //         return view('recipes.index' , compact('recipes'))->with('No Details found. Try to search again !');
    // }
}
