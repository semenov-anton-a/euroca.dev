CREATE TABLE `employees` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,

    `user_id` INT UNSIGNED DEFAULT NULL,

    `position` VARCHAR(100) DEFAULT NULL,
    `department` VARCHAR(100) DEFAULT NULL,

    `hire_date` DATE DEFAULT NULL,
    `termination_date` DATE DEFAULT NULL,

    `status` VARCHAR(20) NOT NULL DEFAULT 'active',

    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `deleted_at` DATETIME DEFAULT NULL,

    PRIMARY KEY (`id`),

    UNIQUE KEY `uk_employees_user_id` (`user_id`),
    KEY `idx_employees_status` (`status`),
    KEY `idx_employees_department` (`department`),

    CONSTRAINT `fk_employees_user`
        FOREIGN KEY (`user_id`)
        REFERENCES `users` (`id`)
        ON DELETE SET NULL
        ON UPDATE CASCADE

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;