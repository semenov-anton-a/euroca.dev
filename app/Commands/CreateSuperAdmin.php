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
    protected $description = 'Create the first Super Admin employee with full permissions.';

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
            ->where('key', UserRole::SuperAdmin->value)
            ->get()
            ->getRowArray();

        if ($role === null) {
            CLI::error('Super Admin role does not exist.');
            return;
        }

        $roleId = (int) $role['id'];

        /*
        |--------------------------------------------------------------------------
        | Employee data
        |--------------------------------------------------------------------------
        */

        $email = trim(CLI::prompt('Email'));
        $username = trim(CLI::prompt('Username'));
        $firstName = trim(CLI::prompt('First name'));
        $lastName = trim(CLI::prompt('Last name'));

        if ($email === '' || $username === '' || $firstName === '' || $lastName === '') {
            CLI::error('All fields are required.');
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
        | Check existing username
        |--------------------------------------------------------------------------
        */

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
        | Create employee + user
        |--------------------------------------------------------------------------
        */

        $db->transBegin();

        try {
            /*
            |----------------------------------------------------------------------
            | Create employee
            |----------------------------------------------------------------------
            */

            $inserted = $db->table('employees')->insert([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'status' => 'active',
            ]);

            if (!$inserted) {
                throw new \RuntimeException('Failed to create employee.');
            }

            $employeeId = (int) $db->insertID();

            /*
            |----------------------------------------------------------------------
            | Create user
            |----------------------------------------------------------------------
            */

            $inserted = $db->table('users')->insert([
                'employee_id' => $employeeId,
                'customer_id' => null,
                'username' => $username,
                'password_hash' => $passwordHash,
                'role_id' => $roleId,
                'status' => 'active',
                'password_changed_at' => date('Y-m-d H:i:s'),
            ]);

            if (!$inserted) {
                throw new \RuntimeException('Failed to create user.');
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

        CLI::write('Employee ID: ' . $employeeId, 'green');
        CLI::write('User ID: ' . $userId, 'green');
        CLI::write('Username: ' . $username, 'green');
        CLI::write('Email: ' . $email);
        CLI::write('Name: ' . $firstName . ' ' . $lastName);
        CLI::write('Role: ' . $role['name']);
        CLI::write('Status: active');

        CLI::newLine();

        CLI::write('You can now login to the application.', 'green');
    }
}