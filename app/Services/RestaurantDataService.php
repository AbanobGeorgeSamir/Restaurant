<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class RestaurantDataService
{
    public function categories(): Collection
    {
        return Category::orderByDesc('created_at')->get();
    }

    public function findCategoryOrFail(string $id): object
    {
        $category = Category::find($id);

        abort_if($category === null, 404, 'Category not found.');

        return $category;
    }

    public function categoryExists(string $id): bool
    {
        return Category::where('_id', $id)->exists();
    }

    public function categoryNameExists(string $name, ?string $ignoreId = null): bool
    {
        $slug = Str::slug($name);

        return Category::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('_id', '!=', $ignoreId))
            ->exists();
    }

    public function createCategory(string $name): object
    {
        return Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updateCategory(string $id, string $name): object
    {
        $category = $this->findCategoryOrFail($id);

        $category->update([
            'name' => $name,
            'slug' => Str::slug($name),
            'updated_at' => now(),
        ]);

        return $category->fresh();
    }

    public function deleteCategory(string $id): void
    {
        $this->findCategoryOrFail($id);

        $this->mealsByCategory($id)->each(function (object $meal) {
            $this->deleteMeal($meal->id);
        });

        Category::destroy($id);
    }

    public function meals(): Collection
    {
        $categories = $this->categories()->keyBy('id');

        return Meal::with('category')
            ->orderByDesc('created_at')
            ->get()
            ->map(fn (Meal $meal) => $this->withCategory($meal, $categories))
            ->values();
    }

    public function mealsByCategory(string $categoryId): Collection
    {
        return Meal::query()
            ->where('category_id', $categoryId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function findMealOrFail(string $id): object
    {
        $meal = Meal::find($id);

        abort_if($meal === null, 404, 'Meal not found.');

        return $this->withCategory($meal, $this->categories()->keyBy('id'));
    }

    public function createMeal(array $data): object
    {
        return Meal::create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => (float) $data['price'],
            'image' => $data['image'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updateMeal(string $id, array $data): object
    {
        $meal = $this->findMealOrFail($id);

        $payload = [
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => (float) $data['price'],
            'updated_at' => now(),
        ];

        if (array_key_exists('image', $data)) {
            $payload['image'] = $data['image'];
        }

        $meal->update($payload);

        return $meal->fresh();
    }

    public function deleteMeal(string $id): void
    {
        $meal = $this->findMealOrFail($id);
        $meal->delete();
    }

    private function withCategory(object $meal, Collection $categories): object
    {
        $meal->category = $categories->get($meal->category_id ?? '') ?? (object) [
            'id' => null,
            'name' => 'Uncategorized',
            'slug' => null,
        ];

        return $meal;
    }
}
