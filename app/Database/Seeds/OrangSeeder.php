<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class OrangSeeder extends Seeder
{
        public function run()
        {
                $faker = \Faker\Factory::create('id_ID');
                // $data = [
                //         'nama'          => 'Luthfi Nurul Huda',
                //         'alamat'        => 'Jln. Zaini Munim, Karang Anyar Paiton',
                //         'created_at'    => Time::now(),
                //         'updated_at'    => Time::now()
                // ];
                for($i = 0; $i < 100; $i++){
                        $data = [
                                'nama'          => $faker->name,
                                'alamat'        => $faker->address,
                                'created_at'    => Time::createFromTimestamp($faker->unixTime()),
                                'updated_at'    => Time::now()
                        ];
                        $this->db->table('tb_orang')->insert($data);
                }       
               
                // Simple Queries
                // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)", $data);

                // Using Query Builder
             
        }
}