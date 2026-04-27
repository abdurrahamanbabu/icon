<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if(!Schema::hasTable('icons')) {
            Schema::create('icons', function (Blueprint $table) {
                $table->id();
                $table->string('icon')->unique();
                $table->timestamps();
            });
        }   

        if (Schema::hasTable('icons')) {
            $sql_path = realpath(__DIR__ . '/../icons.sql');
            if ($sql_path && file_exists($sql_path)) {
                // Only seed SQL data for MySQL/MariaDB
                $driver = DB::connection()->getDriverName();
                if (in_array($driver, ['mysql', 'mariadb'])) {
                    DB::statement('SET FOREIGN_KEY_CHECKS=0');
                    DB::table('icons')->truncate();
                    DB::unprepared(file_get_contents($sql_path));
                    DB::statement('SET FOREIGN_KEY_CHECKS=1');
                }
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('icons');
    }
};