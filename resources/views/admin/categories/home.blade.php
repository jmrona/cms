@extends('admin.master')

@section('title', 'Categories')

@section('breadcrumb')
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/categories') }}">Categories</a>
    </li>
@endsection

@section('content')
    <div class="content">
        {{-- Errors --}}
        @if(Session::has('message'))
            <div class="">
                <div class=" glass alert alert-{{Session::get('typealert')}}">
                    <h6>{{Session::get('message')}}</h6>
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <script>
                        $('.alert').slideDown();

                        setTimeout(function() {
                            $('.alert').slideUp();
                        }, 4000);
                    </script>
                </div>
            </div>
        @endif
        <div class="panel glass w-50 fg-0">
            <div class="panel-header">
                <h2>Categories</h2>
                @if (kvfj(Auth::user()->permissions, 'category_add'))
                <div>
                    <a class="btn btn-success" href="{{ url('/admin/categories/add') }}" >
                        <i class="fas fa-plus"></i> Add category
                    </a>
                </div>
                @endif
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Module</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categories != '')
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        @if($category->module == "0")
                                            Products
                                        @elseif($category->module == "1")
                                            Blog
                                        @endif
                                    </td>
                                    <td>
                                        @if (kvfj(Auth::user()->permissions, 'category_edit'))
                                        <a class="tooltip btn btn-warning" href="{{ url('/admin/categories/edit/'.$category->id)}}">
                                            <i class="fas fa-pen"></i>
                                            <span class="tooltiptext">Edit</span>
                                        </a>
                                        @endif
                                        @if (kvfj(Auth::user()->permissions, 'category_delete'))
                                        <a class="tooltip btn btn-danger" href="{{ url('/admin/categories/delete/'.$category->id)}}">
                                            <i class="fas fa-trash"></i>
                                            <span class="tooltiptext">Delete</span>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">No categories found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
