<?php

namespace Vendor\ContactForm\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Vendor\ContactForm\Models\ContactSubmission;

class ContactFormSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => Hash::make('password'), 'is_admin' => true]
        );

        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'Test User', 'password' => Hash::make('password'), 'is_admin' => false]
        );

        ContactSubmission::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'subject' => 'Test Subject',
            'message' => 'This is a test message.',
        ]);

        ContactSubmission::create([
            'user_id' => $admin->id,
            'name' => $admin->name,
            'email' => $admin->email,
            'subject' => 'Admin Inquiry',
            'message' => 'Hello from admin.',
        ]);
    }
}
