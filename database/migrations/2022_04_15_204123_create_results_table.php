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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admit_card_id')->constrained();
            $table->string('session');
            $table->string('class');
            $table->string('roll');
            $table->json('marks');
            /*$table->integer('hindi');
            $table->integer('english');
            $table->integer('maths');
            $table->integer('drawing');
            $table->integer('science')->nullable();
            $table->integer('sst')->nullable();
            $table->integer('computer')->nullable();
            $table->integer('gk')->nullable();
            $table->json('orals')->nullable();
            */
            $table->integer('total');
            $table->string('total_text');
            $table->integer('full_marks');
            $table->foreignId('uploaded_by_id')->nullable()->constrained('users');
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
        Schema::dropIfExists('results');
    }
};