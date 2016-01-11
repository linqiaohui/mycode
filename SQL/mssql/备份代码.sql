
declare @file varchar(1000)
set @file='d:\bak\jxc'+convert(varchar(10),getdate(),12)+'.bak'
backup database jxc to disk=@file

set @file='d:\bak\jxcqx'+convert(varchar(10),getdate(),12)+'.bak'
backup database jxcqx to disk=@file

set @file='d:\bak\soa'+convert(varchar(10),getdate(),12)+'.bak'
backup database soa to disk=@file

set @file='d:\bak\soaqx'+convert(varchar(10),getdate(),12)+'.bak'
backup database soaqx to disk=@file