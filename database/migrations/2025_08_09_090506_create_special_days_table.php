<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialDaysTable extends Migration
{
    public function up()
    {
        Schema::create('special_days', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique(); 
            $table->enum('type', ['OFF', 'FM', 'HB']);
            $table->string('description')->nullable(); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('special_days');
    }
}
