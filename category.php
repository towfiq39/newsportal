<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>News Portal | Category  Page</title>
      <!-- Bootstrap core CSS -->
      <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- Custom styles for this template -->
      <link href="css/modern-business.css" rel="stylesheet">
   </head>
   <body>
      <!-- Navigation -->
      <?php include('includes/header.php');?>
      <!-- Page Content -->
      <div class="container">
         <div class="row" style="margin-top: 4%">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
               <!-- Blog Post -->
               <div class="row justify-content-center">
                  <?php
                  $cat_id_index= mysqli_real_escape_string($con,$_GET['catid']) ;
                  if($cat_id_index>0){
                  $_SESSION['catid']=intval($_GET['catid']);
                  }
                 
                  if (isset($_GET['pageno'])) {
                  $pageno = $_GET['pageno'];
                  } else {
                  $pageno = 1;
                  }
                  $no_of_records_per_page = 10;
                  $offset = ($pageno-1) * $no_of_records_per_page;
                  $total_pages_sql = "SELECT COUNT(*) FROM tblposts where CategoryId ={$_SESSION['catid']}";
                  $result = mysqli_query($con,$total_pages_sql);
                  
                  $total_rows = mysqli_fetch_array($result)[0];
                  $total_pages = ceil($total_rows / $no_of_records_per_page);
                  $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.CategoryId='".$_SESSION['catid']."' and tblposts.Is_Active=1 order by tblposts.id desc LIMIT $offset, $no_of_records_per_page");
                  $rowcount=mysqli_num_rows($query);
                  if($rowcount==0)
                  {
                  header('location:error.php');
                  }
                  else {
                  while ($row=mysqli_fetch_array($query)) {
                  ?>
                  <!-- <h1><?php echo htmlentities($row['category']);?> News</h1> -->
                  <div class="card mb-4 col-lg-6">
                     <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>" height="250">
                     <div class="card-body">
                        <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="text-dark" style="text-decoration:none "><h5 class="card-title"><?php echo htmlentities($row['posttitle']);?></h5></a>
                        <p><b>Category : </b> <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a> </p>
                        
                        <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="btn btn-primary">Read More &rarr;</a>
                     </div>
                     <div class="card-footer text-muted">
                        Posted on <?php echo htmlentities($row['postingdate']);?>
                     </div>
                  </div>
                  <?php } ?>
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
               <?php } ?>
               <!-- Pagination -->
               
            </div>
            <!-- Sidebar Widgets Column -->
            <?php include('includes/sidebar.php');?>
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container -->
      <!-- Footer -->
      <?php include('includes/footer.php');?>
      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="js/all.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      
      
   </body>
</html>