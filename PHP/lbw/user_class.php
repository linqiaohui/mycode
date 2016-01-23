<?php
    /*********************************************************************/
    /*** 用户类，方法有：                                                  **/ 
    /*** 用户登陆方法(user_login)---------返回值: 成功返回TRUE，失败返回 FALSE **/
    /*** 用户注册方法(user_registration)--返回值: 成功返回TRUE，失败返回 FALSE **/
    /*** 判断是否为用户方法(is_user)-------返回值: 是用户返回TRUE,不是返回 FALSE */
    /*** 获取用户ID方法(get_userid)-------返回值: $user_id                  */
    /********************************************************************/
    class user {
        private $pgsql="pgsql:host=localhost;dbname=ym";
        private $dbuser = "ym";
        private $dbpwd = "panyuli1314520";
        
        /************** 用户登陆方法 ******************/
        /* 登陆过程：校验用户名密码，设置session        **/
        /****** 成功返回 TRUE   失败返回 FALSE ********/
        public function user_login($user_name,$user_password)
        {
            try
            {
                $pgpdo = new PDO($this->pgsql,$this->dbuser,$this->dbpwd);
                $type = $this->user_loginname_is_type($user_name);
                
                if($type==1)
                {
                    $sm = $pgpdo->prepare('SELECT count(*) FROM user_login WHERE user_login_name = :email AND user_password = :pwd; ');
                    $sm->bindParam(":email",$user_name);
                    $sm->bindParam(":pwd",$user_password);
                    $sm->execute();
                } 
                else if($type==2)
                {
                    $sm = $pgpdo->prepare('SELECT count(*) FROM user_login WHERE user_phone_number = :phone AND user_password = :pwd;');
                    $sm->bindParam(":phone",$user_name);
                    $sm->bindParam(":pwd",$user_password);
                    $sm->execute();
                }
                else
                {
                    $sm = $pgpdo->prepare('SELECT count(*) FROM user_login WHERE user_login_name = :name AND user_password = :pwd;');
                    $sm->bindParam(":name",$user_name);
                    $sm->bindParam(":pwd",$user_password);
                    $sm->execute();
                }
                $sm_result = $sm->fetchALL();
                if($sm_result[0][count]==1) //rowCount方法返回由$sm上次执行查询时的行数！
                { 
                    return TRUE;
                } 
                else
                {
                    return FALSE;
                }
            } 
            catch (PDOException $e) 
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                return FALSE;
            }
            finally
            {
                $pgpdo = null;
            }
        }
        
        /********** 用户登陆名类型检查方法 ********/
        /* 邮箱类型返回：1 手机号返回：2 其他返回：3 */
        private function user_loginname_is_type($user_name)
        {
             $pattern_email = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
             $pattern_phone = "/1[3458]{1}\d{9}$/";
             if(preg_match($pattern_email,$user_name))
             {
                return 1;
             } 
             else if(preg_match($pattern_phone,$user_name))
             {
                return 2;
             } 
             else
             {
                return 3;
             }     
        }
        
        /********** 判断用户是否存在方法 **********/
        /* 存在返回: TRUE  不存在为匿名用户返回：FALSE */
        public function is_user($user_name)
        {
            $type = $this->user_loginname_is_type($user_name);
            try
            {
                $pgpdo_is = new PDO($this->pgsql,$this->dbuser,$this->dbpwd);
                if($type == 1)
                {
                    $sm_is = $pgpdo_is->prepare('SELECT count(*) FROM user_login WHERE user_email = :email;');
                    $sm_is->bindParam(":email",$user_name);
                    $sm_is->execute();
                }
                else if($type ==2)
                {
                    $sm_is = $pgpdo_is->prepare('SELECT count(*) FROM user_login WHERE user_phone_number = :phone;');
                    $sm_is->bindParam(":phone",$user_name);
                    $sm_is->execute();
                }
                else
                {
                    $sm_is = $pgpdo_is->prepare('SELECT count(*) FROM user_login WHERE user_login_name = :name;');
                    $sm_is->bindParam(":name",$user_name);
                    $sm_is->execute();
                }
                $sm_is_result = $sm_is->fetchALL();
                if($sm_is_result[0][count]==0)
                {
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            } 
            catch (PDOException $e)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
            }
            finally
            {
                $pgpdo_is = null;
            }

        }
        
        
        /********* 用户注册方法 **********/
        /* 成功返回：TRUE  失败返回:FALSE */
        public function user_registration($user_name,$user_password)
        {
            $user_login_name = "";
            $user_email = "";
            $user_phone_number = "";
            if( !$this->is_user($user_name) )
            {
                $type = $this->user_loginname_is_type($user_name);
                if($type == 1)
                {
                    $user_email = $user_name;
                }
                else if($type == 2)
                {
                    $user_phone_number = $user_name;
                } 
                else
                {
                    $user_login_name = $user_name;
                }
                
                try
                {
                    $pgpdo_reg = new PDO($this->pgsql,$this->dbuser,$this->dbpwd);
                    $reg_sm = $pgpdo_reg->prepare('INSERT INTO user_login(user_login_name,user_email,user_phone_number,user_password) VALUES(?,?,?,?);');
                    $reg_sm->execute(array($user_login_name,$user_email,$user_phone_number,$user_password));
                    $num = $reg_sm->rowCount();
                    if($num == 1)
                    {
                        return TRUE;
                    }
                    else
                    {
                        return FALSE;
                    }
                }
                catch (PDOException $e)
                {
                      print "Error!: " . $e->getMessage()."<br/>";
                      return FALSE;
                }
                finally
                {
                    $pgpdo_reg = null;
                }
            }
            else
            {
                return FALSE;
            }
        }
        
        /*** 获取用户ID ***/
        public function get_userid($user_name)
        {
            if($this->is_user($user_name)) 
            {
                try
                {
                    $pgpdo_get = new PDO($this->pgsql,$this->dbuser,$this->dbpwd);
                    $type = $this->user_loginname_is_type($user_name);
                    switch ($type)
                    {
                        case 1:
                            $sm_get = $pgpdo_get->prepare('SELECT user_id FROM user_login WHERE user_email = :email;');
                            $sm_get->bindParam(":email",$user_name);
                            $sm_get->execute();
                            break;
                        case 2:
                            $sm_get = $pgpdo_get->prepare('SELECT user_id FROM user_login WHERE user_phone_number = :phone;');
                            $sm_get->bindParam(":phone",$user_name);
                            $sm_get->execute();
                            break;
                        case 3:
                            $sm_get = $pgpdo_get->prepare('SELECT user_id FROM user_login WHERE user_login_name = :name;');
                            $sm_get->bindParam(":name",$user_name);
                            $sm_get->execute();
                            break;
                        default: break;
                    }
                    $user_id_result = $sm_get->fetchALL();
                    $user_id = $user_id_result[0][user_id];
                    return $user_id;
                }
                catch (PDOException $e)
                {
                    print "Error!: " . $e->getMessage() . "<br/>";
                }
                finally
                {
                    $pgpdo_get = null;
                }
            }
        }
    }
?>
