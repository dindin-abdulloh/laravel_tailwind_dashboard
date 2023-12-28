<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('transaction_code')->nullable();
            $table->decimal('change_due', 10, 2);
            $table->decimal('amount_paid', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('transaction_code');
            $table->dropColumn('change_due');
            $table->dropColumn('amount_paid');
        });
    }
}
