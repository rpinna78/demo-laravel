<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\BookPrivacyEnum;
use App\Enums\BookStatusEnum;

/** 
* ** DEMO-LARAVEL **
* Migration per la tabella dei books
*/
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('image_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->enum('privacy', array_column(BookPrivacyEnum::cases(), 'value'))->default(BookPrivacyEnum::PRIVATE->value);
            $table->enum('status', array_column(BookStatusEnum::cases(), 'value'))->default(BookStatusEnum::DRAFT->value);
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
        Schema::dropIfExists('books');
    }
};
