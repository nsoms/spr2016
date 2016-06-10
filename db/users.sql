
DROP FUNCTION get_users();
DROP FUNCTION get_users(int);
CREATE OR REPLACE FUNCTION get_users(
    id int
) RETURNS TABLE(
    id int,
    login       text,               -- user login
    name        text,               -- display name
    email       text,               -- user email
    last_login  TIMESTAMP           -- last login attempt
) AS $$
    SELECT
        id, login, name, email, last_login
    FROM users
    WHERE CASE $1 IS NULL
        WHEN TRUE THEN TRUE
        ELSE id=$1
    END;
$$ LANGUAGE SQL STABLE;

CREATE OR REPLACE FUNCTION update_user(
    id int,     -- $1
    name text,  -- $2
    email text  -- $3
) RETURNS int AS $$
    UPDATE users
        SET (name, email) = ($2, $3)
        WHERE id=$1
        RETURNING id;
$$ LANGUAGE SQL VOLATILE;

