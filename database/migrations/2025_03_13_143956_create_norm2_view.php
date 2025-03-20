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
        DB::statement("CREATE VIEW norm_frequency AS
                        SELECT
                            f3.id AS user_id,
                            CAST(f3.average_login_frequency AS DECIMAL(12, 4)) / mv.max_frequency AS norm_frequency
                        FROM
                            frequency_3 f3
                        CROSS JOIN
                            max_values mv;
                                                ");
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('norm2_view');
    }
};
