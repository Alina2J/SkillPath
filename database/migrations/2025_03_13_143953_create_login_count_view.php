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
        DB::statement("CREATE VIEW login_count AS
                            SELECT
                                v.user_id,
                                COUNT(v.id) AS total_logins
                            FROM visits v
                            JOIN users u ON u.id = v.user_id
                            WHERE u.role_id = 2
                            GROUP BY v.user_id;
                        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('login_count_view');
    }
};
