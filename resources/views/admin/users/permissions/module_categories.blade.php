<div class="panel glass w-25 fg-1 m-1">
    <div class="panel-header">
        <h2>Module categories</h2>
    </div>
    <div class="panel-body permissions">
        <div class="w-100">
            {!! Form::checkbox('category_list', true, kvfj($user->permissions,'category_list'), []) !!}
            {!! Form::label('category_list', 'Categories access', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('category_add', true, kvfj($user->permissions,'category_add'), []) !!}
            {!! Form::label('category_add', 'Add categories', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('category_edit', true, kvfj($user->permissions,'category_edit'), []) !!}
            {!! Form::label('category_edit', 'Edit categories', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('category_delete', true, kvfj($user->permissions,'category_delete'), []) !!}
            {!! Form::label('category_delete', 'Delete categories', ['class' => 'ml-1']) !!}
        </div>
    </div>
</div>
