<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my__parents', function (Blueprint $table) {
            $table->id();
            $table->string('Email')->unique();
            $table->string('Password');

            //Father information
            $table->string('Name_Father');
            $table->string('National_ID_Father');
            $table->string('Passport_ID_Father');
            $table->string('Phone_Father');
            $table->string('Job_Father');
            $table->unsignedBigInteger('Nationality_Father_id');
            $table->foreign('Nationality_Father_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->unsignedBigInteger('Blood_Type_Father_id');
            $table->foreign('Blood_Type_Father_id')->references('id')->on('type__bloods')->onDelete('cascade');
            $table->unsignedBigInteger('Religion_Father_id');
            $table->foreign('Religion_Father_id')->references('id')->on('religitons')->onDelete('cascade');
            $table->string('Address_Father');

            //Mother information
            $table->string('Name_Mother');
            $table->string('National_ID_Mother');
            $table->string('Passport_ID_Mother');
            $table->string('Phone_Mother');
            $table->string('Job_Mother');
            $table->unsignedBigInteger('Nationality_Mother_id');
            $table->foreign('Nationality_Mother_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->unsignedBigInteger('Blood_Type_Mother_id');
            $table->foreign('Blood_Type_Mother_id')->references('id')->on('type__bloods')->onDelete('cascade');
            $table->unsignedBigInteger('Religion_Mother_id');
            $table->foreign('Religion_Mother_id')->references('id')->on('religitons')->onDelete('cascade');
            $table->string('Address_Mother');
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
        Schema::dropIfExists('my__parents');
    }
}
