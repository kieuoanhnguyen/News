<?php 
require "controller/c_news.php";
$c_news=new c_news();
$content=$c_news->index();
$slide=$content['slide'];
$menu=$content['menu'];
$news=content['news'];
//echo $_COOKIE['user_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Khoa Pham</title>

    <!-- Bootstrap Core CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="public/css/shop-homepage.css" rel="stylesheet">
    <link href="public/css/my.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.public/js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="gioithieu.html">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="lienhe.html">Liên hệ</a>
                    </li>
                </ul>

                <form class="navbar-form navbar-left" role="search">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Submit</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                <?php if(!isset($_COOKIE['user_name'])){
                ?>
                    <li>
                        <a href="signin.php">Đăng ký</a>
                    </li>
                    <li>
                        <a href="login.php">Đăng nhập</a>
                    </li>
                <?php }else{
                ?>
                    <li>
                    	<a>
                    		<span class ="glyphicon glyphicon-user"></span><?=$_COOKIE['user_name']?>
                    	</a>
                    </li>

                    <li>
                    	<a href="logout.php">Đăng xuất</a>
                    </li>
                <?php }?>
                </ul>
            </div>



            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
					<?php 
					for($i=0;$i<count($slide);$i++)
					{
						if($i===0) {
					?>
                        <div class="item active">
                            <img class="slide-image" src="public/image/slide/<?=$slide[$i]->Hinh?>" alt="">
						</div>
					<?php 
						}else{
					?>
                        <div class="item">
                            <img class="slide-image" src="public/image/slide/<?=$slide[$i]->Hinh?>" alt="">
                        </div>
					<?php
						}
					}
					?>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            <div class="col-md-3 ">
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active">
                    	Menu
                    </li>
					<?php
					foreach($menu as $parent_name=>$subs_name){
					?>
                    <li href="#" class="list-group-item menu1">
                    	<?= $parent_name?>
					</li>
					<ul>
					<?php foreach($subs_name as $item){
					?>
                		<li class="list-group-item">
                			<a href="loaitin.php"><?= $item->Name?></a>
                		</li>
					<?php
					}?>
					</ul>
					<?php
				}
					?>
                </ul>
			</div>
			 
			<div class="col-md-9">
	            <div class="panel panel-default">
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;"> Tin Tức</h2>
	            	</div>

	            	<div class="panel-body">
						<!-- item -->

					
						<?php
                   // foreach($news as $new){
					foreach($menu as $parent_name=>$subs_name){
					?>
					    <div class="row-item row">
		                	<h3>
								<a href="#"><?=$parent_name?></a> 
								<?php foreach($subs_name as $item){
					?>
								<small><a href="loaitin.html"><i><?=$item->Name?></i></a>/</small>
								<?php
				            }
					?>
							</h3>
		                	<div class="col-md-12 border-right">
		                		<div class="col-md-3">
			                        <a href="chitiet.html">
			                            <img class="img-responsive" src="public/image/<?=$new->Hinh?>" alt="">
			                        </a>
			                    </div>

			                    <div class="col-md-9">
			                        <h3><?=$new->TieuDe?></h3>
			                        <p><?=$new->TomTat?></p>
			                        <a class="btn btn-primary" href="chitiet.html">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
		                	</div>

							<div class="break"></div>
						</div>
						<?php } 
                        ?>
		                <!-- end item -->
		                <!-- item -->
					  
		                <!-- end item -->

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

    <!-- Footer -->
    <hr>
    <footer>
        <div class="row">
            <div class="col-md-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
    <!-- jQuery -->
    <script src="public/js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/my.js"></script>

</body>

</html>
