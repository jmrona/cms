@extends('admin.master')

@section('title', 'Users')

@section('breadcrumb')
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/users/all') }}">Users&nbsp;</a>
    </li>
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/user/'.$user->id.'/permissions') }}"> {{$user->firstname}}'s Permissions </a>
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

        {!! Form::open([
            'url'=> '/admin/user/'.$user->id.'/permissions',
            'method' => 'post',
            'class' => 'w-100 form'
            ])
        !!}
            @include('admin.users.permissions.module_dashboard')
            @include('admin.users.permissions.module_products')
            @include('admin.users.permissions.module_categories')
            @include('admin.users.permissions.module_users')

            <div class="panel glass w-100 align-self-end">
                {!! Form::submit('Save', ['class' => 'btn btn-success w-25 ml-auto', 'style'=> 'float:right']) !!}
            </div>
        {!! Form::close() !!}

    </div>
@endsection
