<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use App\Models\User; 
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Transportation;
use App\Models\TravelPackages;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $adminRole = Role::where('slug', 'admin')->firstOrFail();
        $staffRole = Role::where('slug', 'staff')->firstOrFail();
        $customerRole = Role::where('slug', 'customer')->firstOrFail();

        User::create([ 
            'name' => 'Administrator', 
            'email' => 'admin@gmail.com',  
            'role_id' => $adminRole?->id,
            'hp' => '0812345678901', 
            'password' => bcrypt('P@55word'), 
        ]); 

        User::create([ 
            'name' => 'Sopian Aji', 
            'email' => 'sopian4ji@gmail.com',  
            'role_id' => $staffRole?->id,
            'hp' => '081234567892', 
            'password' => bcrypt('P@55word'), 
        ]); 
        
        User::create([ 
            'name' => 'Karina Adya', 
            'email' => 'adyarin@gmail.com',   
            'role_id' => $adminRole?->id,
            'hp' => '085678916598', 
            'password' => bcrypt('K@rin4'), 
        ]); 

        User::create([ 
            'name' => 'Aditya Rayhan Pratama', 
            'email' => 'pratamayhan@gmail.com',   
            'role_id' => $customerRole?->id,
            'hp' => '089873456120', 
            'password' => bcrypt('Rayh4ntam@'), 
        ]); 

        User::create([ 
            'name' => 'Naufal Aksa Pranaya', 
            'email' => 'aksanaya@gmail.com',  
            'role_id' => $customerRole?->id,
            'hp' => '087856432690', 
            'password' => bcrypt('Pranayaksa5^'), 
        ]); 

        User::create([ 
            'name' => 'Kim Leehan', 
            'email' => 'leehan@gmail.com',  
            'role_id' => $customerRole?->id,
            'hp' => '081234567891', 
            'password' => bcrypt('Leehan123^'), 
        ]); 

        User::create([ 
            'name' => 'Han Taesan', 
            'email' => 'taesanie@gmail.com',  
            'role_id' => $customerRole?->id,
            'hp' => '08546281923', 
            'password' => bcrypt('Taesan123^'), 
        ]); 

        
    }
}
