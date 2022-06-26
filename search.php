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
    <title>News Portal | Search  Page</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
  </head>
  <body>
    <!-- Navigation -->
    <?php include('includes/header.php');?>
    <!-- Page Content -->
    <div class="container-fluid">
      
      <div class="row justify-content-center">
        <!-- Blog Entries Column -->
        <div class="col-md-12">
          <!-- Blog Post -->
           <h2 class="p-2 mb-3 text-primary text-center">Showing Post By Your Search Reasult</h2>
          <div class="row justify-content-center">
            
            
            <?php
            if($_POST['searchtitle']!=''){
            $st=$_SESSION['searchtitle']=$_POST['searchtitle'];
            }
            $st;
            
            if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
            } else {
            $pageno = 1;
            }
            $no_of_records_per_page = 8;
            $offset = ($pageno-1) * $no_of_records_per_page;
            $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
            $result = mysqli_query($con,$total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
            $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.PostTitle like '%$st%' and tblposts.Is_Active=1 ");
            $rowcount=mysqli_num_rows($query);
            if($rowcount==0)
            {
            echo "No record found";
            }
            else {
            while ($row=mysqli_fetch_array($query)) {
            ?>
            <div class="card mb-4 col-lg-3 mt-3" >
              <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"style="text-decoration:none"><img class="card-img-top post-image" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>" style="height:200px"></a>
              <div class="card-body">
                <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="text-dark" style="text-decoration:none "><h5 class="card-title"><?php echo htmlentities($row['posttitle']);?></h5></a>
                <!--  <p class="text-truncate"><?php echo htmlentities($row['postdetails']);  ?></p> -->
                <p><b>Category : </b> <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a> </p>
                
                <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="btn btn-primary">Read More &rarr;</a>
              </div>
              <div class="card-footer text-muted">
                Posted on <?php echo htmlentities($row['postingdate']);?>
                
              </div>
            </div>
            <?php } ?>
            
            <?php } ?>
            
            
            <!-- Pagination -->
          </div>
        </div>
        <!-- Sidebar Widgets Column -->
        
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
    
  </head>
</body>
</html>