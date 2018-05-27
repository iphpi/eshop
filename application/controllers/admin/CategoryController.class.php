<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/27
 * Time: 20:35
 */
class CategoryController extends Controller{
    public function indexAction(){
        //获取所有的分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->getCats();
        include CUR_VIEW_PATH . 'cat_list.html';
    }

    public function addAction(){
        //获取所有的分类
        $categoryModel = new CategoryModel('category');
        $cats = $categoryModel->getCats();
        include CUR_VIEW_PATH . 'cat_add.html';
    }

    public function insertAction(){
        //1.获取表单数据
        $data['cat_name'] = trim($_POST['cat_name']);
        $data['unit'] = trim($_POST['unit']);
        $data['sort_order'] = trim($_POST['sort_order']);
        $data['is_show'] = trim($_POST['is_show']);
        $data['cat_desc'] = trim($_POST['cat_desc']);
        $data['parent_id'] = trim($_POST['parent_id']);
        //2.相应的验证和处理
        if($data['cat_name'] == ''){
            $this->jump('index.php?p=admin&c=category&a=add','分类名称不能为空');
        }
        //3.调用模型入库并给出提示
        $categoryModel= new CategoryModel('category');
        if($categoryModel->insert($data)){
            $this->jump('index.php?p=admin&c=category&a=index','添加分类成功',3);
        }else{
            $this->jump('index.php?p=admin&c=category&a=add','添加分类失败');
        }
    }

    public function editAction(){
        //获取cat_id
        $cat_id = $_GET['cat_id'] + 0;
        //通过模型得到这条记录
        $categoryModel = new CategoryModel('category');
        $cat = $categoryModel->selectByPk($cat_id);
        $cats = $categoryModel->getCats();
        include CUR_VIEW_PATH . 'cat_edit.html';
    }

    public function updateAction(){
        $data['cat_name'] = trim($_POST['cat_name']);
        $data['unit'] = trim($_POST['unit']);
        $data['sort_order'] = trim($_POST['sort_order']);
        $data['is_show'] = trim($_POST['is_show']);
        $data['cat_desc'] = trim($_POST['cat_desc']);
        $data['parent_id'] = trim($_POST['parent_id']);
        $data['cat_id'] = $_POST['cat_id'];
//验证和处理


        $categoryModel = new CategoryModel('category');
        $ids = $categoryModel->getSubIds($data['cat_id']);
        if(in_array($data['parent_id'],$ids)){
            $this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}",'不可将当前分类或子分类作为自身上级分类',5);
        }
        //3.调动模型
        if($categoryModel->update($data)){
            $this->jump('index.php?p=admin&c=category&a=index','修改分类成功',3);
        }else{
            $this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}",'修改分类失败',5);
        }
    }

    public function deleteAction(){
        //获取id
        $cat_id = $_GET['cat_id'] + 0;
        //判断
        $categoryModel = new CategoryModel('category');
        $ids = $categoryModel->getSubIds($cat_id);
        if(count($ids)>1){
            $this->jump('index.php?p=admin&c=category&a=index','当前分类下有后代分类,不可直接删除');
        }
        //调用模型完成删除给出跳转
        if($categoryModel->delete($cat_id)){
            $this->jump('index.php?p=admin&c=category&a=index','删除成功',3);
        }else{
            $this->jump('index.php?p=admin&c=category&a=index','删除失败');
        }

    }





}








































