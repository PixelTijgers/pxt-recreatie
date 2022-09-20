<?php

// Namespacing.
namespace Database\Seeders;

// Facades.
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models.
use App\Models\Administrator;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrators = [
            [
                'name' => 'Michiel Elshout',
                'email' => 'info@pixeltijgers.nl',
                'phone' => '+31 (0)6 23 38 47 06',
                'password' => \Hash::make('PXTmichiel2019!'),
            ],
            [
                'name' => 'Jens van Dam',
                'email' => 'jensvandam@hotmail.com',
                'phone' => '+31 (0)6 54 34 26 47',
                'password' => \Hash::make('JensW8woord'),
            ],
            [
                'name' => 'Matthijs Bijlsma',
                'email' => 'bijls@hotmail.com',
                'phone' => '+31 (0)6 15 95 26 26',
                'password' => \Hash::make('BijlsW8woord'),
            ],
        ];

        foreach($administrators as $administrator) {
            $crAdministrator = Administrator::create($administrator);

            // Add avatar to database.
            $crAdministrator->addMediaFromBase64(\Avatar::create($crAdministrator['name'])->toBase64())
                ->toMediaCollection('avatar');
        }
    }
}
