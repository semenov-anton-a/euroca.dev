SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS role_permissions;
DROP TABLE IF EXISTS roles_users;
DROP TABLE IF EXISTS permissions;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS users;

SET FOREIGN_KEY_CHECKS = 1;


-- ============================================================
-- USERS
-- ============================================================

CREATE TABLE users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,

    email VARCHAR(255) NOT NULL,
    username VARCHAR(100) NOT NULL,

    password_hash VARCHAR(255) NOT NULL,

    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,

    phone VARCHAR(50) DEFAULT NULL,

    status ENUM('active', 'blocked', 'pending')
        NOT NULL DEFAULT 'active',

    created_at DATETIME DEFAULT NULL,
    updated_at DATETIME DEFAULT NULL,
    deleted_at DATETIME DEFAULT NULL,

    PRIMARY KEY (id),

    UNIQUE KEY uq_users_email (email),
    UNIQUE KEY uq_users_username (username),

    KEY idx_users_status (status),
    KEY idx_users_deleted_at (deleted_at)

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- ROLES
-- ============================================================

CREATE TABLE roles (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,

    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,

    created_at DATETIME DEFAULT NULL,
    updated_at DATETIME DEFAULT NULL,

    PRIMARY KEY (id),

    UNIQUE KEY uq_roles_name (name)

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- PERMISSIONS
-- ============================================================

CREATE TABLE permissions (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,

    name VARCHAR(100) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,

    created_at DATETIME DEFAULT NULL,
    updated_at DATETIME DEFAULT NULL,

    PRIMARY KEY (id),

    UNIQUE KEY uq_permissions_name (name)

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- USERS <-> ROLES
-- ============================================================

CREATE TABLE roles_users (
    user_id INT UNSIGNED NOT NULL,
    role_id INT UNSIGNED NOT NULL,

    PRIMARY KEY (user_id, role_id),

    KEY idx_roles_users_role_id (role_id),

    CONSTRAINT fk_roles_users_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_roles_users_role
        FOREIGN KEY (role_id)
        REFERENCES roles(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- ROLES <-> PERMISSIONS
-- ============================================================

CREATE TABLE role_permissions (
    role_id INT UNSIGNED NOT NULL,
    permission_id INT UNSIGNED NOT NULL,

    PRIMARY KEY (role_id, permission_id),

    KEY idx_role_permissions_permission_id (permission_id),

    CONSTRAINT fk_role_permissions_role
        FOREIGN KEY (role_id)
        REFERENCES roles(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_role_permissions_permission
        FOREIGN KEY (permission_id)
        REFERENCES permissions(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE

) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;