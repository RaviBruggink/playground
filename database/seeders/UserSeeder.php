<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Organisation;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $organisation = Organisation::firstOrCreate(['name' => 'Moonly Software']);

        $moonly = User::firstOrCreate(['email' => 'info@moonlysoftware.com'], [
            'name' => 'Moonly',
            'date_of_birth' => '2020-01-01',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
            'current_organisation_id' => $organisation->id,
        ]);

        setPermissionsTeamId($organisation->id);
        $moonly->assignRole('admin');

        $bart = User::firstOrCreate(['email' => 'bart@moonlysoftware.com'], [
            'name' => 'Bart Scheffer',
            'date_of_birth' => '1993-04-18',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('Moonly2020'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
            'current_organisation_id' => $organisation->id,
        ]);

        setPermissionsTeamId($organisation->id);
        $bart->assignRole('admin');

        $bart->meta()->create([
            'key' => 'user-hobbies',
            'value' => 'Painting',
        ]);

        if (! $organisation->users()->where('user_id', $bart->id)->exists()) {
            $organisation->users()->attach($bart, ['id' => Str::uuid()]);
        }

        if (! $organisation->users()->where('user_id', $moonly->id)->exists()) {
            $organisation->users()->attach($moonly, ['id' => Str::uuid()]);
        }
    }
}
