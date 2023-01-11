<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $products = Product::all();
        return view('recipes.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        
        $recipe = Recipe::create([
            'title' => $request->title,
            'description' => $request->description,
            'yt_link' => $request->yt_link,
            'image_path' => '',
            'author_id' => auth()->id()
    ]);
        $recipe->products()->sync($request->products);

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
        $products = Product::orderBy('name', 'ASC')->get();

        $selectedProducts = [];
        foreach($recipe->products as $product){
            $selectedProducts[] = $product->id;
        }
// dd($recipe);
        return view('recipes.edit', compact('recipe', 'products', 'selectedProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe, $id)
    {
        // dd($request->products);
        // dd($id);

        $recipe = Recipe::findOrFail($id);
        

        $recipe->update($request->all());
        // $recipe->update($request->except(['_token', '_method']));
        // Recipe::where('id', $id)->update($request->except(['_token', '_method']));
        $recipe->products()->sync($request->products);

        // $recipe->products()->syncWithPivotValues(
        // $id,
        //  ['cos']);

        // $recipe->products()->sync($id);



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
        // $recipes = Recipe::with('products')
        //     ->when(request('searchInput'), function ($query) {
        //         $query->where(function($q) {
        //             $q->where('title', 'ilike', '%'.request('searchInput'). '%')
        //             ->orWhere('description', 'ilike', '%'.request('searchInput'). '%')
        //             ->orWhere('products', 'ilike', '%'.request('searchInput'). '%');
        //         });
        //     })->paginate(15);
        //     // dd($recipes);


        //         $recipes = Recipe::whereHas('products', function ($query) use ($search){
        //             $query->where('title', 'like', '%'.$search.'%');
        //         })
        //         ->with(['products' => function($query) use ($search){
        //             $query->where('description', 'like', '%'.$search.'%');
        //         }])->get();

                // $recipes = Recipe::join( 'products', 'products.id', '=', 'id' )
                // ->where( 'title', 'LIKE', '%'.$search.'%' )
                // ->orWhere( 'name', $search )
                // ->orWhere( 'description', $search )
                // ->paginate( 15 );

                $recipes = DB::table('products')
                ->join('product_recipe', 'products.id', '=', 'product_recipe.product_id')
                ->join('recipes', 'product_recipe.recipe_id', '=', 'recipes.id')
                ->select('recipes.title', 'recipes.description', 'products.name')
                ->where('recipes.title', 'like', '%' . $search . '%')
                ->orWhere('recipes.description', 'like', '%' . $search . '%')
                ->orWhere('products.name', 'like', '%' . $search . '%')
                ->get();

               
                // $recipes = Recipe::with('products')    
                //     ->when($search, function ($query) {
                //         $query->where(function($q) {
                //             $q->where('title', 'like', '%'.request('searchInput'). '%')
                //             ->orWhere('description', 'like', '%'.request('searchInput'). '%');
                //     });
                // })->paginate(5);


        // if ($recipes->total() > 0)
            return view('recipes.index', compact('recipes'));
            // else 
            // return view('recipes.index' , compact('recipes'))->with('No Details found. Try to search again !');
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
