<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si ya existe un usuario con este email
        $existingUser = User::where('email', 'admin@colmipram.com')->first();
        
        if (!$existingUser) {
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@colmipram.com',
                'password' => Hash::make('admin123'),
            ]);
            
            $this->command->info('Usuario administrador creado exitosamente!');
            $this->command->info('Email: admin@colmipram.com');
            $this->command->info('Contraseña: admin123');
        } else {
            $this->command->warn('El usuario administrador ya existe.');
        }
    }
}

