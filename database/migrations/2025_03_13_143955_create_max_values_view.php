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
        DB::statement("CREATE VIEW max_values AS
                            SELECT
                                MAX(lc.total_logins) AS max_logins,
                                MAX(f3.average_login_frequency) AS max_frequency,
                                MAX(tu.total_time_seconds) AS max_usage_time,
                                MAX(dl.days_since_last) AS max_days_since_last_login,
                                MAX(dr.days_since_reg) AS max_days_since_registration
                            FROM
                                login_count lc
                            CROSS JOIN
                                frequency_3 f3
                            CROSS JOIN
                                total_usage_time tu
                            CROSS JOIN
                                days_since_last_login dl
                            CROSS JOIN
                                days_since_registration dr;
                                                ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('max_values_view');
    }
};
