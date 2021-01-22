@extends('admin.master')

@section('title', 'Edit products')

@section('breadcrumb')
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/products') }}">Products&nbsp;</a>
    </li>
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/products/edit/'.$product->id) }}">Edit</a>
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
        <div class="panel glass m-1 fg-4">
            <div class="panel-header">
                <h2>Edit Product</h2>
            </div>
            <div class="panel-body">
                <div class="form">
                    {!! Form::open(['url'=> '/admin/products/update/'.$product->id, 'files'=>true, 'method' => 'put']) !!}
                        {!! Form::label('name', 'Name', []) !!}
                        {!! Form::text('name', $product->name, []) !!}

                        {!! Form::label('description', 'Description', []) !!}
                        {!! Form::textarea('description', $product->description, ['class'=> 'w-100 mb-1', 'id'=>'editor']) !!}

                        {!! Form::label('category', 'Category', []) !!}
                        {!! Form::select('category', $categories, $product->category_id, ['class'=> 'w-33','placeholder' => 'Pick a category...']) !!}
                        <br/>
                        {!! Form::label('inDiscount', 'Discount', []) !!}
                        {!! Form::select('inDiscount', ['0' => 'No', '1' => 'Yes'], $product->in_discount, ['class'=> 'w-33']) !!}
                        <br/>
                        {!! Form::label('discount', 'Amount discounted', []) !!}
                        {!! Form::number('discount', $product->discount, ['class'=> 'w-33', 'min'=>'0.00', 'step'=>'any']) !!}
                        <br/>
                        {!! Form::label('visible', 'Visible?', []) !!}
                        {!! Form::select('visible', ['0' => 'No', '1' => 'Yes'], $product->status, ['class'=> 'w-33']) !!}
                        <br/>
                        {!! Form::label('price', 'Price', []) !!}
                        {!! Form::number('price', $product->price, ['class'=> 'w-25', 'min'=>'0.00', 'step'=>'any']) !!}
                        <br/>
                        {{-- Edit image is pending to do --}}
                        @if ($product->image)
                        <a data-fancybox="gallery" href="{{ url('/uploads'.$product->file_path.'/'.$product->image) }}">
                            <img src="{{ url('/uploads'.$product->file_path.'/t_'.$product->image) }}"
                                alt="{{$product->name}}"
                                width="100px"
                            />
                        </a>
                        <br/>
                        @endif
                        {!! Form::label('image', 'Image', []) !!}
                        {!! Form::file('image', ['class' => 'w-50', 'accept' => 'image/*']) !!}

                        {!! Form::submit('Add', ['class' => 'btn-submit btn-success btn-block']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
        <br/>
        <div class="panel glass m-1 fg-0 w-25">
            <div class="panel-header">
                <h2>Gallery Product</h2>
            </div>
            <div class="panel-body">

                <div class="gallery mt-1">

                    @if (kvfj(Auth::user()->permissions, 'product_gallery_add'))
                        {!! Form::open(['url'=> '/admin/product/'.$product->id.'/gallery/add', 'files'=>true, 'id' => 'form_product_gallery']) !!}
                            {!! Form::file('input_file', ['id'=> 'input_file', 'accept' => 'image/*', 'required']) !!}
                        {!! Form::close() !!}
                        <div class="gallery-add">
                            <a id="btn_upload_image" href="#" >
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    @endif

                    @foreach ($product->getGallery as $img)
                        <div class="gallery-item">
                            <a data-fancybox="gallery" href="{{ url('/uploads/'.$img->file_path.'/'.$img->file_name) }}">
                                <img src="{{ url('/uploads/'.$img->file_path.'/t_'.$img->file_name) }} " />
                            </a>
                            @if (kvfj(Auth::user()->permissions, 'product_gallery_delete'))
                                <div class="gallery-item-opts">
                                    <a href="{{ url('admin/product/'.$product->id.'/gallery/'.$img->id.'/delete') }}" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
