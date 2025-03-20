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
        DB::statement("CREATE VIEW additive AS
                        SELECT
                            u.id,
                            COALESCE(nf.norm_frequency, 0) +
                            COALESCE(nut.norm_usage_time, 0) +
                            COALESCE(nl.norm_logins, 0) +  -- Исправлено: было norm_visits, стало norm_logins
                            COALESCE(ndll.norm_days_since_last_login, 0) +
                            COALESCE(ndsr.norm_days_since_registration, 0) AS Additive_criterion
                        FROM
                            users u
                        LEFT JOIN norm_frequency nf ON nf.user_id = u.id
                        LEFT JOIN norm_usage_time nut ON nut.user_id = u.id
                        LEFT JOIN norm_logins nl ON nl.user_id = u.id  -- Исправлено
                        LEFT JOIN norm_days_since_last_login ndll ON ndll.user_id = u.id
                        LEFT JOIN norm_days_since_registration ndsr ON ndsr.user_id = u.id;
                                                ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('additive_view');
    }
};
