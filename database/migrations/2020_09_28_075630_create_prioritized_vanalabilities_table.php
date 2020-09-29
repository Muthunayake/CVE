<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrioritizedVanalabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prioritized_vanalabilities', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable();
            $table->text('host_name')->nullable();
            $table->text('vulnerability')->nullable();
            $table->text('solution')->nullable();
            $table->text('cve_id')->nullable();
            $table->float('vps')->nullable();
            $table->float('cvss_v3')->nullable();
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
        Schema::dropIfExists('prioritized_vanalabilities');
    }
}
