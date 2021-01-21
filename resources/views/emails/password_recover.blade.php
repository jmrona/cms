@extends('emails.master')

@section('content')
    <p>
        Hola {{$name}},
        <br/><br/>
        Este es un correo electrónico que le ayudará a reestablecer su contraseña. Si usted no solicitó este servicio, por favor ignore este correo.
        <br/><br/>
        Para continuar haga clic en el siguiente botón e ingrese este código: <strong style="font-size: 1.2rem">{{$code}}</strong>

        <div style="display: flex; flex-flow: row wrap; width:100%; justify-content:center">
            <div style="
                background-color: #4985d3;
                display: inline-block;
                padding: 16px 32px;
                border-radius: 5px;
                border: 2px solid #396aaa;
                cursor: pointer;
            ">
                <a href="{{ url('/reset?email='.$email)}}"
                style="text-decoration: none; color: #f5f5f5;">
                    <strong>Reset password</strong>
                </a>
            </div>
        </div>

        <div>
            <p>Si el botón anterior no le funciona, copie y peque el siguiente enlace en su navegador:</p>
            <p>
                <a href="{{ url('/reset?email='.$email)}}">{{ url('/reset?email='.$email)}}</a>
            </p>
        </div>
    </p>
@stop
