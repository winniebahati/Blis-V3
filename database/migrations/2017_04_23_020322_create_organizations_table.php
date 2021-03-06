<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()
                ->references('users')->on('id')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('active')->default(1);
            $table->enum('type', [
                'healthcare_provider',
                'hospital_department',
                'organizational_team',
                'government',
                'insurance_company',
                'educational_institute',
                'religious_institution',
                'clinical_research_sponsor',
                'community_group',
                'corporation',
                'other'
            ]);
            $table->string('name');
            $table->string('alias')->nullable();
            $table->integer('telecom')->nullable()
                ->references('contact_points')->on('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('address')->nullable()
                ->references('addresses')->on('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('part_of')->nullable()
                ->references('organizations')->on('id')->onUpdate('cascade')->onDelete('cascade');
            //Has organization contact linked
            $table->string('end_point')->nullable();
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
        Schema::dropIfExists('organizations');
    }
}
