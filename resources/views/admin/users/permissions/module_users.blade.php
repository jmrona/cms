<div class="panel glass w-25 fg-1 m-1">
    <div class="panel-header">
        <h2>Module users</h2>
    </div>
    <div class="panel-body permissions">
        <div class="w-100">
            {!! Form::checkbox('users_list', true, kvfj($user->permissions,'users_list'), []) !!}
            {!! Form::label('users_list', 'Access to the user list', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('users_edit', true, kvfj($user->permissions,'users_edit'), []) !!}
            {!! Form::label('users_edit', 'Edit users', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('users_ban', true, kvfj($user->permissions,'users_ban'), []) !!}
            {!! Form::label('users_ban', 'Ban/Active users', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('users_permissions', true, kvfj($user->permissions,'users_permissions'), []) !!}
            {!! Form::label('users_permissions', 'Grant permissions', ['class' => 'ml-1']) !!}
        </div>
    </div>
</div>
