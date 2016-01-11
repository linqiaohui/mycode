--设置自赠字段
create sequence user_id
start with 6
increment by 1
no minvalue
no maxvalue
cache 1;

alter table user_login alter column user_id set default nextval('user_id');