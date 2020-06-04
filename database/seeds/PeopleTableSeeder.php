<?php

use App\Imports\PersonImporter;
use App\Models\DonationLinks;
use App\Models\Person;
use App\Models\PetitionLinks;
use App\Models\SocialMedia;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class PeopleTableSeeder extends Seeder
{
    public function run()
    {
        Excel::import(new PersonImporter(), storage_path('data/saytheirnames.csv'));
        $people = Person::all();
        foreach ($people as $person) {
            factory(PetitionLinks::class)->create([
                'person_id' => $person->id,
            ]);
            factory(DonationLinks::class)->create([
                'person_id' => $person->id,
            ]);
            factory(SocialMedia::class)->create([
                'person_id' => $person->id,
            ]);
        }
    }
}
