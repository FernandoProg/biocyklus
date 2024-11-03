<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'fernando',
                'email' => 'fernandoach2025@gmail.com',
                'password' => Hash::make(12345678),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'francisca',
                'email' => 'francisca@gmail.com',
                'password' => Hash::make(12345678),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
        $admin = User::firstOrCreate(
            ['email' => 'fernandoach2025@gmail.com']
        );
        $admin->assignRole('administrador');
        $user = User::firstOrCreate(
            ['email' => 'francisca@gmail.com']
        );
        $user->assignRole('usuario');
    }
}
