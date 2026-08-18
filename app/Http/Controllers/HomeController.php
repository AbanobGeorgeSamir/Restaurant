<?php

namespace App\Http\Controllers;

use App\Services\RestaurantDataService;

class HomeController extends Controller
{
    public function __construct(private RestaurantDataService $restaurantData)
    {
    }

    public function index(){
        $meals = $this->restaurantData->meals();
        $categories = $this->restaurantData->categories();
        return view('home', compact('meals', 'categories'));
    }
    public function category(string $id){
        $this->restaurantData->findCategoryOrFail($id);
        $meals = $this->restaurantData->mealsByCategory($id);
        $categories = $this->restaurantData->categories();
        return view('home', compact('meals', 'categories'));
    }
}
