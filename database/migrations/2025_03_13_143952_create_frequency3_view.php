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
        DB::statement("CREATE VIEW frequency_3 AS
                        SELECT
                            f1.id,
                            COALESCE(AVG(CAST(DATEDIFF(f2.login_date, f1.login_date) AS DECIMAL(12, 4))), 0) AS average_login_frequency
                        FROM frequency_1 f1
                        LEFT JOIN frequency_2 f2 ON f2.id = f1.id AND f2.login_number = f1.login_number
                        GROUP BY f1.id;");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('frequency3_view');
    }
};
