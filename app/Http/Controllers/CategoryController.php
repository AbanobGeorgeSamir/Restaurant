<?php

namespace App\Http\Controllers;

use App\Services\RestaurantDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct(private RestaurantDataService $restaurantData)
    {
    }

    public function index(){
        $categories = $this->restaurantData->categories();
        return view('categories.index', compact('categories'));
    }
    public function create(){ return view('categories.create'); }
    public function store(Request $request){
        $request->validate(['name'=>'required|string|max:255']);

        if ($this->restaurantData->categoryNameExists($request->name)) {
            return back()->withErrors(['name' => 'This category already exists.'])->withInput();
        }

        $this->restaurantData->createCategory($request->name);
        session()->flash('success','Category created successfully.');
        return redirect()->route('categories.index');
    }
    public function edit(string $category){
        $category = $this->restaurantData->findCategoryOrFail($category);
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, string $category){
        $request->validate(['name' => 'required|string|max:255']);

        if ($this->restaurantData->categoryNameExists($request->name, $category)) {
            return back()->withErrors(['name' => 'This category already exists.'])->withInput();
        }

        $this->restaurantData->updateCategory($category, $request->name);
        session()->flash('success','Category Updated successfully.');
        return redirect()->route('categories.index');
    }
    public function destroy(string $category){
        $this->restaurantData->mealsByCategory($category)->each(function (object $meal) {
            if ($meal->image ?? null) {
                Storage::disk('public')->delete($meal->image);
            }
        });

        $this->restaurantData->deleteCategory($category);
        session()->flash('success','Category Deleted successfully.');
        return redirect()->route('categories.index');
    }
}
