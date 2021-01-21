@extends('connect.master')

@section('title', 'Recover password')

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

            {!! Form::open(['url'=> '/recover', 'method' => 'post']) !!}
                {!! Form::label('email', 'Email', []) !!}
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-envelope-open"></i></div>
                    </div>
                    {!! Form::email('email', null, ['class'=> 'form-control']) !!}
                </div>


                {!! Form::submit('Recover password', ['class' => 'btn btn-success mt-4']) !!}
            {!! Form::close() !!}
            <div class="footer mt-2">
                <a href="{{ url('/login')}}">Do you have an account? Log in</a>
            </div>
        </div>
    </div>
@stop
