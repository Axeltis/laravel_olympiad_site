<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
            'id' => Str::uuid(),
            'name' => 'Пользователь',
            'slug' => 'user',
            ]
        );

        DB::table('roles')->insert(
            [
                'id' => Str::uuid(),
                'name' => 'Модератор',
                'slug' => 'moderator',
            ]
        );

        DB::table('roles')->insert(
            [
                'id' => Str::uuid(),
                'name' => 'Администратор',
                'slug' => 'admin',
            ]
        );
    }
}
