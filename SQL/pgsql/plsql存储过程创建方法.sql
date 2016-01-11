CREATE OR REPLACE FUNCTION born_userid()
RETURN int AS
$BODY$
    DECLARE
        scratch_number int;
        user_id int;
    BEGIN
        scratch_number = SELECT count(*) FROM userid_scratch;
        IF (scratch_number > 0) 
        THEN
            user_id = SELECT min(id_scratch) FROM userid_scratch;
            RETURN user_id;
        ELSE
            user_id = SELECT MAX(user_id)+1 FROM user_login;
            RETURN user_id;
    END
$BODY$