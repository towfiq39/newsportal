<?php
session_start();
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>News Portal | Home Page</title>
      <!-- Bootstrap core CSS -->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="css/all.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="css/modern-business.css" rel="stylesheet">
      <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
   </head>
   <body>
      <!-- Navigation -->
      <?php include('includes/header.php');?>
      <section class="container-fluid" style="background-image: url(images/section_bg.png);background-size:100% 100%;height:75vh;">
         <div class="row justify-content-center">
            <div class="col-lg-5 text-white text-center" style="margin-top:50px">
               <h3> Most Popular news</h3>
               <p>Lorem ipsum dolor sit amet, consecte</p>
               <a href="#popular" class="btn btn-light">Go Here</a>
            </div>
         </div>
      </section>
      <!--  <section class="container-fluid" style="padding-top:50px">
         <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12 ">
               <img src="images/myself.png" alt="" class="img-fluid" style="height:auto">
            </div>
            <div class="col-lg-6 offset-lg-1 col-md-6 col-sm-12 col-12 mb-3">
               <p class=" text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur sit repudiandae nemo cum velit porro voluptatem laboriosam consequuntur pariatur vel ducimus quaerat corrupti vero eum ad maiores numquam qui non iste, itaque temporibus obcaecati iure earum. Expedita ratione qui mollitia, quibusdam dignissimos? Libero cupiditate dolorum <br> <br>
               consequatur soluta ipsum. Consectetur, voluptatum impedit ut suscipit. Rem animi dolor enim excepturi obcaecati, esse quaerat hic nam nihil. Aliquid provident iure quisquam rem consectetur atque, voluptate sunt asperiores modi assumenda est deleniti aspernatur? Est, iste et neque veniam voluptates perferendis laborum omnis dolore fugiat suscipit fugit voluptate explicabo perspiciatis recusandae aliquam. Molestias quas nemo quae deleniti similique aperiam, dolor eveniet magnam ipsum modi possimus iste sit et voluptas debitis iure numquam quia nisi! Accusamus eos nesciunt illo facilis! Illo numquam reprehenderit culpa quibusdam, deleniti, in laboriosam, sed iste, quisquam nulla ut. Soluta architecto et, deserunt hic ut saepe, dolorem! Dicta reiciendis minima, dolorem pariatur incidunt ut, doloribus nesciunt nobis delectus laborum quas sit commodi accusantium praesentium ullam, consequuntur, iure harum quaerat. Obcaecati, laboriosam eveniet sunt, unde ex doloremque quod expedita tempore tenetur harum quasi voluptatem praesentium eaque culpa atque error architecto eum iusto facilis enim voluptas, quam totam. Sit enim totam nostrum quam, veritatis aspernatur commodi placeat pariatur iste vel minus voluptates rem quis ea voluptatem ipsam incidunt est, eius tenetur. Beatae laborum, </p>
               <a href="" class="btn btn-outline-primary">More About Us</a>
            </div>
         </div>
      </section> -->
      <!--   advertse content start -->
      <!-- <section class="container" style="margin-top:-50px">
         <div class="row justify-content-center">
            <div class="col-lg-10">
               <img src="images/1680648155394976066.png" class="img-fluid" alt="">
            </div>
         </div>
      </section> -->
      <!--   advertse content end  -->
      <!-- Page Content -->
      <section class="mb-5 container " style="margin-top:-200px">
         <div class="row justify-content-center bg-white" style="padding:60px 20px;border-radius:10px">
            <?php
            $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT 9");
            while ($row=mysqli_fetch_array($query)) {
            ?>
            <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"style="text-decoration:none;color:#333">
               <div class="mb-4 col-lg-4 col-md-6 col-sm-10 col-10 " >
                  <div class="banner">
                     <img class="card-img-top post-image" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>" style="height:200px;border-radius:10px">
                     <div class="banner_inner">
                        <h5 class="card-title mt-3 ml-1"><?php echo htmlentities($row['posttitle']);?></h5>
                        <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>" style="color:white;text-decoration: none"><?php echo htmlentities($row['category']);?></a> <br>
                        <small class="text-white">Posted on <?php echo htmlentities($row['postingdate']);?></small>
                     </div>
                  </div>
               </div>
            </a>
            <?php } ?>
         </div>
      </section>
      <section>
         <div class="container-fluid mt-4">
            
            <div class="row justify-content-center">
               <!-- Blog Entries Column -->
               <div class="col-lg-8 col-md-8 col-sm-8 col-8" style="margin-top:-60px">
                  
                  <h2 class="p-2 text-primary">All Post</h2>
                  <div class="row">
                     
                     
                     <!-- Blog Post -->
                     <?php
                     if (isset($_GET['pageno'])) {
                     
                     if($_GET['pageno']>0){
                     $pageno = $_GET['pageno'];
                     }else{
                     header('location:error.php');
                     }
                     } else {
                     $pageno = 1;
                     }
                     $no_of_records_per_page = 6;
                     $offset = ($pageno-1) * $no_of_records_per_page;
                     $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                     $result = mysqli_query($con,$total_pages_sql);
                     $total_rows = mysqli_fetch_array($result)[0];
                     $total_pages = ceil($total_rows / $no_of_records_per_page);
                     $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
                     if(mysqli_num_rows($query)>0){
                     while ($row=mysqli_fetch_array($query)) {
                     ?>
                     <div class="card mb-4 col-lg-4 col-md-6 col-sm-10 col-10 hover_fact">
                        <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"style="text-decoration:none"><img class="card-img-top post-image" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>" style="height:150px;border-radius:10px"></a>
                        <div class="card-body">
                           <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="text-dark" style="text-decoration:none "><h5 class="card-title"><?php echo htmlentities($row['posttitle']);?></h5></a>
                           <!--  <p class="text-truncate"><?php echo htmlentities($row['postdetails']);  ?></p> -->
                           <p><b>Category : </b> <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a> </p>
                           
                           <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="btn btn-dark">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                           Posted on <?php echo htmlentities($row['postingdate']);?>
                           
                        </div>
                     </div>
                     <?php }
                     }
                     else{
                     header('location:error.php');
                     } ?>
                  </div>
                  
                  <!-- Pagination -->
               </div>
               
               <div class="offset-lg-1 col-lg-3 col-md-4 col-sm-4 col-4">
                  <img src="images/1072419251872488173.gif" class="img-fluid my-1" alt="">
                  <img src="images/16445859985367322134.png" class="img-fluid my-3" alt="">
                  <img src="images/1072419251872488173.gif" class="img-fluid my-1" alt="">
               </div>
               <ul class="pagination justify-content-center mb-4">
                  <?php
                  if($pageno>1){
                  ?>
                  <li class="page-item"><a href="?pageno=<?php echo ($pageno - 1) ?>" class="page-link">Prev</a></li>
                  <?php
                  }
                  ?>
                  
                  <?php
                  for($i=1;$i<=$total_pages;$i++){
                  if ($i==$pageno) {
                  $active="active";
                  }else{
                  $active="";
                  }
                  ?>
                  <li class="page-item <?php echo $active ?>"><a href="?pageno=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                  <?php  }
                  
                  if( $total_pages>$pageno){
                  ?>
                  <li class="page-item"><a href="?pageno=<?php echo ($pageno + 1) ?>" class="page-link">Next</a></li>
                  <?php
                  }
                  ?>
               </ul>
            </div>
            <!-- /.row -->
         </div>
      </section>
      <!-- /.container -->
      <!-- black post section start -->
      <section class="p-3 mb-3" id="popular" style="background-image: url(images/section_bg.png);background-size:100% 100%">
         <div class="container">
            <h4 class="p-2 text-white mb-2">Most Popular</h4>
            <div class="row justify-content-center">
               <?php
               $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT 4");
               while ($row=mysqli_fetch_array($query)) {
               ?>
               <div class="mb-4 col-lg-3 col-md-6 col-sm-10 col-10" >
                  <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"style="text-decoration:none;color:#333">
                     <img class="card-img-top post-image img-fluid" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>" style="height:150px;border-radius:10px">
                  </a> <br> <br>
                  <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>" class="" style="text-decoration:none;color:white"><?php echo htmlentities($row['category']);?></a>
                  <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"style="text-decoration:none;color:#333">
                     <h5 class="card-title mt-3 text-white"><?php echo htmlentities($row['posttitle']);?></h5>
                  </a>
                  <small class="text-white">Posted on <?php echo htmlentities($row['postingdate']);?></small>
               </div>
               <?php } ?>
            </div>
         </div>
      </section>
      <!-- black post section end -->
      <section class="container-fluid ">
         <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-sm-10 col-10">
               <?php
               $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 and  tblposts.CategoryId='6'  order by tblposts.id desc limit 5 ");
               ?>
               <h2 class="bg-dark text-white text-center p-2">Politics
               </h2>
               <div id="carouselId" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators py-3 bg-dark text-dark w-75">
                     
                     <?php
                     $i=0;
                     foreach ($query as $row ) {
                     $active='';
                     if ( $i==0) {
                     $active='active';
                     } ?>
                     <li data-target="#carouselId" data-slide-to="<?php $i; ?>" class="<?php echo $active; ?>"></li>
                     <?php $i++; }
                     ?>
                     
                     
                  </ol>
                  <div class="carousel-inner" role="listbox">
                     <?php
                     $i=0;
                     foreach ($query as $row ) {
                     $active='';
                     if ( $i==0) {
                     $active='active';
                     } ?>
                     <div class="carousel-item <?php echo $active;  ?>">
                        
                        <img class="card-img-top post-image" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>" height="200" >
                        <div class="carousel-caption text-dark mb-4">
                           <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" style="text-decoration:none "><h5 class="card-title"><?php echo htmlentities($row['posttitle']);?></h5></a>
                           <small class="text-muted">Posted on <?php echo htmlentities($row['postingdate']);?>
                           </small>
                        </div>
                     </div>
                     <?php $i++; }
                     ?>
                     
                     <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 col-10">
               <h2 class="bg-dark text-white text-center p-2">Business
               </h2>
               <?php
               $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 and  tblposts.CategoryId='7' order by tblposts.id desc limit 5 ");
               ?>
               <div id="carouselId2" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators py-3 bg-dark w-75">
                     
                     <?php
                     $i=0;
                     foreach ($query as $row ) {
                     $active='';
                     if ( $i==0) {
                     $active='active';
                     } ?>
                     <li data-target="#carouselId2" data-slide-to="<?php $i; ?>" class="<?php echo $active; ?>"></li>
                     <?php $i++; }
                     ?>
                     
                     
                  </ol>
                  <div class="carousel-inner" role="listbox">
                     <?php
                     $i=0;
                     foreach ($query as $row ) {
                     $active='';
                     if ( $i==0) {
                     $active='active';
                     } ?>
                     <div class="carousel-item <?php echo $active;  ?>">
                        
                        <img class="card-img-top post-image" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>"  height="200" >
                        <div class="carousel-caption text-dark mb-4">
                           <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" style="text-decoration:none "><h5 class="card-title"><?php echo htmlentities($row['posttitle']);?></h5></a>
                           <small class="text-muted">Posted on <?php echo htmlentities($row['postingdate']);?>
                           </small>
                        </div>
                     </div>
                     <?php $i++; }
                     ?>
                     
                     <a class="carousel-control-prev" href="#carouselId2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carouselId2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-10 col-10">
               <?php
               $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc limit 5 ");
               ?>
               <h2 class="bg-dark text-white text-center p-2">Trendz
               </h2>
               <div id="carouselId3" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators py-3 bg-dark w-75" >
                     
                     <?php
                     $i=0;
                     foreach ($query as $row ) {
                     $active='';
                     if ( $i==0) {
                     $active='active';
                     } ?>
                     <li data-target="#carouselId3" data-slide-to="<?php $i; ?>" class="text-dark-dark <?php echo $active; ?>"></li>
                     <?php $i++; }
                     ?>
                     
                     
                  </ol>
                  <div class="carousel-inner" role="listbox">
                     <?php
                     $i=0;
                     foreach ($query as $row ) {
                     $active='';
                     if ( $i==0) {
                     $active='active';
                     } ?>
                     <div class="carousel-item <?php echo $active;  ?>">
                        
                        <img class="card-img-top post-image" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>"height="200" >
                        <div class="carousel-caption text-dark mb-4">
                           <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" style="text-decoration:none "><h5 class="card-title"><?php echo htmlentities($row['posttitle']);?></h5></a>
                           <small class="text-muted">Posted on <?php echo htmlentities($row['postingdate']);?>
                           </small>
                        </div>
                     </div>
                     <?php $i++; }
                     ?>
                     
                     <a class="carousel-control-prev" href="#carouselId3" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle " aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                     </a>
                     <a class="carousel-control-next" href="#carouselId3" role="button" data-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="container-fluid my-5">
         <h2 class="text-center"></h2>
         <div class="row justify-content-center">
            <?php
            $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc limit 6");
            while ($row=mysqli_fetch_array($query)) {
            ?>
            <div class="card col-lg-4 col-md-6 col-sm-10 col-10 my-1">
               <div class="row">
                  <div class="col-lg-6">
                     <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="text-dark" style="text-decoration:none ">
                        <img class="card-img-top post-image" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>" height="150" >
                     </a>
                  </div>
                  <div class="col-lg-6 m-0 p-0">
                     <div class="card-body">
                        <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="text-dark" style="text-decoration:none ">
                           <p class="card-title text-justify"><?php echo htmlentities($row['posttitle']);?></p>
                        </a>
                        <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?>
                        </a>
                        <br>
                        <small class="text-muted">Posted on <?php echo htmlentities($row['postingdate']);?></small>
                     </div>
                  </div>
               </div>
            </div>
            
            <?php } ?>
         </div>
      </section>
      <!--   advertse content start -->
      <section class="container my-1">
         <div class="row justify-content-center">
            <div class="col-lg-10">
               <img src="images/14156016864637504686.png" class="img-fluid" alt="">
            </div>
         </div>
      </section>
      <!--   advertse content end  -->
      <!-- Contact -->
      <?php include('includes/contact.php');?>
      <!-- Footer -->
      <?php include('includes/footer.php');?>
      <!-- Bootstrap core JavaScript -->
     
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="js/all.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      
   </body>
</html>