<div class="panel glass w-25 m-1 fg-1">
    <div class="panel-header">
        <h2>Module dashboard</h2>
    </div>
    <div class="panel-body permissions">
        <div class="w-100">
            {!! Form::checkbox('dashboard', true, kvfj($user->permissions,'dashboard'), []) !!}
            {!! Form::label('dashboard', 'Dashboard access', ['class' => 'ml-1']) !!}
        </div>
    </div>
</div>
