<?php
/*抽象类方式实现策略模式*/
//抽象类规定规范
abstract class P {
    abstract public function getname(person $person);
    abstract public function gettype();
}

//具体的策略类
//具体的算法实现
class man extends P {
    public function getname(person $_person) {
        return $_person->_name;
    }
    public function gettype() {
        return "男";
    }
}
//具体策略类
//具体算法实现类，从P继承规范
class woman extends P {
    public function getname(person $_person) {
        return $_person->_name;
    }
    public function gettype() {
        return "女";
    }
}

//环境类
//算法解决类，提供统一的类调用不同的算法解决同一件事
class person {
    protected $_name;
    protected $_type;
    public function __construct($name,$type) {
        $this->_name = $name;
        $this->_type = $type;
    }
    
    public function __get($key) {
        return $this->$key;
    }
    public function gettype() {
        return $this->_type->gettype();
    }
    public function getname() {
        return $this->_type->getname($this);
    }
}

//应用
$man1 = new person("王路",new man());
echo $man1->gettype().$man1->getname();


/*接口方式实现策略模式*/
interface travelstrategy {
    public function traveltype();
}

//具体策略类
class airplane implements travelstrategy {
    public function traveltype() {
        echo "坐飞机";
    }
}

//具体策略类
class bus implements travelstrategy {
    public function traveltype() {
        echo "坐巴士";
    }
}

//环境类，调用接口的类
class trave {
    protected $_strategy;
    public function __construct(travelstrategy $traveltype) {
        $this->_strategy = $traveltype;
    }
    public function gettraveltype() {
        return $this->_strategy->traveltype();
    }
}
//应用
$travel = new trave(new airplane);
$travel->gettraveltype();


/*完整实例*/
abstract class L {
    abstract public function cost(Lesson $_lesson);
    abstract public function type(Lesson $_lesson);
}

//具体策略类
class Math extends L {
    public function cost(Lesson $_lesson) {
        return 200*$_lesson->discount*$_lesson->_num;
    }
    public function type(Lesson $_lesson) {
        return "您选的课程是".$_lesson->type."数学，总价： ";
    }
}
class English extends L {
    public function cost(Lesson $_lesson) {
        return 300*$_lesson->discount*$_lesson->_num;
    }
    public function type(Lesson $_lesson) {
        return "您选的课程是".$_lesson->type."数学，总价： ";
    }
}

//环境类
class Lesson {
    protected $_num;
    protected $_strategy;
    public function __construct($num,L $strategy) {
        $this->_num = $num;
        $this->_strategy = $strategy;
    }
    public function __get($object) {
        return $this->$object;
    }
    public function cost() {
        return $this->_strategy->cost($this);
    }
    public function type() {
        return $this->_strategy->type($this);
    }
}

class Arts extends Lesson {
    protected $discount = 0.75;
    protected $type = "文科";
}
class Science extends Lesson {
    protected $discount = 0.50;
    protected $type = "理科";
}

//应用
$arts = new Arts(6,new Math());
echo $arts->type().$arts->cost();
echo "<br>";
$science = new Science(6,new Math());
echo $science->type().$science->cost();
