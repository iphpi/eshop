<?php
//后台管理员模型
class AdminModel extends Model{
    //获取所有的管理员
    public function getAdmins(){
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->getAll($sql);
    }

    //验证用户名和密码
    public function checkUser($username,$password)
    {
//        $password = md5($password);
        $sql = "SELECT * FROM {$this->table} WHERE 
        admin_name='{$username}' AND password='{$password}' LIMIT 1";
        return $this->db->getRow($sql);
    }
}




































