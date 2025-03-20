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
        DB::statement("CREATE VIEW norm_days_since_last_login AS
                            SELECT
                                dl.user_id,
                                CAST(dl.days_since_last AS DECIMAL(12, 4)) / mv.max_days_since_last_login AS norm_days_since_last_login
                            FROM
                                days_since_last_login dl
                            CROSS JOIN
                                max_values mv;
                                                ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('norm4_view');
    }
};
