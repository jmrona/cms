@extends('admin.master')

@section('title', 'Users')

@section('breadcrumb')
    <li class="breadcrumb-item">
        / <a href="{{ url('/admin/users/all') }}">Users</a>
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
        <div class="panel glass">
            <div class="panel-header">
                <h2>Users</h2>
                <div class="dropdown">
                    <a class="btn" href="#" >
                        <i class="fas fa-filter"></i> Filter
                        <ul class="glass">
                                <li><a href="{{url('admin/users/all')}}">All</a></li>
                                <li><a href="{{url('admin/users/0')}}">Registered</a></li>
                                <li><a href="{{url('admin/users/1')}}">Verified</a></li>
                                <li><a href="{{url('admin/users/100')}}">Banned</a></li>
                        </ul>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                               <td>{{ $user->id }}</td>
                               <td>{{ $user->firstname }}</td>
                               <td>{{ $user->lastname }}</td>
                               <td>{{ $user->email }}</td>
                               <td>{{ getUserRole(null, $user->role)}}</td>
                               <td>{{ getUserStatus(null, $user->status)}}</td>
                               <td>
                                   @if (kvfj(Auth::user()->permissions, 'users_edit'))
                                   <a href="{{ url('/admin/user/'.$user->id).'/edit' }}" class="tooltip btn btn-warning">
                                        <i class="fas fa-user-edit"></i>
                                        <span class="tooltiptext">Edit</span>
                                    </a>
                                    @endif
                                    @if (kvfj(Auth::user()->permissions, 'users_permissions'))
                                    <a href="{{ url('/admin/user/'.$user->id).'/permissions' }}" class="tooltip btn btn-default">
                                        <i class="fas fa-user-cog"></i>
                                        <span class="tooltiptext">Permissions</span>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                            <tr class="pagination">
                                <td colspan="7"> {{$users->links()}}</td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
