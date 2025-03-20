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
        DB::statement("CREATE VIEW frequency_2 AS
                        SELECT
                            u.id,
                            NULLIF(u.last_login, 0) AS login_date,
                            NULLIF(ROW_NUMBER() OVER (PARTITION BY u.id ORDER BY u.last_login), 0) - 1 AS login_number
                        FROM users u
                        WHERE u.role_id = 2
                        ORDER BY u.id, u.last_login;");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('frequency2_view');
    }
};
