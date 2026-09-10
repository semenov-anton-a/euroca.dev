/**
    login nivoices cmr

**/


CREATE DATABASE IF NOT EXISTS eurocargodb
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE eurocargodb;

-- =========================================================
-- PARTIES
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
-- =========================================================

CREATE TABLE employees (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    birthday DATE NULL,
    email VARCHAR(255) NULL,
    phone VARCHAR(100) NULL,
    position VARCHAR(150) NULL,
    hire_date DATE NULL,
    termination_date DATE NULL,
    status ENUM('active','inactive','terminated') NOT NULL DEFAULT 'active',
    note TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    deleted_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- ROLES / PERMISSIONS
-- =========================================================

CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE permissions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    module VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    UNIQUE KEY uq_permissions_module_name (module, name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- One user belongs either to an employee or to a customer.
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


-- =========================================================
-- CMR
-- One CMR represents one transportation stage.
-- =========================================================

CREATE TABLE cmrs (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    cmr_number VARCHAR(50) NOT NULL UNIQUE,
    reference_number VARCHAR(100) NULL,

    shipper_party_id BIGINT UNSIGNED NOT NULL,
    consignee_party_id BIGINT UNSIGNED NOT NULL,
    carrier_party_id BIGINT UNSIGNED NULL,

    loading_date DATE NULL,
    delivery_date DATE NULL,

    loading_place VARCHAR(255) NULL,
    delivery_place VARCHAR(255) NULL,

    vehicle_number VARCHAR(50) NULL,
    trailer_number VARCHAR(50) NULL,

    status ENUM(
        'draft',
        'confirmed',
        'completed',
        'cancelled'
    ) NOT NULL DEFAULT 'draft',

    note TEXT NULL,

    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    deleted_at DATETIME NULL,

    CONSTRAINT fk_cmrs_shipper
        FOREIGN KEY (shipper_party_id) REFERENCES parties(id)
        ON DELETE RESTRICT,

    CONSTRAINT fk_cmrs_consignee
        FOREIGN KEY (consignee_party_id) REFERENCES parties(id)
        ON DELETE RESTRICT,

    CONSTRAINT fk_cmrs_carrier
        FOREIGN KEY (carrier_party_id) REFERENCES parties(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- CARGO
-- Physical cargo existing independently from CMR.
-- =========================================================

CREATE TABLE cargo (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    cargo_number VARCHAR(50) NOT NULL UNIQUE,
    customer_id BIGINT UNSIGNED NULL,

    description TEXT NOT NULL,

    quantity DECIMAL(12,3) NOT NULL DEFAULT 1,
    weight_kg DECIMAL(12,3) NULL,
    volume_m3 DECIMAL(12,3) NULL,

    length_m DECIMAL(10,3) NULL,
    width_m DECIMAL(10,3) NULL,
    height_m DECIMAL(10,3) NULL,

    stackable BOOLEAN NOT NULL DEFAULT FALSE,

    status ENUM(
        'planned',
        'received',
        'stored',
        'shipped',
        'delivered',
        'cancelled'
    ) NOT NULL DEFAULT 'planned',

    note TEXT NULL,

    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    deleted_at DATETIME NULL,

    CONSTRAINT fk_cargo_customer
        FOREIGN KEY (customer_id) REFERENCES customers(id)
        ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- CMR <-> CARGO
-- Many-to-many.
-- One CMR can contain many cargo.
-- One cargo can appear in several CMR during transportation.
-- =========================================================

CREATE TABLE cmr_cargo (
    cmr_id BIGINT UNSIGNED NOT NULL,
    cargo_id BIGINT UNSIGNED NOT NULL,

    PRIMARY KEY (cmr_id, cargo_id),

    CONSTRAINT fk_cmr_cargo_cmr
        FOREIGN KEY (cmr_id) REFERENCES cmrs(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_cmr_cargo_cargo
        FOREIGN KEY (cargo_id) REFERENCES cargo(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- CMR ITEMS
-- Data printed/described on the CMR.
-- =========================================================

CREATE TABLE cmr_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    cmr_id BIGINT UNSIGNED NOT NULL,

    description TEXT NOT NULL,
    quantity DECIMAL(12,3) NOT NULL DEFAULT 1,

    package_type VARCHAR(100) NULL,

    weight_kg DECIMAL(12,3) NULL,
    volume_m3 DECIMAL(12,3) NULL,

    length_m DECIMAL(10,3) NULL,
    width_m DECIMAL(10,3) NULL,
    height_m DECIMAL(10,3) NULL,

    stackable BOOLEAN NOT NULL DEFAULT FALSE,

    note TEXT NULL,

    created_at DATETIME NULL,
    updated_at DATETIME NULL,

    CONSTRAINT fk_cmr_items_cmr
        FOREIGN KEY (cmr_id) REFERENCES cmrs(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- INVOICES
-- Customer sales invoices.
-- =========================================================

CREATE TABLE invoices (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    invoice_number VARCHAR(50) NOT NULL UNIQUE,
    reference_number VARCHAR(100) NULL,

    customer_id BIGINT UNSIGNED NOT NULL,

    invoice_date DATE NOT NULL,
    due_date DATE NULL,

    currency CHAR(3) NOT NULL DEFAULT 'EUR',

    subtotal DECIMAL(14,2) NOT NULL DEFAULT 0.00,
    vat_amount DECIMAL(14,2) NOT NULL DEFAULT 0.00,
    total_amount DECIMAL(14,2) NOT NULL DEFAULT 0.00,

    status ENUM(
        'draft',
        'issued',
        'paid',
        'partially_paid',
        'overdue',
        'cancelled'
    ) NOT NULL DEFAULT 'draft',

    note TEXT NULL,

    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    deleted_at DATETIME NULL,

    CONSTRAINT fk_invoices_customer
        FOREIGN KEY (customer_id) REFERENCES customers(id)
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- INVOICE ITEMS
-- =========================================================

CREATE TABLE invoice_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    invoice_id BIGINT UNSIGNED NOT NULL,

    description TEXT NOT NULL,

    quantity DECIMAL(12,3) NOT NULL DEFAULT 1,
    unit VARCHAR(50) NULL,

    unit_price DECIMAL(14,4) NOT NULL DEFAULT 0.0000,

    vat_rate DECIMAL(5,2) NOT NULL DEFAULT 0.00,

    net_amount DECIMAL(14,2) NOT NULL DEFAULT 0.00,
    vat_amount DECIMAL(14,2) NOT NULL DEFAULT 0.00,
    total_amount DECIMAL(14,2) NOT NULL DEFAULT 0.00,

    created_at DATETIME NULL,
    updated_at DATETIME NULL,

    CONSTRAINT fk_invoice_items_invoice
        FOREIGN KEY (invoice_id) REFERENCES invoices(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- INVOICE <-> CARGO
-- =========================================================

CREATE TABLE invoice_cargo (
    invoice_id BIGINT UNSIGNED NOT NULL,
    cargo_id BIGINT UNSIGNED NOT NULL,

    PRIMARY KEY (invoice_id, cargo_id),

    CONSTRAINT fk_invoice_cargo_invoice
        FOREIGN KEY (invoice_id) REFERENCES invoices(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_invoice_cargo_cargo
        FOREIGN KEY (cargo_id) REFERENCES cargo(id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;