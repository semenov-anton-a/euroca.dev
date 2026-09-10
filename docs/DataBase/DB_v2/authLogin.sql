CREATE DATABASE IF NOT EXISTS eurocargodb
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE eurocargodb;

-- =========================================================
-- PARTIES
-- Any external person/company used in the system.
-- =========================================================

CREATE TABLE parties (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type ENUM('company','person') NOT NULL,
    status ENUM('active','inactive') NOT NULL DEFAULT 'active',
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    deleted_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE companies (
    party_id BIGINT UNSIGNED PRIMARY KEY,
    legal_name VARCHAR(255) NOT NULL,
    business_id VARCHAR(100) NULL,
    vat_number VARCHAR(100) NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(100) NULL,
    website VARCHAR(255) NULL,
    address VARCHAR(255) NULL,
    postal_code VARCHAR(30) NULL,
    city VARCHAR(100) NULL,
    country_code CHAR(2) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,

    CONSTRAINT fk_companies_party
        FOREIGN KEY (party_id) REFERENCES parties(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE persons (
    party_id BIGINT UNSIGNED PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    birthday DATE NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(100) NULL,
    address VARCHAR(255) NULL,
    postal_code VARCHAR(30) NULL,
    city VARCHAR(100) NULL,
    country_code CHAR(2) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,

    CONSTRAINT fk_persons_party
        FOREIGN KEY (party_id) REFERENCES parties(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================
-- CUSTOMERS
-- A customer is a party with customer status.
-- =========================================================

CREATE TABLE customers (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    party_id BIGINT UNSIGNED NOT NULL UNIQUE,
    customer_number VARCHAR(50) NOT NULL UNIQUE,
    status ENUM('active','inactive') NOT NULL DEFAULT 'active',
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    deleted_at DATETIME NULL,

    CONSTRAINT fk_customers_party
        FOREIGN KEY (party_id) REFERENCES parties(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================
-- EMPLOYEES
-- EuroCargo employees.
-- =========================================================

CREATE TABLE employees (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    birthday DATE NOT NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(100) NULL,
    position VARCHAR(150) NULL,
    status ENUM('active','inactive','terminated') NOT NULL DEFAULT 'active',
    note TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    deleted_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================
-- ROLES
-- =========================================================

CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================
-- PERMISSIONS
-- =========================================================

CREATE TABLE permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    module VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,

    UNIQUE KEY uq_permissions_module_name (module, name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================
-- ROLE <-> PERMISSIONS
-- =========================================================

CREATE TABLE role_permissions (
    role_id BIGINT UNSIGNED NOT NULL,
    permission_id BIGINT UNSIGNED NOT NULL,

    PRIMARY KEY (role_id, permission_id),

    CONSTRAINT fk_role_permissions_role
        FOREIGN KEY (role_id) REFERENCES roles(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_role_permissions_permission
        FOREIGN KEY (permission_id) REFERENCES permissions(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =========================================================
-- USERS
-- One account belongs either to an employee or a customer.
-- =========================================================

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    employee_id BIGINT UNSIGNED NULL,
    customer_id BIGINT UNSIGNED NULL,

    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,

    role_id BIGINT UNSIGNED NOT NULL,

    status ENUM('active','inactive','banned') NOT NULL DEFAULT 'active',

    failed_login_count INT UNSIGNED NOT NULL DEFAULT 0,
    locked_until DATETIME NULL,

    last_login_at DATETIME NULL,
    last_login_ip VARCHAR(45) NULL,
    password_changed_at DATETIME NULL,

    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    deleted_at DATETIME NULL,

    UNIQUE KEY uq_users_employee (employee_id),
    UNIQUE KEY uq_users_customer (customer_id),

    CONSTRAINT fk_users_employee
        FOREIGN KEY (employee_id) REFERENCES employees(id)
        ON DELETE RESTRICT,

    CONSTRAINT fk_users_customer
        FOREIGN KEY (customer_id) REFERENCES customers(id)
        ON DELETE RESTRICT,

    CONSTRAINT fk_users_role
        FOREIGN KEY (role_id) REFERENCES roles(id)
        ON DELETE RESTRICT,

    CONSTRAINT chk_users_owner
        CHECK (
            (employee_id IS NOT NULL AND customer_id IS NULL)
            OR
            (employee_id IS NULL AND customer_id IS NOT NULL)
        )
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;