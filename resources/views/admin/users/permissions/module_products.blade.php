<div class="panel glass w-25 fg-1 m-1">
    <div class="panel-header">
        <h2>Module products</h2>
    </div>
    <div class="panel-body permissions">
        <div class="w-100">
            {!! Form::checkbox('products_list', true, kvfj($user->permissions,'products_list'), []) !!}
            {!! Form::label('products_list', 'Products access', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('products_add', true, kvfj($user->permissions,'products_add'), []) !!}
            {!! Form::label('products_add', 'Add products', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('products_edit', true, kvfj($user->permissions,'products_edit'), []) !!}
            {!! Form::label('products_edit', 'Edit products', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('products_delete', true, kvfj($user->permissions,'products_delete'), []) !!}
            {!! Form::label('products_delete', 'Delete products', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('product_gallery_add', true, kvfj($user->permissions,'product_gallery_add'), []) !!}
            {!! Form::label('product_gallery_add', 'Add product pictures', ['class' => 'ml-1']) !!}
        </div>
        <div class="w-100">
            {!! Form::checkbox('product_gallery_delete', true, kvfj($user->permissions,'product_gallery_delete'), []) !!}
            {!! Form::label('product_gallery_delete', 'Delete product pictures', ['class' => 'ml-1']) !!}
        </div>
    </div>
</div>
