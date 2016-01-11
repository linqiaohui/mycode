--还原
--1.用此语句得到备份文件的逻辑文件名：
RESTORE FILELISTONLY FROM DISK = N'd:\tempdb\olddb.bak' --备份文件存放路径
--看LogicalName，一般会有两个文件,如：
--olddb      --主逻辑文件名称
--olddb_log  --日志逻辑文件名称
 
--2.用以下语句还原数据库
RESTORE DATABASE new_db   
FROM DISK = 'd:\tempdb\olddb.bak' 
WITH MOVE 'olddb' TO 'd:\tempdb\newdb.mdf', 
MOVE 'olddb_log' TO 'd:\tempdb\newdb_log.ldf'  
 
/*--对以上代码补充说明：
RESTORE DATABASE 还原后数据库的名称   
FROM DISK = '备份文件的路径\备份数据库名称.bak' 
WITH MOVE '主逻辑文件名称' TO '还原后的路径\还原后数据文件名称.mdf', 
MOVE '日志逻辑文件名称' TO '还原后的路径\还原后日志文件名称_log.ldf'  
*/