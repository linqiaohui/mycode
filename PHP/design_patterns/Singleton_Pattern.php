<?php
/**
*Explain: 单例模式实现
*User: 一梦
*Datatime: 8:06 2016/2/16 星期二 
*/
class Db {
    private $db;
    //单例模式实现核心代码
    protected static $_instance;
    public static function getinstance() {
        if(!(self::$_instance instanceof self)) {
            self::$_instance = new Db();
        }
        return self::$_instance;
    }
    private function __clone(){} //防止被克隆
    private function __construct() {  //防止类外被实例化
        try {
            $this->db = new PDO("pgsql:host=localhost;dbname=ym",'ym','panyuli1314520');
            echo "连接数据库一次";
        } catch (PDOException $e) {
            exit();
        }
    }
}

abstract class dba {
    protected $_db;
    public function __construct() {
        $this->_db = Db::getinstance();
    }
    abstract public function query($sql);
}

class dbaa extends dba {
    public function query($sql) {
        echo "zhixingyju";
    }
}

class dbbb extends dba {
    public function query($sql) {
        echo "aaasa";
    }
}

$c = new dbaa();
$b = new dbbb();

?>