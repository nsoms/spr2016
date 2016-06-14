BEGIN;

CREATE TABLE roles (
    id serial,
    name TEXT,
    profile_upd BOOL DEFAULT FALSE, -- право редактирова свой профиль
    users_upd BOOL DEFAULT FALSE,   -- право редактировать чужие профили
    PRIMARY KEY (id)
);

INSERT INTO roles (name, profile_upd, users_upd) VALUES
 ('admin', TRUE,  TRUE),
 ('guest', FALSE, FALSE),
 ('user',  TRUE,  FALSE);

ALTER TABLE users ADD COLUMN
    role_id INT DEFAULT 3 REFERENCES roles(id);

UPDATE users SET role_id=1 WHERE is_admin=TRUE;

ALTER TABLE users DROP COLUMN is_admin;

UPDATE sysvariables SET var_val='0.0.2'
    WHERE var_name='version';

COMMIT;
