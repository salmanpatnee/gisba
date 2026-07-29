<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {--name= : Display name} {--email= : Login email}';

    protected $description = 'Create an admin account — public registration is disabled';

    public function handle(): int
    {
        $name = $this->option('name') ?: text('Name', required: true);
        $email = $this->option('email') ?: text('Email', required: true);
        $plainPassword = password('Password', required: true);

        try {
            validator(
                ['name' => $name, 'email' => $email, 'password' => $plainPassword],
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                    'password' => ['required', Password::defaults()],
                ]
            )->validate();
        } catch (ValidationException $e) {
            foreach ($e->errors() as $messages) {
                foreach ($messages as $message) {
                    $this->error($message);
                }
            }

            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($plainPassword),
            'email_verified_at' => now(),
        ]);

        $this->info("Admin account created for {$email}.");

        return self::SUCCESS;
    }
}
