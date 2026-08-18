<?php

namespace App\Http\Controllers;

use App\Services\RestaurantDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function __construct(private RestaurantDataService $restaurantData)
    {
    }

    public function index(){ $meals = $this->restaurantData->meals(); return view('meals.index', compact('meals')); }
    public function create(){ $categories = $this->restaurantData->categories(); return view('meals.create', compact('categories')); }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|string|max:255','description'=>'required|string','price'=>'required|numeric','category_id'=>'required|string','image'=>'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if (! $this->restaurantData->categoryExists($request->category_id)) {
            return back()->withErrors(['category_id' => 'Please select a valid category.'])->withInput();
        }

        $image = $request->file('image')?->store('meals','public');
        $this->restaurantData->createMeal([ 'name'=>$request->name,'description'=>$request->description,'price'=>$request->price,'category_id'=>$request->category_id,'image'=>$image]);
        session()->flash('success','Meal created successfully.');
        return redirect()->route('meals.index');
    }
    public function edit(string $meal){ $meal = $this->restaurantData->findMealOrFail($meal); $categories = $this->restaurantData->categories(); return view('meals.edit', compact('meal','categories')); }
    public function update(Request $request, string $meal){
        $request->validate(['name'=>'required|string|max:255','description'=>'required|string','price'=>'required|numeric','category_id'=>'required|string','image'=>'nullable|image|mimes:jpg,png,jpeg|max:2048']);

        if (! $this->restaurantData->categoryExists($request->category_id)) {
            return back()->withErrors(['category_id' => 'Please select a valid category.'])->withInput();
        }

        $existingMeal = $this->restaurantData->findMealOrFail($meal);
        $data = ['name'=>$request->name,'description'=>$request->description,'price'=>$request->price,'category_id'=>$request->category_id];

        if($request->hasFile('image')){
            if ($existingMeal->image ?? null) {
                Storage::disk('public')->delete($existingMeal->image);
            }

            $data['image'] = $request->file('image')->store('meals','public');
        }

        $this->restaurantData->updateMeal($meal, $data);
        session()->flash('success','Meal updated successfully.');
        return redirect()->route('meals.index');
    }
    public function destroy(string $meal){
        $existingMeal = $this->restaurantData->findMealOrFail($meal);

        if ($existingMeal->image ?? null) {
            Storage::disk('public')->delete($existingMeal->image);
        }

        $this->restaurantData->deleteMeal($meal);
        session()->flash('success','Meal deleted successfully.');
        return redirect()->route('meals.index');
    }
}
