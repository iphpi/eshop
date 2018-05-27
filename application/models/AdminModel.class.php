<?php
//后台管理员模型
class AdminModel extends Model{
    //获取所有的管理员
    public function getAdmins(){
        $sql = "SELECT * FROM {$this->table}";
        return $this->db->getAll($sql);
    }
}




































