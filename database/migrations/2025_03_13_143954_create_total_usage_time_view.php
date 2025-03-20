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
        DB::statement("CREATE VIEW total_usage_time AS
                        SELECT
                            u.id AS user_id,
                            COALESCE(SUM(ABS(u.usege_time)), 0) AS total_time_seconds
                        FROM users u
                        WHERE u.role_id = 2
                        GROUP BY u.id;
                                                ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('total_usage_time_view');
    }
};
