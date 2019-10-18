<?php 
require "model/m_news.php";
class c_news{
   public function index(){
       $m_news=new m_news();
       $m_news->connect("boss","Oanhbisubeo@2611");
       $slide=$m_news->getSlide();
       $menu=$m_news->getMenu();
       $news=$m_news->getNews();
       return array('slide'=>$slide,'menu'=>$menu,'news'=>$news);
   }
   public function Catogary_News(){
       $m_news=new m_news();
       $m_news->connect("boss","Oanhbisubeo@2611");
       if(!empty($_GET['id'])){
           $catogary_id=$_GET['id'];
       }else{
           $catogary_id=1;
       }
       $news=$m_news->getNewsByCatogaryId($catogary_id);
       return array('news'=>$news);
   }
   public function getDataByPage(){
    $m_news=new m_news();
    $m_news->connect("boss","Oanhbisubeo@2611");
    $catogary_id=(!empty($_GET['id']))?$_GET['id']:1;
    $page=(!empty($_GET['page']))?$_GET['page']:1;
    $limit=(!empty($_GET['limit']))?$_GET['limit']:15;
    $news=$m_news->getNewsByIDAndPage($catogary_id,$page,$limit);
    return $news;
   }
   public function LoginAccount($email,$password){
    $m_news=new m_news();
    $m_news->connect("boss","Oanhbisubeo@2611");
    $user=$m_news->LogIn($email,$password);
    echo $user->name;
    if(!empty($user)){
        $_SESSION['user_name']=$user->name;
        if(isset($_SESSION['user_error'])){
            unset($_SESSION['user_error']);
        }
         setcookie('user_name',$user->name,time()+86400*180,"/");
         session_destroy();
         header("location:index.php");
    }
    else{
        $_SESSION['user_error']="Log in don't success";
        header("location:login.php");
    }
   }
   public function SignInAccount($name,$email,$password){
        $m_news=new m_news();
        $m_news->connect("boss","Oanhbisubeo@2611");
        $id_user=$m_news->SignIn($name,$email,$password);
        if($id_user){
            $_SESSION['success']="sign in successfuly";
            if(isset($_SESSION['error'])){
                unset($_SESSION['error']);
            }
            print_r($_SESSION['success']);
            session_destroy();
            header("location:login.php");

        }else{
            $_SESSION['error']="sign in don't successfuly";
        }
   }
   public function LogOutAccount(){
       $m_news=new m_news();
       $m_news->connect("boss","Oanhbisubeo@2611");
       $m_news->LogOut();
   }
}
