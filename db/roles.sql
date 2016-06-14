CREATE OR REPLACE FUNCTION user_allowed_upd_profile (
    id INT
) RETURNS bool AS $$
    SELECT profile_upd FROM roles, users
    WHERE roles.id=users.role_id AND users.id=$1;
$$ LANGUAGE SQL STABLE;
