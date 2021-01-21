@extends('admin.master')

@section('title', 'Add products')

@section('breadcrumb')
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/products') }}">Products&nbsp;</a>
    </li>
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/products/add') }}">Add</a>
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
        <div class="panel glass w-50">
            <div class="panel-header">
                <h2>Add Product</h2>
            </div>
            <div class="panel-body">
                <div class="form">
                    {!! Form::open(['url'=> '/admin/products/store', 'files'=>true]) !!}
                        {!! Form::label('name', 'Name', []) !!}
                        {!! Form::text('name', null, []) !!}

                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description', null, ['class'=> 'w-100 mb-1', 'id'=>'editor']) !!}

                        {!! Form::label('category', 'Category', []) !!}
                        {!! Form::select('category', $categories, null, ['required' => 'required', 'class'=> 'w-33','placeholder' => 'Pick a category...']) !!}
                        <br/>
                        {!! Form::label('inDiscount', 'Discount', []) !!}
                        {!! Form::select('inDiscount', ['0' => 'No', '1' => 'Yes'], 0, ['class'=> 'w-33']) !!}

                        {!! Form::label('discount', 'Amount discounted', []) !!}
                        {!! Form::number('discount', 0.00, ['class'=> 'w-33', 'min'=>'0.00', 'step'=>'any']) !!}
                        <br/>
                        {!! Form::label('price', 'Price', []) !!}
                        {!! Form::number('price', null, ['class'=> 'w-25', 'min'=>'0.00', 'step'=>'any']) !!}
                        <br/>
                        {!! Form::label('image', 'Image', []) !!}
                        {!! Form::file('image', ['class' => 'w-50', 'accept' => 'image/*']) !!}

                        {!! Form::submit('Add', ['class' => 'btn-submit btn-success']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection
