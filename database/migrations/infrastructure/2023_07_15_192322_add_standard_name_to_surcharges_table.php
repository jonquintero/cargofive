<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('surcharges', function (Blueprint $table) {
            $table->foreignId('standard_surcharge_name_id')->after('name')->nullable()->constrained('standard_surcharge_names')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surcharges', function (Blueprint $table) {
           $table->dropColumn('standard_name');
        });
    }
};
