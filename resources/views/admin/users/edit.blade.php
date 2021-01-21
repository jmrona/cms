@extends('admin.master')

@section('title', 'Edit users')

@section('breadcrumb')
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/users/all') }}">Users&nbsp;</a>
    </li>
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/user/'.$user->id.'/edit/') }}">Edit</a>
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
        <div class="panel glass m-1 fg-1">
            <div class="panel-header">
                <h2>Users detail</h2>
            </div>
            <div class="panel-body">
                <div class="user-details">
                    @if (is_null($user->avatar))
                        <img src="{{ url('/static/images/avatar.png') }}" alt="avatar">
                    @else
                        <img src="{{ url('/uploads/user/'.$user->id.'/avatar.png') }}" alt="avatar">
                    @endif
                    <p>
                        <span class="label">Name:</span>
                        <span class="text">{{$user->firstname}} {{$user->lastname}}</span>
                        <span class="label">Email:</span>
                        <span class="text">{{$user->email}}</span>
                        <span class="label">Role:</span>
                        <span class="text">
                            {{ getUserRole(null, $user->role) }}
                        </span>
                        <span class="label">Status:</span>
                        <span class="text">
                            {{ getUserStatus(null, $user->status) }}
                        </span>
                    </p>
                    <p class="mt-1 w-100">
                        @if ($user->status == '100')
                            <a href="{{ url('/admin/user/'.$user->id).'/active' }}" class="tooltip btn btn-success btn-block">
                                <i class="fas fa-user-check"></i> Active user
                                <span class="tooltiptext">Active</span>
                            </a>
                        @else
                            <a href="{{ url('/admin/user/'.$user->id).'/banned' }}" class="tooltip btn btn-danger btn-block">
                                <i class="fas fa-ban"></i> Ban user
                                <span class="tooltiptext">Banned</span>
                            </a>
                        @endif
                    </p>
                </div>

            </div>
        </div>

        <div class="panel glass m-1 fg-2">
            <div class="panel-header">
                <h2>Edit users detail</h2>
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>
@endsection
