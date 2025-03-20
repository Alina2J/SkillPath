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
        DB::statement("CREATE VIEW days_since_last_login AS
                        SELECT
                            u.id AS user_id,
                            COALESCE(DATEDIFF(CURDATE(), u.last_login), 0) AS days_since_last
                        FROM users u
                        WHERE u.role_id = 2;
                                                ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('days_since_last_login_view');
    }
};
