<?php

namespace Database\Seeders;

use App\Models\UserDetail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_details')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = \Faker\Factory::create();

        $subscriber = User::updateOrCreate([
            'first_name'            => 'test',
            'last_name'             => 'subscriber',
            'email'                 => 'subscriber@app.com',
            'phone'                 => '1234567890',
            'gender'                => 1,
            'email_verified_at'     => now(),
            'password'              => \Illuminate\Support\Facades\Hash::make('12345678'),
            'status'                => User::STATUS_ACTIVE,
            'type'                  => User::TYPE_SUBSCRIBER,
            'remember_token'        => Str::random(10),
        ]);

        UserDetail::create([
            'user_id'           => $subscriber->id,
            'address'           => $faker->address(),
            'city'              => $faker->city(),
            'state'             => $faker->state(),
            'country'           => $faker->country(),
            'zip_code'          => $faker->postcode(),
            'about'             => $faker->paragraph(),
            'dob'               => $faker->date(),

            'facebook'      => $faker->url(),
            'twitter'       => $faker->url(),
            'linkedin'      => $faker->url(),
            'instagram'     => $faker->url(),
            'youtube'       => $faker->url(),
            'website'       => $faker->url(),
//            'created_by'    => 1,
//            'updated_by'    => 1,
        ]);


        User::factory(10)->create([
            'type' => User::TYPE_SUBSCRIBER,
        ])->each(function ($user) {
            UserDetail::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}

