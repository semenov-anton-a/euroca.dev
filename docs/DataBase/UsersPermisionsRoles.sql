-- ============================================================
-- AUTH / USERS DATABASE
-- Final schema
-- User -> one Role -> Permissions
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `role_permissions`;
DROP TABLE IF EXISTS `permissions`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `roles`;

SET FOREIGN_KEY_CHECKS = 1;


-- ============================================================
-- ROLES
-- ============================================================

CREATE TABLE `roles` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255) DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_roles_name` (`name`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- PERMISSIONS
-- ============================================================

CREATE TABLE `permissions` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(255) DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),
    UNIQUE KEY `uk_permissions_name` (`name`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- USERS
-- ============================================================

CREATE TABLE `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `role_id` INT UNSIGNED NOT NULL,

    `email` VARCHAR(191) NOT NULL,
    `username` VARCHAR(100) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,

    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(50) DEFAULT NULL,

    `status` VARCHAR(20) NOT NULL DEFAULT 'active',

    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` DATETIME DEFAULT NULL,

    PRIMARY KEY (`id`),

    UNIQUE KEY `uk_users_email` (`email`),
    UNIQUE KEY `uk_users_username` (`username`),

    KEY `idx_users_role_id` (`role_id`),
    KEY `idx_users_status` (`status`),
    KEY `idx_users_deleted_at` (`deleted_at`),

    CONSTRAINT `fk_users_role`
        FOREIGN KEY (`role_id`)
        REFERENCES `roles` (`id`)
        ON UPDATE CASCADE
        ON DELETE RESTRICT

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- ROLE PERMISSIONS
-- ============================================================

CREATE TABLE `role_permissions` (
    `role_id` INT UNSIGNED NOT NULL,
    `permission_id` INT UNSIGNED NOT NULL,

    PRIMARY KEY (`role_id`, `permission_id`),

    KEY `idx_role_permissions_permission_id` (`permission_id`),

    CONSTRAINT `fk_role_permissions_role`
        FOREIGN KEY (`role_id`)
        REFERENCES `roles` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

    CONSTRAINT `fk_role_permissions_permission`
        FOREIGN KEY (`permission_id`)
        REFERENCES `permissions` (`id`)
        ON UPDATE CASCADE
        ON DELETE CASCADE

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- ROLES
-- ============================================================

-- INSERT INTO `roles` (`name`, `description`) VALUES
-- ('super_admin', 'Full access to the entire system.'),
-- ('admin', 'Administrative access to the system.'),
-- ('employee', 'Employee access to assigned system functions.'),
-- ('client', 'Client access to own cargo and related documents.');


-- ============================================================
-- PERMISSIONS
-- ============================================================

-- INSERT INTO `permissions` (`name`, `description`) VALUES

-- -- Customers
-- ('customers.view',   'View customers.'),
-- ('customers.create', 'Create customers.'),
-- ('customers.edit',   'Edit customers.'),
-- ('customers.delete', 'Delete customers.'),

-- -- Cargo
-- ('cargo.view',       'View cargo.'),
-- ('cargo.create',     'Create cargo.'),
-- ('cargo.edit',       'Edit cargo.'),
-- ('cargo.delete',     'Delete cargo.'),

-- -- Invoices
-- ('invoices.view',    'View invoices.'),
-- ('invoices.create',  'Create invoices.'),
-- ('invoices.edit',    'Edit invoices.'),
-- ('invoices.delete',  'Delete invoices.'),

-- -- Accounting
-- ('accounting.view',   'View accounting.'),
-- ('accounting.create', 'Create accounting records.'),
-- ('accounting.edit',   'Edit accounting records.'),
-- ('accounting.delete', 'Delete accounting records.'),

-- -- Users
-- ('users.view',       'View users.'),
-- ('users.create',     'Create users.'),
-- ('users.edit',       'Edit users.'),
-- ('users.delete',     'Delete users.'),

-- -- Roles
-- ('roles.view',       'View roles.'),
-- ('roles.create',     'Create roles.'),
-- ('roles.edit',       'Edit roles.'),
-- ('roles.delete',     'Delete roles.'),

-- -- Permissions
-- ('permissions.view',   'View permissions.'),
-- ('permissions.assign', 'Assign permissions to roles.'),

-- -- Warehouse
-- ('warehouse.view',   'View warehouse.'),
-- ('warehouse.create', 'Create warehouse records.'),
-- ('warehouse.edit',   'Edit warehouse records.'),
-- ('warehouse.delete', 'Delete warehouse records.'),

-- -- Customs
-- ('customs.view',   'View customs declarations.'),
-- ('customs.create', 'Create customs declarations.'),
-- ('customs.edit',   'Edit customs declarations.'),
-- ('customs.delete', 'Delete customs declarations.'),

-- -- Documents
-- ('documents.view',   'View documents.'),
-- ('documents.create', 'Upload documents.'),
-- ('documents.edit',   'Edit documents.'),
-- ('documents.delete', 'Delete documents.'),

-- -- Cargo comments / photos
-- ('cargo.documents.create', 'Add documents to cargo.'),
-- ('cargo.photos.create',    'Add photos to cargo.'),
-- ('cargo.comments.create',  'Add comments to cargo.');


-- ============================================================
-- SUPER ADMIN -> ALL PERMISSIONS
-- ============================================================

INSERT INTO `role_permissions` (`role_id`, `permission_id`)
SELECT
    r.id,
    p.id
FROM `roles` r
CROSS JOIN `permissions` p
WHERE r.name = 'super_admin';


-- ============================================================
-- END
-- ============================================================