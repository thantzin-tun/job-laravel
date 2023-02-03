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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->integer("applicant")->default(1);
            $table->string("company_name");
            $table->string("logo")->nullable();
            $table->string("salary");
            $table->mediumText("description");
            $table->string("job_deadline");
            $table->string("address");
            $table->mediumInteger("category_id");
            $table->mediumInteger("city_id");
            $table->mediumInteger("level_id");
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
        Schema::dropIfExists('posts');
    }
};
