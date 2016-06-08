SELECT 'Drop table test if exists';
DROP TABLE IF EXISTS test;

SELECT 'Creating table test';
CREATE TABLE test (
    i int,
    t text
);