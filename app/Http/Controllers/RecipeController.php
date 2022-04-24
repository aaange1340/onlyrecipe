<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RecipeRequest;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

use App\Category;

use App\Recipe;

use App\User;

use App\Like;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function count_Category(){
        $category_count = DB::table('recipes')
                        ->select(DB::raw('category_id,count(*) as category_count'))
                        ->groupBy('category_id')
                        ->get();
        
    }
    public function index()
    {
        $user = \Auth::user();
        $recipes = Recipe::query()->whereIn('user_id',\Auth::user()->follows()->pluck('follow_id'))->orWhere('user_id',\Auth::user()->id)->latest()->get();
        foreach($recipes as $recipe){
            $data = Carbon::createFromFormat('Y-m-d H:i:s',$recipe->created_at)->format('Y年m月d日');
        }
        $categories = Category::all();
        // $category_count = DB::table('recipes')
        //                 ->select(DB::raw('category_id,count(*) as category_count,recipes.name as recipe_name,categories.name as category_name'))
        //                 ->join('categories','recipes.category_id','=','categories.id')
        //                 ->groupBy('category_id','recipes.name','categories.name')
        //                 ->get();
        // $categories = Category::withCount('recipes')->take(5)->get();

        return view('recipes.index',[
           'title' => 'レシピ一覧', 
           'user' => $user,
           'recipes' => $recipes,
           'recommended_users' => User::recommend($user->id)->get(),
           'data' => $data,
           'categories' => $categories,
        //   'category_count'=> $category_count
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
         $material = Material::createMany([
           [
               'name' => $request->name,
               'recipe_id' => $recipe->id,
               'amount' => $request->amount,
               'unit' => $request->unit,
            ],
            
            
        ]);
        
        
        session()->flash('success','レシピを追加しました');
        return redirect()->route('recipes.index');
    }
    
    public function materials_create(Request $request,$id)
    {
        $recipe = Recipe::find($id);
        $recipe->materials()->createMany([
           [
               'name' => $request->name,
               'recipe_id' => $recipe->id,
               'amount' => $request->amount,
               'unit' => $request->unit,
            ],
            
            
        ]);
        
    }

    
    public function show($id)
    {
        $recipe = Recipe::find($id);
        $user = \Auth::user();

        return view('recipes.show',[
           'title' => 'レシピ詳細',
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
        if($path !== ''){
        $recipe->update([
           'image' => $path, 
        ]);
        }
        
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
    
    public function toggleLike($id)
    {
        $user = \Auth::user();
        $recipe = Recipe::find($id);
        
        if($recipe->isLikedBy($user)){
            $recipe->likes->where('user_id',$user->id)->first()->delete();
        }else{
            Like::create([
                'user_id' => $user->id,
                'recipe_id' => $recipe->id,
            ]);
        }
        return back();
    }
    
}
