
create trigger [dbo].[disable_yzpdk]
on [dbo].[ZY_SYS2_YPZDK]

instead of delete

as

select * from zy_sys2_ypzdk where 2!=2;