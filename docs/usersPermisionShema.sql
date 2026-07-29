-- =========================================================
-- USERS
-- =========================================================

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

    `email` VARCHAR(254) NOT NULL,
    `username` VARCHAR(32) NOT NULL,

    `first_name` VARCHAR(64) NOT NULL,
    `last_name` VARCHAR(64) NOT NULL,

    `phone` VARCHAR(32) NULL,

    `password_hash` VARCHAR(255) NOT NULL,

    `status` VARCHAR(20) NOT NULL DEFAULT 'active',

    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL,

    PRIMARY KEY (`id`),

    UNIQUE KEY `uniq_users_email` (`email`),
    UNIQUE KEY `uniq_users_username` (`username`)

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- ROLES
-- =========================================================

CREATE TABLE IF NOT EXISTS `roles` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255) NULL,

    PRIMARY KEY (`id`),

    UNIQUE KEY `uniq_roles_name` (`name`)

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- PERMISSIONS
-- =========================================================

CREATE TABLE IF NOT EXISTS `permissions` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(255) NULL,

    PRIMARY KEY (`id`),

    UNIQUE KEY `uniq_permissions_name` (`name`)

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- USERS <-> ROLES
-- =========================================================

CREATE TABLE IF NOT EXISTS `roles_users` (
    `user_id` INT UNSIGNED NOT NULL,
    `role_id` INT UNSIGNED NOT NULL,

    PRIMARY KEY (`user_id`, `role_id`),

    CONSTRAINT `fk_roles_users_user`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE CASCADE,

    CONSTRAINT `fk_roles_users_role`
        FOREIGN KEY (`role_id`)
        REFERENCES `roles` (`id`)
        ON DELETE CASCADE

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- ROLES <-> PERMISSIONS
-- =========================================================

CREATE TABLE IF NOT EXISTS `role_permissions` (
    `role_id` INT UNSIGNED NOT NULL,
    `permission_id` INT UNSIGNED NOT NULL,

    PRIMARY KEY (`role_id`, `permission_id`),

    CONSTRAINT `fk_role_permissions_role`
        FOREIGN KEY (`role_id`)
        REFERENCES `roles` (`id`)
        ON DELETE CASCADE,

    CONSTRAINT `fk_role_permissions_permission`
        FOREIGN KEY (`permission_id`)
        REFERENCES `permissions` (`id`)
        ON DELETE CASCADE

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- =========================================================
-- CARGO PERMISSIONS
-- =========================================================

INSERT INTO `permissions`
    (`name`, `description`)
VALUES
    ('cargo.view',   'View cargo'),
    ('cargo.create', 'Create cargo'),
    ('cargo.edit',   'Edit cargo'),
    ('cargo.delete', 'Delete cargo');


-- =========================================================
-- ROLES
-- =========================================================

INSERT INTO `roles`
    (`name`, `description`)
VALUES
    ('admin',    'System administrator'),
    ('employee', 'Employee'),
    ('client',   'Client');


-- =========================================================
-- ADMIN -> ALL CARGO PERMISSIONS
-- =========================================================

INSERT INTO `role_permissions`
    (`role_id`, `permission_id`)

SELECT
    r.id,
    p.id

FROM `roles` r
CROSS JOIN `permissions` p

WHERE r.name = 'admin'
  AND p.name IN (
      'cargo.view',
      'cargo.create',
      'cargo.edit',
      'cargo.delete'
  );


-- =========================================================
-- EMPLOYEE -> VIEW / CREATE / EDIT CARGO
-- =========================================================

INSERT INTO `role_permissions`
    (`role_id`, `permission_id`)

SELECT
    r.id,
    p.id

FROM `roles` r
CROSS JOIN `permissions` p

WHERE r.name = 'employee'
  AND p.name IN (
      'cargo.view',
      'cargo.create',
      'cargo.edit'
  );


-- =========================================================
-- CLIENT -> ONLY VIEW CARGO
-- =========================================================

INSERT INTO `role_permissions`
    (`role_id`, `permission_id`)

SELECT
    r.id,
    p.id

FROM `roles` r
CROSS JOIN `permissions` p

WHERE r.name = 'client'
  AND p.name = 'cargo.view';