<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueriesTable extends Migration
{
    public function up()
    {
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('csv_upload_id');
            $table->text('query');
            $table->text('response')->nullable();
            $table->timestamps();

            $table->foreign('csv_upload_id')->references('id')->on('csv_uploads')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('queries');
    }
}