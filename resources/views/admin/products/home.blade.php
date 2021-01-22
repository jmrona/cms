@extends('admin.master')

@section('title', 'Products')

@section('breadcrumb')
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/products') }}">Products</a>
    </li>
@endsection

@section('content')
    <div class="content">
        <div class="panel glass fg-1 w-50">
            <div class="panel-header">
                <h2>Products</h2>
                <div>
                    @if (kvfj(Auth::user()->permissions, 'products_add'))
                    <a class="btn btn-success" href="{{ url('/admin/products/add') }}" >
                        <i class="fas fa-plus"></i> Add product
                    </a>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products != '')
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <a data-fancybox="gallery" href="{{ url('/uploads'.$product->file_path.'/'.$product->image) }}">
                                            <img src="{{ url('/uploads'.$product->file_path.'/t_'.$product->image) }}"
                                                alt="{{$product->name}}"
                                                width="100px"
                                            />
                                        </a>

                                    </td>
                                    <td>{!! $product->name !!}</td>
                                    <td>{!! html_entity_decode($product->description) !!}</td>
                                    <td>{{$product->cat->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>
                                        @if (kvfj(Auth::user()->permissions, 'products_edit'))
                                        <a class="tooltip btn btn-warning" href="{{ url('/admin/products/edit/'.$product->id)}}">
                                            <i class="fas fa-pen"></i>
                                            <span class="tooltiptext">Edit</span>
                                        </a>
                                        @endif
                                        @if (kvfj(Auth::user()->permissions, 'products_delete'))
                                        <a class="tooltip btn btn-danger" href="{{ url('/admin/products/delete/'.$product->id)}}">
                                            <i class="fas fa-trash"></i>
                                            <span class="tooltiptext">Delete</span>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No products found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
