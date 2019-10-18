<?php
require "database.php";
class Pagination extends database{
    protected $_page;
    protected $_limit;
    protected $_total;
    protected $_nPageShow;
    protected $total_page;
    public function __construct($total,$page=1,$limit=10,$nPageShow=5){
      $this->_total=$total;
      $this->_nPageShow=$nPageShow;
      $this->_limit=$limit;
      $this->total_page=ceil($this->_total/$this->_limit);
      if($page>$this->total_page){
        $this->_page=$this->total_page;
      }else{
      $this->_page=$page;
      }
    }
    public function getLimit(){
      return $this->_limit;
    }
    public function getPage(){
      return $this->_page;
    }
    public function showHTML($nPageShow=5){
      $this->_nPageShow=$nPageShow;
      //$first=1;
        if($this->_page%$this->_nPageShow===0){
          $page_location=$this->_page/$this->_nPageShow-1;
        }else{
          $page_location=floor($this->_page/$this->_nPageShow);
        }
      $last=ceil($this->_total/$this->_limit);
      $pagination_show=array();
      $temp=0;
      do{
      $start=$temp*$this->_nPageShow+1;
      $end=($start+$this->_nPageShow-1<$last)?$start+$this->_nPageShow-1:$last;
      $temp++;
      array_push($pagination_show,array('start'=>$start,'end'=>$end));
      }while($end<$last);
      return $pagination_show[$page_location];

    }
   
}