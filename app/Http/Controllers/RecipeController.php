<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RecipeRequest;

use Carbon\Carbon;

use App\Category;

use App\Recipe;

use App\User;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        $user = \Auth::user();
        $recipes = Recipe::all();
        foreach($recipes as $recipe){
        $data = Carbon::createFromFormat('Y-m-d H:i:s',$recipe->created_at)->format('Y年m月d日');
        }

        return view('recipes.index',[
           'title' => 'レシピ一覧', 
           'user' => $user,
           'recipes' => $recipes,
           'data' => $data,
        ]);
    }

  
  
    public function create()
    {   
        $user = \Auth::user();
        $categories = Category::all();
        
        return view('recipes.create',[
           'title' => 'レシピ投稿', 
           'categories' => $categories,
           'user' => $user,
        ]);
    }

   
    private function saveImage($image)
    {
        $path = '';
        if(isset($image) === true){
            $path = $image->store('recipe','public');
        }
        return $path;;
    }
   
    public function store(RecipeRequest $request)
    {
        $user = \Auth::user();
        
        $path = $this->saveImage($request->file('image'));
        
        $recipe = Recipe::create(
            [
                'user_id' => auth()->id(),
                'name' => $request->name,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'image' => $path,
            ]);
        
        
        session()->flash('success','レシピを追加しました');
        return redirect()->route('recipes.index');
    }
    
    public function materials_create($id)
    {
        $recipe = Recipe::find($id);
        $recipe->materials()->createMany([
           [
               'name' => $request->materials,
               'amount' => '',
               'unit' => '',
            ],
            [
                'name' => '',
                'amount' => '',
                'unit' => '',
                
            ],
            
        ]);
        
    }

    
    public function show($id)
    {
        $recipe = Recipe::find($id);
        $user = \Auth::user();
        
        return view('recipes.show',[
           'title' => 'Myレシピ',
           'recipe' => $recipe,
           'user' => $user,
        ]);
    }

    
    public function edit($id)
    {
        $user = \Auth::user();
        $recipe = Recipe::find($id);
        $categories = Category::all();
        
        return view('recipes.edit',[
           'recipe' => $recipe, 
           'title' => 'レシピ編集',
           'user' => $user,
           'categories' => $categories,
        ]);
    }

    public function update(RecipeRequest $request, $id)
    {
        $recipe = Recipe::find($id);
        $user = \Auth::user();
        $path = $this->saveImage($request->file('image'));
        if($recipe->image !== ''){
            \Storage::disk('public')->delete('recipe/'.$recipe->image);
        }
        
        $recipe->update($request->only([
            'name','category_id',   
        ]));
        $recipe->update([
           'image' => $path, 
        ]);
        
        session()->flash('success','レシピを編集しました');
        return redirect()->route('recipes.index');
    }

   
    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();
        session()->flash('success','レシピを削除しました');
        return redirect()->route('recipes.index');
    }
    
    
}
