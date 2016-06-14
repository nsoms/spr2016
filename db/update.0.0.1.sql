BEGIN;

UPDATE users SET login=CONCAT(name, '_', id)
    WHERE login IS NULL;

ALTER TABLE users ALTER COLUMN login SET NOT NULL;


CREATE TABLE sysvariables (
    var_name    TEXT, -- имя параметра настройки
    var_val     TEXT  -- значение
);

INSERT INTO sysvariables VALUES
    ('version', '0.0.1');

END;