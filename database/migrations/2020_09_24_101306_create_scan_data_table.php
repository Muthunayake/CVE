<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScanDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scan_data', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable();
            $table->string('host_name_fdqn')->nullable();
            $table->text('vuln_name')->nullable();
            $table->string('severity')->nullable();
            $table->string('protocol')->nullable();
            $table->string('port')->nullable();
            $table->text('vulnerability')->nullable();
            $table->text('solution')->nullable();
            $table->float('cvssv3_score')->nullable();
            $table->text('cve_id')->nullable();
            $table->text('criticality')->nullable();
            $table->text('exposure')->nullable();
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
        Schema::dropIfExists('scan_data');
    }
}
