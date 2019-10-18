<?php
require "pager.php";
class m_news extends database{
    public function connect($username,$password){
    parent::connect("localhost","db_tintuc","utf8",$username,$password);
    }
    public function getSlide(){
        //$this->connect($username,$password);
        $sql="SELECT * FROM slide";
        $this->setQuery($sql);
        return $this->myExecute();
    }
    public function getMenu(){
        $sql="SELECT tl.catogary_id as parent_id,lt.newtype_id,tl.catogary_name as parent_name,lt.newtype_name as catogary_name,GROUP_CONCAT(tl.unsigned_name,'/',lt.TenKhongDau) as url FROM theloai tl,loaitin lt WHERE tl.catogary_id=lt.catogary_id GROUP BY tl.catogary_id,lt.newtype_id,tl.catogary_name,lt.newtype_name ORDER BY parent_id";
        $this->setQuery($sql);
        $name="";$items=array();$sub_items=array();
        foreach($this->myExecute() as $key=>$object){
          $temp=$object->parent_id;
          if($name!=$object->parent_name){
          $name=$object->parent_name;
          $sub_items=array();
        }
        if($object->parent_id===$temp){
            $sub_item=(object)['Name'=>$object->catogary_name,'url'=>$object->url,'catogary_id'=>$object->parent_id];
            array_push($sub_items,$sub_item);
        }
        $items[$name]=$sub_items;
    }
    return $items;
   // print_r($items);
    }
    public function getNews(){
        $sql="SELECT * FROM tintuc tt,theloai tl,loaitin lt WHERE tt.catogary_id=lt.newtype_id AND lt.catogary_id=tl.catogary_id ORDER BY new_id";
        $this->setQuery($sql);
        return $this->myExecute();
        
    }
    public function getNewsByCatogaryId($catogary_id){
        $sql="SELECT * FROM tintuc tt,theloai tl,loaitin lt WHERE lt.catogary_id=? AND tt.catogary_id=lt.newtype_id AND lt.catogary_id=tl.catogary_id ORDER BY new_id";
        $this->setQuery($sql);
        return $this->myExecute(array($catogary_id));
    }
    public function getNewsByIDAndPage($catogary_id=1,$page=1,$limit=15){
       $total_news=count($this->getNewsByCatogaryId($catogary_id));
        $pager=new Pagination($total_news,$page,$limit);
        $pagination_showHTML=$pager->showHTML();
        $offset=($pager->getPage()-1)*$limit;
        $this->_sql .=" LIMIT $offset,$limit";
        $data= $this->myExecute(array($catogary_id));
        $current_page=$pager->getPage();
        return array('data'=>$data,'pagination'=>$pagination_showHTML,'current_page'=>$current_page);
    }
    public function LogIn($email,$md5_password){
          $sql="SELECT * FROM users WHERE email=? AND password=?";
          $this->setQuery($sql);
          return $this->myExecute(array($email,$md5_password))[0];
    }
    public function SignIn($name,$email,$password){
        $sql="INSERT INTO users(name,email,password) VALUES(?,?,?)";
        $this->setQuery($sql);
        $result=$this->myExecute2(array($name,$email,md5($password)));
        if($result){
           return true;
        }else{
            return false;
        }
    }
    public function LogOut(){
        setcookie("user_name","",time()-3600,"/");
        header("location:login.php");
    }
}
        




