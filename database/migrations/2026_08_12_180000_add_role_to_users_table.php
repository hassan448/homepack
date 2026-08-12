<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('content')->after('password');
        });

        DB::table('users')
            ->where('email', 'admin@homepack.com')
            ->update(['role' => 'admin']);

        DB::table('users')
            ->where('email', '!=', 'admin@homepack.com')
            ->whereNull('role')
            ->update(['role' => 'content']);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
