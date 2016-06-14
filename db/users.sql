
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

CREATE OR REPLACE FUNCTION user_update(
    id int,         -- $1
    login text,
    passwd text,    -- $3
    name text,
    email text      -- $5
) RETURNS int AS $$

UPDATE users
    SET (login, passwd, name, email) =
        ($2,
        CASE $3 IS NULL
            WHEN TRUE THEN
                (SELECT passwd
                 FROM users
                 WHERE id=$1)
            ELSE $3
            END,
        $4,
        $5)
    WHERE id=$1
    RETURNING id;
$$ LANGUAGE SQL VOLATILE;

CREATE OR REPLACE FUNCTION auth (
    l_login text,
    l_passwd text
) RETURNS TABLE (
    id          int,
    login       text,               -- user login
    name        text,               -- display name
    email       text,               -- user email
    last_login  TIMESTAMP           -- last login attempt
) AS $$
DECLARE
    l_last_login TIMESTAMP;
BEGIN
    SELECT users.last_login INTO l_last_login
        FROM users
        WHERE users.login=$1 AND users.passwd=$2;

    UPDATE users SET last_login=NOW()
         WHERE users.login=$1 AND users.passwd=$2;

    RETURN QUERY
        SELECT users.id, users.login, users.name, users.email,
            l_last_login
            FROM users
            WHERE users.login=$1 AND users.passwd=$2;
END;
$$ LANGUAGE plpgsql VOLATILE;


CREATE OR REPLACE FUNCTION register_user(
    user_name   TEXT,
    user_pwd    TEXT
) RETURNS int AS $$
DECLARE
    i INT;
BEGIN
    -- RAISE UNIQUE_VIOLATION;
    INSERT INTO users (login, passwd) VALUES ($1, $2)
        RETURNING id INTO i;
    RETURN i;
EXCEPTION
    WHEN UNIQUE_VIOLATION THEN
        RETURN -1;
    WHEN NOT_NULL_VIOLATION THEN
        RETURN -2;
END;
$$ LANGUAGE plpgsql VOLATILE;
