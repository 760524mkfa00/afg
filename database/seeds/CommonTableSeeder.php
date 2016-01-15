<?php

use Illuminate\Database\Seeder;

class CommonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category' => 'Disabled Access'],
            ['category' => 'Electrical Upgrade'],
            ['category' => 'Facility Upgrade'],
            ['category' => 'Functional Improvement'],
            ['category' => 'Health & Safety Upgrade'],
            ['category' => 'Loss Prevention'],
            ['category' => 'Mechanical Upgrade'],
            ['category' => 'Roof Replacement'],
            ['category' => 'Site Upgrade'],
            ['category' => 'Tech. Infrastructure']
        ]);

        DB::table('regions')->insert([
            ['region' => 'Admin'],
            ['region' => 'Kelowna'],
            ['region' => 'Lake Country'],
            ['region' => 'Mission'],
            ['region' => 'Rutland'],
            ['region' => 'West Kelowna']
        ]);

        DB::table('locations')->insert([
            ['location' => 'Admin'],
            ['location' => 'A.S. Matheson Elementary'],
            ['location' => 'Anne McClymont Elementary'],
            ['location' => 'Anne McClymont Primary'],
            ['location' => 'Bankhead Elementary'],
            ['location' => 'Belgo Elementary'],
            ['location' => 'Black Mountain Elementary'],
            ['location' => 'Casorso Elementary'],
            ['location' => 'Central School'],
            ['location' => 'Chief Tomat Elementary'],
            ['location' => 'Chute Lake Elementary'],
            ['location' => 'Constable Neil Bruce Middle'],
            ['location' => 'Davidson Road Elementary'],
            ['location' => 'Dease Road Site'],
            ['location' => 'Dehart Student Support Services'],
            ['location' => 'Dorothea Walker Elementary'],
            ['location' => 'Dr Knox Middle'],
            ['location' => 'Ellison Elementary'],
            ['location' => 'George Elliot Secondary'],
            ['location' => 'George Pringle Elementary'],
            ['location' => 'Glenmore Elementary'],
            ['location' => 'Glenrosa Elementary'],
            ['location' => 'Glenrosa Middle'],
            ['location' => 'Helen Gorman Elementary'],
            ['location' => 'Hudson Road Elementary'],
            ['location' => 'K.L.O. Middle'],
            ['location' => 'Kelowna Secondary'],
            ['location' => 'MarJok Elementary'],
            ['location' => 'Mount Boucherie Secondary'],
            ['location' => 'North Glenmore Elementary'],
            ['location' => 'Okanagan Mission Secondary'],
            ['location' => 'Oyama Traditional'],
            ['location' => 'Peachland Elementary'],
            ['location' => 'Pearson Road Elementary'],
            ['location' => 'Peter Greer Elementary'],
            ['location' => 'Quigley Elementary'],
            ['location' => 'Raymer Elementary'],
            ['location' => 'Rose Valley Elementary'],
            ['location' => 'Rutland Elementary'],
            ['location' => 'Rutland Middle'],
            ['location' => 'Rutland Senior Secondary'],
            ['location' => 'Shannon Lake Elementary'],
            ['location' => 'South Kelowna Elementary'],
            ['location' => 'South Rutland Elementary'],
            ['location' => 'Springvalley Elementary'],
            ['location' => 'Springvalley Middle'],
            ['location' => 'Watson Road Elementary']
        ]);

        DB::table('clients')->insert([
            ['client' => 'Consultant'],
            ['client' => 'Custodial Manager'],
            ['client' => 'Director of Instruction'],
            ['client' => 'Director of SSS'],
            ['client' => 'DLC'],
            ['client' => 'Energy Manager'],
            ['client' => 'IAO'],
            ['client' => 'Learning Tech'],
            ['client' => 'Maintenance Manager'],
            ['client' => 'MPDA'],
            ['client' => 'Principal'],
            ['client' => 'Project Manager'],
            ['client' => 'RJC Consulting'],
            ['client' => 'SNAC']
        ]);

        DB::table('priorities')->insert([
            ['priority' => 'Immediate'],
            ['priority' => 'Short Term'],
            ['priority' => 'Long Term']
        ]);

        DB::table('users')->insert([
            'name' => 'Kieran Fahy',
            'email' => 'kieran.fahy@sd23.bc.ca',
            'password' => bcrypt('password')
        ]);
    }
}
