--创建用户表
create table family (
    family_id int PRIMARY KEY,
	name char(32),
	login_pwd char(32)
);

--创建捐赠明细表
create table tsm_fdt (
    donor_id int PRIMARY KEY,           --捐赠人
    donation_amount money,    --捐赠金额
    donate_time timestamp without time zone, --捐赠时间
    is_donor_success boolean, --捐赠是否已经完成！ 真为成功，假失败
	donate_type int          --使用为26，捐赠为13
);

--设置family_id自增
create sequence family_id
start with 1
increment by 1
no minvalue
no maxvalue
cache 1;
alter table family alter column family_id set default nextval('family_id');

--设置tsm_fdt自增
CREATE SEQUENCE donor_id
START WITH 1000
INCREMENT by 1
no MINVALUE
no MAXVALUE
cache 1;
ALTER TABLE tsm_fdt ALTER COLUMN donor_id set DEFAULT NEXTVAL('donor_id');