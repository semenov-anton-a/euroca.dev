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

    `email` VARCHAR(191) DEFAULT NULL,
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

CREATE TABLE `employees` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED DEFAULT NULL,

    `position` VARCHAR(100) DEFAULT NULL,

    `hire_date` DATE DEFAULT NULL,
    `termination_date` DATE DEFAULT NULL,

    `status` VARCHAR(20) NOT NULL DEFAULT 'active',
    `note` TEXT DEFAULT NULL,

    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` DATETIME DEFAULT NULL,

    PRIMARY KEY (`id`),

    UNIQUE KEY `uk_employees_user_id` (`user_id`),
    KEY `idx_employees_status` (`status`),
    KEY `idx_employees_position` (`position`),
    KEY `idx_employees_deleted_at` (`deleted_at`),

    CONSTRAINT `fk_employees_user`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE SET NULL
        ON UPDATE CASCADE

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `employee_documents` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `employee_id` INT UNSIGNED NOT NULL,
    `document_type` VARCHAR(50) NOT NULL,
    `document_name` VARCHAR(255) NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    `file_path` VARCHAR(500) NOT NULL,
    `mime_type` VARCHAR(100) DEFAULT NULL,
    `file_size` BIGINT UNSIGNED DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),

    KEY `idx_employee_documents_employee_id` (`employee_id`),
    KEY `idx_employee_documents_type` (`document_type`),

    CONSTRAINT `fk_employee_documents_employee`
        FOREIGN KEY (`employee_id`)
        REFERENCES `employees` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;