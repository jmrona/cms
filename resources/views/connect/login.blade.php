@extends('connect.master')

@section('title', 'Login')

@section('content')
    <div class="box box-login shadow">
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

            {!! Form::open(['url'=> '/login']) !!}
                {!! Form::label('email', 'Email', []) !!}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-envelope-open"></i></div>
                    </div>
                    {!! Form::email('email', null, ['class'=> 'form-control']) !!}
                </div>

                {!! Form::label('password', 'Password', ['class' => 'mt-2']) !!}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-key"></i></i></div>
                    </div>
                    {!! Form::password('password', ['class'=> 'form-control']) !!}
                </div>
                {!! Form::submit('Login', ['class' => 'btn btn-success mt-4']) !!}
            {!! Form::close() !!}
        </div>
        <div class="footer mt-2">
            <a href="{{ url('/register')}}">Don't you have an account? Sign up</a>
            <a href="{{ url('/recover')}}">Recover my password</a>
        </div>
    </div>
@stop
