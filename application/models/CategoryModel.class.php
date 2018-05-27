<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/27
 * Time: 20:42
 */
class CategoryModel extends Model{
    public function getCats(){
        $sql = "SELECT * FROM {$this->table}";
        $cats = $this->db->getAll($sql);
        return $this->tree($cats);
    }

    //对给定的数组进行重新排序
    public function tree($data,$pid=0,$level=0){
        static $arr = [];
        foreach ($data as $v) {
            if($v['parent_id']==$pid){
                //说明找到,先保存
                $v['level'] = $level;
                $arr[] = $v;
                $this->tree($data,$v['cat_id'],$level+1);
            }
        }
        return $arr;
    }

    public function getSubIds($cat_id)
    {
        $sql = "SELECT * FROM {$this->table}";
        $cats = $this->db->getAll($sql);
        $arr = $this->tree($cats,$cat_id);
        $ids = [];
        foreach($arr as $cat){
            $ids[] = $cat['$cat_id'];
        }
        //将自己也追加进来
        $ids[] = $cat_id;
        return $ids;
    }

}


























