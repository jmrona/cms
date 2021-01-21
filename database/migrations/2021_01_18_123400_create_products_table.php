<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default('0');
            $table->string('name');
            $table->text('description');
            $table->string('slug');
            $table->string('file_path');
            $table->string('image');
            $table->decimal('price', 11, 2);
            $table->integer('in_discount');
            $table->integer('discount');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
            $table->foreignId('category_id')->constrained('categories')
                                            ->onUpdate('cascade')
                                            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
