CREATE LANGUAGE plpgsql;

SELECT 'Drop table test if exists';
DROP TABLE IF EXISTS test;

SELECT 'Creating table test';
CREATE TABLE test (
    i int,
    t text
);

SELECT 'Creating table users';
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id          serial,
    login       text,               -- user login
    passwd      text,               -- user passwd
    name        text,               -- display name
    email       text,               -- user email
    reg_date    date,               -- registration date
    last_login  TIMESTAMP DEFAULT NULL, -- last login attempt
    disabled    bool DEFAULT FALSE, -- user is disabled
    UNIQUE ( login ),
    UNIQUE ( email )
);

