<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW max_normalize AS
        SELECT
            SUM(a.Additive_criterion) AS maxNormalize
        FROM
            additive a;");

    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('max_normalize_view');
    }
};
