<?php

declare(strict_types=1);

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Modules\Auth\Enums\UserRole;

class CreateSuperAdmin extends BaseCommand
{
    protected $group = '_My Commands';
    protected $name = 'my:create-superadmin';
    protected $description = 'Create the first Super Admin with full permissions.';

    public function run(array $params)
    {
        $db = db_connect();

        CLI::write('Create Super Admin', 'yellow');
        CLI::write('==================');
        CLI::newLine();

        /*
        |--------------------------------------------------------------------------
        | Find Super Admin role
        |--------------------------------------------------------------------------
        */

        $role = $db->table('roles')
            ->where('name', UserRole::SuperAdmin->value)
            ->get()
            ->getRowArray();
        
        if ($role === null) {
            CLI::error('Super Admin role does not exist.');
            return;
        }

        if ((int) $role['system_access'] !== 1) {
            CLI::error('Super Admin role does not have system access.');
            return;
        }

        $roleId = (int) $role['id'];

        /*
        |--------------------------------------------------------------------------
        | User data
        |--------------------------------------------------------------------------
        */

        $email = trim(CLI::prompt('Email'));
        $username = trim(CLI::prompt('Username'));
        $firstName = trim(CLI::prompt('First name'));
        $lastName = trim(CLI::prompt('Last name'));

        if ($email === '' || $username === '' || $firstName === '' || $lastName === '') {
            CLI::error('All user fields are required.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

        $password = CLI::prompt('Password');
        $passwordConfirm = CLI::prompt('Confirm password');

        if ($password === '' || $passwordConfirm === '') {
            CLI::error('Password is required.');
            return;
        }

        if ($password !== $passwordConfirm) {
            CLI::error('Passwords do not match.');
            return;
        }

        if (strlen($password) < 8) {
            CLI::error('Password must be at least 8 characters.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Check existing user
        |--------------------------------------------------------------------------
        */

        if ($db->table('users')->where('email', $email)->countAllResults() > 0) {
            CLI::error('User with this email already exists.');
            return;
        }

        if ($db->table('users')->where('username', $username)->countAllResults() > 0) {
            CLI::error('User with this username already exists.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Password hash
        |--------------------------------------------------------------------------
        */

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if ($passwordHash === false) {
            CLI::error('Unable to hash password.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Create user
        |--------------------------------------------------------------------------
        */

        $db->transBegin();

        try {
            $inserted = $db->table('users')->insert([
                'role_id' => $roleId,
                'email' => $email,
                'username' => $username,
                'password_hash' => $passwordHash,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'status' => 'active',
            ]);

            if (!$inserted) {
                throw new \RuntimeException('Failed to create Super Admin user.');
            }

            $userId = (int) $db->insertID();

            if ($db->transStatus() === false) {
                throw new \RuntimeException('Database transaction failed.');
            }

            $db->transCommit();

        } catch (\Throwable $e) {
            $db->transRollback();

            CLI::error('Failed to create Super Admin.');
            CLI::error($e->getMessage());

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        CLI::newLine();

        CLI::write('Super Admin created successfully!', 'green');
        CLI::newLine();

        CLI::write('User ID: ' . $userId, 'green');
        CLI::write('Username: ' . $username, 'green');
        CLI::write('Email: ' . $email);
        CLI::write('Role: ' . $role['name']);
        CLI::write('Status: active');

        CLI::newLine();

        CLI::write('You can now login to the application.', 'green');
    }
}