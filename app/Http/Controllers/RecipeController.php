<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all()->toQuery()->paginate(5);
        $products = Product::all()->take(4);
        
        return view('recipes.index', compact('recipes','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipes.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Recipe::create([
            'title' => $request->title,
            'description' => $request->description,
            'yt_link' => $request->yt_link,
            'image_path' => '',
            'author_id' => auth()->id()
    ]);

        Product::create([
            'name' => $request->name,
            'type_of_measure' => $request->type_of_measure
        ]);

    //     $recipes = Recipe::all();
    //     foreach ($request->recipes as $recipe_id => $products) {
    //         $recipe = $recipes->find($recipe_id);
    //     }
    //     $sport->countries ()->attach ($medals) ;
    // }

    $recipe = Recipe::find(1);
    $recipe->products()->attach(1);


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
    public function edit($id)
    {
        return view('recipes.edit', [
            'recipe' => Recipe::where('id', $id)->first()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd('test');

        Recipe::where('id', $id)->update($request->except(['_token', '_method']));

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
        $search = $request->input('searchInput');
        $recipes = Recipe::where('title', 'LIKE', '%' . $search . '%')->paginate(5);

        if (count($recipes) > 0)
            return view('recipes.index', compact('recipes'));
            else 
            return view('recipes.index' , compact('recipes'))->with('No Details found. Try to search again !');
    }
}
