<?php

use App\Enums\PetGender;
use App\Enums\PetSize;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', PetGender::getValues());
            $table->enum('size', PetSize::getValues());
            $table->string('breed');
            $table->longText('description')->nullable();
            $table->date('lost_at')->nullable();
            $table->date('found_at')->nullable();
            $table->string('slug', 128);
            $table->boolean('status')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::table('pets', function (Blueprint $table) {
            $table->unsignedBigInteger('pet_category_id');
            $table->foreign('pet_category_id')->references('id')->on('pet_categories');
        });

        Schema::table('pets', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
