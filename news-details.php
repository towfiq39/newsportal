<?php
session_start();
include('includes/config.php');
//Genrating CSRF Token
if (empty($_SESSION['token'])) {
$_SESSION['token'] = bin2hex(random_bytes(32));
}
$postid=intval($_GET['nid']);
if(!$postid>0){
header('location:error.php');
}
if(isset($_POST['submit']))
{
//Verifying CSRF Token
if (!empty($_POST['csrftoken'])) {
if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
$name=$_POST['name'];
$email=$_POST['email'];
$comment=$_POST['comment'];
$postid=intval($_GET['nid']);
$st1='0';
$query=mysqli_query($con,"insert into tblcomments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
if($query):
echo "<script>alert('comment successfully submit. Comment will be display after admin review ');</script>";
unset($_SESSION['token']);
else :
echo "<script>alert('Something went wrong. Please try again.');</script>";
endif;
}
}
}
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
        <!-- Custom styles for this template -->
        <link href="css/modern-business.css" rel="stylesheet">
    </head>
    <body>
        <!-- Navigation -->
        <?php include('includes/header.php');?>
        <!-- news content -->
        <section class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 ">
                    <div class="row justify-content-center">
                        <!--  news content start -->
                        <div class="col-lg-9 col-md-10 col-sm-10 col-10">
                            <!-- Blog Post -->
                            <?php
                            $pid=intval($_GET['nid']);
                            $query=mysqli_query($con,"select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
                            if(mysqli_num_rows($query)>0){
                            while ($row=mysqli_fetch_array($query)) {
                            $category_id=$row["cid"];
                            ?>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                                    <b>Category : </b> <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a> |
                                    <b>Sub Category : </b><?php echo htmlentities($row['subcategory']);?> |<b> Posted on </b><small class="badge-primary p-1" style="border-radius:10px"><?php echo htmlentities($row['postingdate']);?></small>
                                    <hr />
                                    <img class="img-fluid rounded" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
                                    <section class="container my-1">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-10">
                                                <img src="images/1680648155394976066.png" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                    </section>
                                    
                                    <p class="card-text " style="width:100%"> <?php
                                        $pt=$row['postdetails'];
                                    echo  (substr($pt,0));?></p>
                                </div>
                            </div>
                            <?php }
                            }else{
                            header('location:error.php');
                            }
                            ?>
                        </div>
                        <!--  news content end -->
                        <!--  advertise start -->
                        <div class="col-lg-3 col-md-5 col-sm-6 col-6" style="position:">
                            <img src="images/1072419251872488173.gif" class="img-fluid my-1" alt="">
                            <img src="images/16445859985367322134.png" class="img-fluid my-3" alt="">
                            <img src="images/1072419251872488173.gif" class="img-fluid my-1" alt="">
                            
                        </div>
                        <!--  advertise end -->
                    </div>
                </div>
                <!--   advertse content start -->
                <section class="container my-1">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <img src="images/14156016864637504686.png" class="img-fluid" alt="">
                        </div>
                    </div>
                </section>
                <!--   advertse content end  -->
                <div class="col-lg-10">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <!-- related post section start -->
                            <section class="container">
                                <h2 class="text-center">
                                Related Post
                                </h2>
                                <div class="row justify-content-center">
                                    <?php
                                    
                                    $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 and tblposts.CategoryId='$category_id' order by tblposts.id desc limit 6 ");
                                    
                                    while ($row=mysqli_fetch_array($query)) {
                                    
                                    ?>
                                    <div class=" card mb-4 col-lg-4 col-md-6 col-sm-10 col-12 p-2" >
                                        <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"style="text-decoration:none"><img class="card-img-top post-image" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>" style="height:150px"></a><br>
                                        <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="text-dark" style="text-decoration:none "><h5 class="card-title"><?php echo htmlentities($row['posttitle']);?></h5></a>
                                        <p><b>Category : </b> <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>"><?php echo htmlentities($row['category']);?></a> </p> 
                                        <small class="">Posted on <?php echo htmlentities($row['postingdate']);?></small>
                                    </div>
                                    <?php
                                    }
                                    
                                    ?>
                                    
                                </div>
                            </section>
                        </div>
                        <!-- comment section start -->
                        <div class="col-lg-8 col-md-8">
                            <div class="card my-4">
                                <h5 class="card-header">Leave a Comment:</h5>
                                <div class="card-body">
                                    <form name="Comment" method="post">
                                        <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Enter your fullname" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Enter your Valid email" required>
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <!---Comment Display Section --->
                            <?php
                            $sts=1;
                            $query=mysqli_query($con,"select name,comment,postingDate from  tblcomments where postId='$pid' and status='$sts'");
                            while ($row=mysqli_fetch_array($query)) {
                            
                            ?>
                            <div class="media mb-4">
                                <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0"><?php echo htmlentities($row['name']);?> <br />
                                    <span style="font-size:11px;"><b>at</b> <?php echo htmlentities($row['postingDate']);?></span>
                                    </h5>
                                    
                                    <?php echo htmlentities($row['comment']);?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <!-- comment section end -->
                    </div>
                    
                </div>
                
            </div>
            
        </section>
        
        
        <?php include('includes/footer.php');?>
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="js/all.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>
</html>