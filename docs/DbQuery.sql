-- Получение прав пользователя по его имени
SELECT
    u.id AS user_id,
    u.username,
    u.email,
    r.name AS role_name,
    JSON_ARRAYAGG(p.name) AS permissions
FROM users u
JOIN roles_users ru
    ON ru.user_id = u.id
JOIN roles r
    ON r.id = ru.role_id
JOIN role_permissions rp
    ON rp.role_id = r.id
JOIN permissions p
    ON p.id = rp.permission_id
WHERE u.username = 'antusem'
GROUP BY
    u.id,
    u.username,
    u.email,
    r.name;

-- result
-- {
--     "user_id": 1001,
--     "username": "antusem",
--     "email": "semenov.anton.a@gmail.com",
--     "permissions": [
--         "cargo.create",
--         "cargo.edit",
--         "cargo.view"
--     ]
-- }

------------------------------------------------------------