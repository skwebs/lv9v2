<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admit_cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mother')->nullable();
            $table->string('father');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('dob')->nullable();
            $table->string('aadhaar')->nullable();
            $table->string('mobile');
            $table->string('address');
            $table->string('class');
            //$table->enum('student_type',['Existing','New']);
            $table->bigInteger('roll');
            $table->string('image')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admit_cards');
    }
};