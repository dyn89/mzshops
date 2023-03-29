<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProductCateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_cate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cate_name', 32)->comment('产品分类');
            $table->integer('cate_bid')->comment('所属父类ID');
            $table->string('cate_img')->nullable()->default('')->comment('产品分类描述图');
            $table->tinyInteger('status')->default(1)->comment('分类可用状态');
            $table->timestamps();
        });

        DB::statement("alter table `product_cate` comment '产品分类表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoes_product_cate');
    }
}
