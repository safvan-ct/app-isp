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
        $renames = [
            'view menus' => 'view courses',
            'store menus' => 'store courses',
            'update menus' => 'update courses',
            'sort menus' => 'sort courses',
            'active menus' => 'active courses',

            'view modules' => 'view chapters',
            'store modules' => 'store chapters',
            'update modules' => 'update chapters',
            'sort modules' => 'sort chapters',
            'active modules' => 'active chapters',

            'view questions' => 'view lessons',
            'store questions' => 'store lessons',
            'update questions' => 'update lessons',
            'sort questions' => 'sort lessons',
            'active questions' => 'active lessons',
        ];

        foreach ($renames as $old => $new) {
            DB::table('permissions')->where('name', $old)->update(['name' => $new]);
        }

        $deletes = [
            'view answers', 'store answers', 'update answers', 'sort answers', 'active answers'
        ];
        DB::table('permissions')->whereIn('name', $deletes)->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not necessary for this change
    }
};
