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
        DB::statement("CREATE VIEW norm_days_since_registration AS
                            SELECT
                                dr.user_id,
                                CAST(dr.days_since_reg AS DECIMAL(12, 4)) / mv.max_days_since_registration AS norm_days_since_registration
                            FROM
                                days_since_registration dr
                            CROSS JOIN
                                max_values mv;
                                                ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('norm5_view');
    }
};
