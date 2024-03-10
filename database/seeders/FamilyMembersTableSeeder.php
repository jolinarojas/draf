<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FamilyMember;

class FamilyMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define initial data
        $familyMembers = [
            ['household_id' => 4, 'name' => 'John Doe', 'age' => 30, 'sex' => 'Male', 'occupation' => 'Engineer', 'POF' => 'Son', 'status' => 'Married', 'remarks' => ''],
             ['household_id' => 4, 'name' => 'John Wick', 'age' => 30, 'sex' => 'Male', 'occupation' => 'Engineer', 'POF' => 'Father', 'status' => 'Married', 'remarks' => ''],
            // Add more family members as needed
        ];

        // Insert data into the family_members table
        foreach ($familyMembers as $member) {
            FamilyMember::create($member);
        }
    }
}
