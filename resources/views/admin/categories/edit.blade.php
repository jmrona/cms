@extends('admin.master')

@section('title', 'Edit category')

@section('breadcrumb')
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/categories') }}">Categories&nbsp;</a>
    </li>
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/categories/edit/'.$category->id) }}">Edit</a>
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
        <div class="panel glass fg-0 w-25">
            <div class="panel-header">
                <h2>Edit category</h2>
            </div>
            <div class="panel-body">
                <div class="form">
                    {!! Form::open(['url'=> '/admin/categories/update/'.$category->id, 'method' => 'put']) !!}
                        {!! Form::label('name', 'Category name*', []) !!}
                        {!! Form::text('name', $category->name, []) !!}

                        {!! Form::label('description', 'Shortly description', []) !!}
                        {!! Form::text('description', $category->description, []) !!}

                        {!! Form::label('module', 'Module*', []) !!}
                        {!! Form::select('module', $modules, $category->module, ['class'=> 'w-50','placeholder' => 'Pick a module...']) !!}

                        {!! Form::submit('Update', ['class' => 'btn-submit btn-success mt-1']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection
