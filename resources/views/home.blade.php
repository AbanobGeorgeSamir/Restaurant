<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Restaurant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
   <h2 class="text-center my-4">Our Menu</h2>
<div class="text-center mb-4">
  @foreach($categories as $category)
    <a href="{{ route('category.filter', $category->id) }}" class="btn btn-outline-dark m-1">{{ $category->name }}</a>
  @endforeach
  <a href="{{ route('home') }}" class="btn btn-outline-secondary m-1">Show All</a>
</div>
<div class="row">
  @forelse($meals as $meal)
    <div class="col-md-4 mb-4">
      <div class="card h-100">
        @if($meal->image ?? null)
          <img src="{{ asset('storage/' . $meal->image) }}" class="card-img-top" alt="{{ $meal->name }}">
        @endif
        <div class="card-body">
          <h5 class="card-title">{{ $meal->name }}</h5>
          <p class="card-text">{{ Str::limit($meal->description, 100) }}</p>
          <p class="fw-bold">${{ number_format($meal->price, 2) }}</p>
          <p class="text-muted">Category: {{ $meal->category->name ?? 'Uncategorized' }}</p>
        </div>
      </div>
   </div>
  @empty
    <p class="text-center">No meals available for this category.</p>
  @endforelse
</div>
  </div>
</body>
</html>
