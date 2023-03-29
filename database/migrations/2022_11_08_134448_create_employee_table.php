<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('em_name', 24)->comment('姓名');
            $table->tinyInteger('em_gender')->default(0)->comment('性别');
            $table->string('em_birth', 12)->comment('生日');
            $table->string('em_email', 48)->comment('邮箱');
            $table->string('em_phone', 24)->comment('手机号');
            $table->string('em_password')->comment('密码');
            $table->text('em_summary')->comment('个人简介');
            $table->tinyInteger('status')->default(1)->comment('状态');
            $table->timestamps();
        });

        DB::statement("alter table `employee` comment '员工表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoes_employee');
    }
}
