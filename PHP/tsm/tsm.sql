--�����û���
create table family (
    family_id int PRIMARY KEY,
	name char(32),
	login_pwd char(32)
);

--����������ϸ��
create table tsm_fdt (
    donor_id int PRIMARY KEY,           --������
    donation_amount money,    --�������
    donate_time timestamp without time zone, --����ʱ��
    is_donor_success boolean, --�����Ƿ��Ѿ���ɣ� ��Ϊ�ɹ�����ʧ��
	donate_type int          --ʹ��Ϊ26������Ϊ13
);

--����family_id����
create sequence family_id
start with 1
increment by 1
no minvalue
no maxvalue
cache 1;
alter table family alter column family_id set default nextval('family_id');

--����tsm_fdt����
CREATE SEQUENCE donor_id
START WITH 1000
INCREMENT by 1
no MINVALUE
no MAXVALUE
cache 1;
ALTER TABLE tsm_fdt ALTER COLUMN donor_id set DEFAULT NEXTVAL('donor_id');