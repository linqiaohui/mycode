--��ԭ
--1.�ô����õ������ļ����߼��ļ�����
RESTORE FILELISTONLY FROM DISK = N'd:\tempdb\olddb.bak' --�����ļ����·��
--��LogicalName��һ����������ļ�,�磺
--olddb      --���߼��ļ�����
--olddb_log  --��־�߼��ļ�����
 
--2.��������仹ԭ���ݿ�
RESTORE DATABASE new_db   
FROM DISK = 'd:\tempdb\olddb.bak' 
WITH MOVE 'olddb' TO 'd:\tempdb\newdb.mdf', 
MOVE 'olddb_log' TO 'd:\tempdb\newdb_log.ldf'  
 
/*--�����ϴ��벹��˵����
RESTORE DATABASE ��ԭ�����ݿ������   
FROM DISK = '�����ļ���·��\�������ݿ�����.bak' 
WITH MOVE '���߼��ļ�����' TO '��ԭ���·��\��ԭ�������ļ�����.mdf', 
MOVE '��־�߼��ļ�����' TO '��ԭ���·��\��ԭ����־�ļ�����_log.ldf'  
*/