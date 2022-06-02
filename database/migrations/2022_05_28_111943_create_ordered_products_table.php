<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;

class CreateOrderedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordered_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class, 'order_id')
                        ->references('id')->on('orders')
                        ->cascadeOnDelete()
                        ->cascadeOnUpdate();
            $table->string('name');
            $table->string('sku');
            $table->decimal('amount');
            $table->integer('quantity');
            $table->unsignedTinyInteger('status')->nullable()->index(); 
            $table->softDeletes();                       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordered_products');
    }
};
