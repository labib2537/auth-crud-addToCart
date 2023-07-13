<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Cart') }}
        </h2>
    </x-slot>

   
    <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        
    <h1 class="my-5">My Cart</h1>
    @if(Session::has('message'))
        <p class="alert alert-success">{{Session::get('message')}}</p>
        @endif  
        <a href="{{route('dashboard')}}" class="btn btn-primary mb-3">Show All Products</a>
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Brand</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $key=>$item)
    @if($item->is_active==0)
    <tr>
      <td>{{++$key}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->category_name}}</td>
      <td>{{$item->brand_name}}</td>
      <td>{{$item->description}}</td>
      <td><img src="{{asset('uploads/'.$item->image)}}" style="width: 200px; height:160px;"></td>
      <td>
      <form action="{{route('product_cart_remove')}}" method="post">
                                        @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="hidden" name="status" value="{{$item->is_active}}">
                                    <button class="btn btn-primary" type="submit"></i>Remove Cart</button>
                                    </form>
      </td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

</x-app-layout>
