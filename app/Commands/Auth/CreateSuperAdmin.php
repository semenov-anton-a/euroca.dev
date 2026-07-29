<?php

declare(strict_types=1);

namespace App\Commands\Auth;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CreateSuperAdmin extends BaseCommand
{
    protected $group = 'Auth';

    protected $name = 'auth:create-superadmin';

    protected $description = 'Create the first Super Admin with full permissions.';

    public function run(array $params)
    {
        $db = db_connect();

        CLI::write('Create Super Admin', 'yellow');
        CLI::write('==================');
        CLI::newLine();

        /*
        |--------------------------------------------------------------------------
        | Check if Super Admin role already exists
        |--------------------------------------------------------------------------
        */

        $superAdminRole = $db
            ->table('roles')
            ->where('name', 'super_admin')
            ->get()
            ->getRowArray();

        if ($superAdminRole !== null) 
        {
            CLI::error('Super Admin role already exists.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Input user data
        |--------------------------------------------------------------------------
        */

        $email      = trim( CLI::prompt('Email') );
        $username   = trim( CLI::prompt('Username'));
        $firstName  = trim( CLI::prompt('First name'));
        $lastName   = trim( CLI::prompt('Last name') );

        /*
        |--------------------------------------------------------------------------
        | Validate required fields
        |--------------------------------------------------------------------------
        */

        if (
            $email === ''
            || $username === ''
            || $firstName === ''
            || $lastName === ''
        ) {
            CLI::error( 'All user fields are required.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

        $password = CLI::prompt('Password');

        $passwordConfirm = CLI::prompt('Confirm password');

        if ($password !== $passwordConfirm) 
        {
            CLI::error( 'Passwords do not match.');
            return;
        }

        if (strlen($password) < 8) 
        {
            CLI::error( 'Password must be at least 8 characters.' );
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Check email
        |--------------------------------------------------------------------------
        */

        $emailExists = $db
            ->table('users')
            ->where('email', $email)
            ->countAllResults();

        if ($emailExists > 0) 
        {
            CLI::error( 'User with this email already exists.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Check username
        |--------------------------------------------------------------------------
        */

        $usernameExists = $db
            ->table('users')
            ->where('username', $username)
            ->countAllResults();

        if ($usernameExists > 0) 
        {
            CLI::error( 'User with this username already exists.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Get all permissions
        |--------------------------------------------------------------------------
        */

        $permissions = $db
            ->table('permissions')
            ->select('id')
            ->get()
            ->getResultArray();

        if (empty($permissions)) 
        {
            CLI::error( 'No permissions found in database.');
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Hash password
        |--------------------------------------------------------------------------
        */

        $passwordHash = password_hash( $password, PASSWORD_DEFAULT );

        if ($passwordHash === false) 
        {
            CLI::error( 'Unable to hash password.' );
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Start transaction
        |--------------------------------------------------------------------------
        */

        $db->transBegin();

        try {

            /*
            |--------------------------------------------------------------------------
            | 1. Create Super Admin role
            |--------------------------------------------------------------------------
            */

            $roleInserted = $db
                ->table('roles')
                ->insert([
                    'name' => 'super_admin',
                    'description' =>
                    'Full access to the entire system.',
                ]);

            if (!$roleInserted) {
                throw new \RuntimeException(
                    'Failed to create Super Admin role.'
                );
            }

            $roleId = (int) $db->insertID();

            /*
            |--------------------------------------------------------------------------
            | 2. Assign all permissions
            |--------------------------------------------------------------------------
            */

            foreach ($permissions as $permission) {

                $permissionInserted = $db
                    ->table('role_permissions')
                    ->insert([
                        'role_id' =>
                        $roleId,

                        'permission_id' =>
                        $permission['id'],
                    ]);

                if (!$permissionInserted) {
                    throw new \RuntimeException(
                        'Failed to assign permission ID: '
                            . $permission['id']
                    );
                }
            }

            /*
            |--------------------------------------------------------------------------
            | 3. Create Super Admin user
            |--------------------------------------------------------------------------
            */

            $userInserted = $db
                ->table('users')
                ->insert([
                    'email' =>
                    $email,

                    'username' =>
                    $username,

                    'first_name' =>
                    $firstName,

                    'last_name' =>
                    $lastName,

                    'password_hash' =>
                    $passwordHash,

                    'status' =>
                    'active',
                ]);

            if (!$userInserted) {
                throw new \RuntimeException(
                    'Failed to create Super Admin user.'
                );
            }

            $userId = (int) $db->insertID();

            /*
            |--------------------------------------------------------------------------
            | 4. Assign Super Admin role to user
            |--------------------------------------------------------------------------
            */

            $userRoleInserted = $db
                ->table('roles_users')
                ->insert([
                    'user_id' => $userId,
                    'role_id' => $roleId,
                ]);

            if (!$userRoleInserted) {
                throw new \RuntimeException(
                    'Failed to assign Super Admin role to user.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Commit transaction
            |--------------------------------------------------------------------------
            */

            if ($db->transStatus() === false) {
                throw new \RuntimeException(
                    'Database transaction failed.'
                );
            }

            $db->transCommit();
        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Rollback transaction
            |--------------------------------------------------------------------------
            */

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
        CLI::write( 'Super Admin created successfully!', 'green' );

        CLI::newLine();
        CLI::write('User ID: ' . $userId, 'green');
        CLI::write( 'Username: ' . $username, 'green');
        CLI::write('Email: ' . $email );
        CLI::write('Role: super_admin');
        CLI::write('Permissions: ' . count($permissions));

        CLI::newLine();
        CLI::write( 'You can now login to the application.','green');
    }
}
