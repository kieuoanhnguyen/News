<?php
class database{
    protected $_conn="";
    protected $_sql="";
    protected $_cursor=NULL;
   public function connect($servername="localhost",$dbname,$charset,$user,$password){
       try{
        
        $this->_conn= new PDO("mysql:host=$servername;dbname=$dbname;charset=$charset",$user,$password);
        $this->_conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        return $this->_conn;
       
    }catch(PDPException $e){
            echo "connect fail". $e->getMessage();
       }
   }
   public function setQuery($sql){
       $this->_sql=$sql;
   }
   public function myExecute($paramenter=array()){
     $this->_cursor=$this->_conn->prepare($this->_sql);

     $this->_cursor->execute($paramenter);

     $this->_cursor=$this->_cursor->fetchAll(PDO::FETCH_OBJ);
     
     return $this->_cursor;
  }
  public function myExecute2($paramenter=array()){
       $this->_cursor=$this->_conn->prepare($this->_sql);
       $this->_cursor->execute($paramenter);
       return $this->_cursor;
  }
  public function getLastId(){
      return $this->_cursor->lastInsertId();
  }
}
