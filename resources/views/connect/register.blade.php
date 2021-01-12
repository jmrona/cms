@extends('connect.master')

@section('title', 'Register')

@section('content')
    <div class="box box-register shadow">
        <div class="header">
            <a href="{{ url('/')}}">
                <img src="{{url('/static/images/logo-jr.svg')}}"/>
                <p>JmRona</p>
            </a>
        </div>
        <div class="content">
            {{-- Errors --}}
            @if(Session::has('message'))
                <div class="container mt-3 mb-3">
                    <div class="p-3 alter alert-{{Session::get('typealert')}}">
                        @if ($errors->any())
                            <h6>{{Session::get('message')}}</h6>
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
                            }, 1000);
                        </script>
                    </div>
                </div>
            @endif
            {!! Form::open(['url'=> '/register']) !!}
                {!! Form::label('firstname', 'First name', []) !!}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    {!! Form::text('firstname', null, ['class'=> 'form-control', 'required']) !!}
                </div>

                {!! Form::label('lastname', 'Last name', ['class' => 'mt-2']) !!}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                    </div>
                    {!! Form::text('lastname', null, ['class'=> 'form-control', 'required']) !!}
                </div>

                {!! Form::label('email', 'Email', ['class' => 'mt-2']) !!}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-envelope-open"></i></div>
                    </div>
                    {!! Form::email('email', null, ['class'=> 'form-control', 'required']) !!}
                </div>

                {!! Form::label('password', 'Password', ['class' => 'mt-2']) !!}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-key"></i></i></div>
                    </div>
                    {!! Form::password('password', ['class'=> 'form-control', 'required']) !!}
                </div>

                {!! Form::label('cpassword', 'Confirm password', ['class' => 'mt-2']) !!}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-key"></i></i></div>
                    </div>
                    {!! Form::password('cpassword', ['class'=> 'form-control', 'required']) !!}
                </div>

                {!! Form::submit('Register', ['class' => 'btn btn-success mt-4']) !!}
            {!! Form::close() !!}
        </div>

        <div class="footer mt-2">
            <a href="{{ url('/login')}}">Do you have an account? Log in</a>
        </div>

    </div>
@stop
