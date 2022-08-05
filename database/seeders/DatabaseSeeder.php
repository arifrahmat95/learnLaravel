<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com'
        ]);

        Listing::factory(5)->create([
            'user_id' => $user->id
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Listing::create([
        //     'title' => 'laravel developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'kestrl',
        //     'location' => 'bbu, jb',
        //     'email' => 'email@email.com',
        //     'website' => 'https://www.kestrl.io',
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tempus tellus at eros feugiat molestie. Fusce luctus purus sit amet dolor maximus, in congue risus viverra. Sed dapibus bibendum quam, ut interdum sem auctor eget. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce vel hendrerit dolor, ut semper nisi. Quisque at erat lobortis lorem suscipit pellentesque. Morbi id finibus mauris, vel semper leo. Proin rhoncus ante sapien, ut sollicitudin sapien egestas ut. Etiam placerat mi tellus, vel lobortis enim auctor sed. Maecenas vestibulum malesuada laoreet. Mauris luctus dignissim viverra.'
        // ]);

        // Listing::create([
        //     'title' => 'full-stack developer',
        //     'tags' => 'laravel, backend. api',
        //     'company' => 'kestrl',
        //     'location' => 'bbu, jb',
        //     'email' => 'email@email.com',
        //     'website' => 'https://www.kestrl.io',
        //     'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tempus tellus at eros feugiat molestie. Fusce luctus purus sit amet dolor maximus, in congue risus viverra. Sed dapibus bibendum quam, ut interdum sem auctor eget. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce vel hendrerit dolor, ut semper nisi. Quisque at erat lobortis lorem suscipit pellentesque. Morbi id finibus mauris, vel semper leo. Proin rhoncus ante sapien, ut sollicitudin sapien egestas ut. Etiam placerat mi tellus, vel lobortis enim auctor sed. Maecenas vestibulum malesuada laoreet. Mauris luctus dignissim viverra.'
        // ]);
    }
}
