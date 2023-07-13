<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product List') }}
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
        <h1 class="my-5">All Products</h1>
        @if(Session::has('message'))
        <p class="alert alert-success">{{Session::get('message')}}</p>
        @endif  
    <a href="{{route('product_add')}}" class="btn btn-primary mb-3">Add New Product</a>
    <a href="{{route('product_cartList')}}" class="btn btn-primary mb-3">My Cart</a>
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Category</th>
      <th scope="col">Brand</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $key=>$item)
    <tr>
      <td>{{++$key}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->category_name}}</td>
      <td>{{$item->brand_name}}</td>
      <td>{{$item->description}}</td>
      <td><img src="{{asset('uploads/'.$item->image)}}" style="width: 180px; height:120px;"></td>
      <td>

                                    <form action="{{route('product_edit')}}" method="post">
                                        @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button class="btn btn-success m-1" type="submit"></i>Edit</button>
                                    </form>
      
                                    <form action="{{route('product_delete')}}" method="post">
                                        @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <button class="btn btn-danger m-1" type="submit" onclick="return confirm('Are you sure?')"></i>Delete</button>
                                    </form>

                                    <form action="{{route('product_cart')}}" method="post">
                                        @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="hidden" name="status" value="{{$item->is_active}}">
                                    <button class="btn btn-primary m-1" type="submit"></i>Add to Cart</button>
                                    </form>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

</x-app-layout>
