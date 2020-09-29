<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('detail')->nullable();
            $table->date('buy_at')->nullable();
            $table->date('assign_at')->nullable();
            $table->string('status')->nullable();
            $table->string('guarantee')->nullable();
            $table->string('price')->nullable();
            $table->string('amount')->nullable();
            $table->unsignedBigInteger('type');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
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
        Schema::dropIfExists('equipment');
    }
}
