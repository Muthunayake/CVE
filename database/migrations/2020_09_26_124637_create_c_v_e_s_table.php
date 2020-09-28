<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCVESTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cve', function (Blueprint $table) {
            $table->id();
            $table->text('severity_v2')->nullable();
            $table->text('severity_v3')->nullable();
            $table->text('type')->nullable();
            $table->text('title')->nullable();
            $table->text('cve')->nullable();
            $table->float('cvss_v2')->nullable();
            $table->float('cvss_v3')->nullable();
            $table->text('cwe_id')->nullable();
            $table->text('cwe_label')->nullable();
            $table->text('affected_vendors')->nullable();
            $table->text('product_names')->nullable();
            $table->text('affected_cpes')->nullable();
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
        Schema::dropIfExists('cve');
    }
}
