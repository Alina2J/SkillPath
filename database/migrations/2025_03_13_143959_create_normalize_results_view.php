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
        DB::statement("CREATE VIEW normalize_results AS
        SELECT
            u.id AS user_id,
            (a.Additive_criterion / m.maxNormalize) AS Result,
            ROW_NUMBER() OVER (ORDER BY (a.Additive_criterion / m.maxNormalize) DESC) AS Rating
        FROM
            users u
        JOIN
            additive a ON u.id = a.id
        JOIN
            max_normalize m
        WHERE
            u.role_id = 2
        ORDER BY
            Result DESC;");



    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('normalize_results');
    }
};
