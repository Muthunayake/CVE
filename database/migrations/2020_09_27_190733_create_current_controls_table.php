<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_controls', function (Blueprint $table) {
            $table->id();
            $table->text('ip_address')->nullable();
            $table->text('host_name')->nullable();
            $table->string('protocol')->nullable();
            $table->string('port')->nullable();
            $table->string('ips_signature')->nullable();
            $table->string('edr_prevention')->nullable();
            $table->string('xdr_prevention')->nullable();
            $table->string('sandbox_prevention')->nullable();
            $table->string('anti_malware_prevention')->nullable();
            $table->string('multi_factor_authentication')->nullable();
            $table->string('virtual_patching')->nullable();
            $table->string('zero_day_prevention')->nullable();
            $table->string('exploit_prevention')->nullable();
            $table->string('other')->nullable();
            $table->text('cve_id')->nullable();
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
        Schema::dropIfExists('current_controls');
    }
}
