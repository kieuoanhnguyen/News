<?php 
require 'controller/c_news.php';
session_start();
$c_news=new c_news();
$id_user=$c_news->SignInAccount('oanh','oanhbifgffdfdhjhhjhvghf@gmail.com',1);
