@extends('admin.master')

@section('title', 'Add category')

@section('breadcrumb')
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/categories') }}">Categories&nbsp;</a>
    </li>
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/categories/add') }}">Add</a>
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
                <h2>Add category</h2>
            </div>
            <div class="panel-body">
                <div class="form">
                    {!! Form::open(['url'=> '/admin/categories/store']) !!}
                        {!! Form::label('name', 'Category name*', []) !!}
                        {!! Form::text('name', null, []) !!}

                        {!! Form::label('description', 'Shortly description', []) !!}
                        {!! Form::text('description', null, []) !!}

                        {!! Form::label('module', 'Module*', []) !!}
                        {!! Form::select('module', $modules, null, ['class'=> 'w-50','placeholder' => 'Pick a module...']) !!}

                        {!! Form::submit('Add', ['class' => 'btn-submit btn-success']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
@endsection
