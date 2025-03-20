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
        DB::statement("CREATE VIEW norm_logins AS
                        SELECT
                            lc.user_id,
                            CAST(lc.total_logins AS DECIMAL(12, 4)) / mv.max_logins AS norm_logins
                        FROM
                            login_count lc
                        CROSS JOIN
                            max_values mv;
                                                ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('norm1_view');
    }
};
