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
        Schema::table('users', function (Blueprint $table) {      //mora biti users zato što naknadno nadodajemo red
            $table->string('image')->nullable();
            $table->string('bio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {             //mora biti popunjeno zato što ako želimo napraviti roll back moraju biti elementi
            $table->dropColumn('image');
            $table->dropColumn('bio');
        });
    }
};
