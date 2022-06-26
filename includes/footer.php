<footer class=" container-fluid" style="background-color: rgb(0, 0, 0);
    color: rgb(142, 142, 147);">
  <div class=" text-white p-5">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-7 col-sm-11 col-11 ">
        <h5 class="mb-3 text-uppercase">Pages</h5>
        <p class="text-justify" style="color: rgb(174, 174, 178); font-size:13px">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Deleniti, consequatur unde odio similique totam nulla minima quisquam quas quo, eveniet ipsa aperiam, odit, perspiciatis laboriosam. Quo nihil harum consectetur placeat odit numquam aperiam sunt ullam voluptatem eius mollitia laboriosam velit, similique maiores quisquam tenetur unde sed. Voluptate voluptates tenetur, unde.</p>
        <ul  class="list-unstyled">
          <li><a class="nav-link p-0 m-0" href="about.html">About</a></li>
          <li><a class="nav-link p-0 m-0" href="">Privacy And Policy</a></li>
          <li><a class="nav-link p-0 m-0" href="">Terms and Condition</a></li>
          <li><a class="nav-link p-0 m-0" href="">About</a></li>
        </ul> <br>
        <ul class="list-inline">
          <li class="list-inline-item "><a class="social-icon text-xs-center" href="#"><i class="fab fa-facebook "></i></a></li>
          <li class="list-inline-item "><a class="social-icon text-xs-center" href="#"><i class="fab fa-twitter "></i></a></li>
          <li class="list-inline-item "><a class="social-icon text-xs-center" href="#"><i class="fab fa-youtube "></i></a></li>
          <li class="list-inline-item "><a class="social-icon text-xs-center" href="#"><i class="fab fa-google-plus "></i></a></li>
        </ul>
      </div>
      <div class="col-lg-2 col-md-5 col-sm-5 col-6 ">
        <h5 class="">CONTACTS</h5>
        <ul class="list-inline">
          <li><i class="fa fa-map-marker"></i><span class="text-primary pl-1">000 ABC Rajshahi</span> </li>
          <li><i class="fa fa-phone"></i> <span class="text-primary pl-1">0170000000001</span></li> 
          <li><i class="fa fa-map-marker"></i><span class="text-primary pl-1">000 ABC Rajshahi</span> </li>
          <li><i class="fa fa-phone"></i> <span class="text-primary pl-1">0170000000001</span></li>
          <li><i class="fa fa-envelope" aria-hidden="true"></i> <span class="text-primary pl-1">mail@gmail.com </span> or <br> <span class="text-primary pl-1">Support@mail.com </span></li><br>
        </ul>
      </div>
      <div class="col-lg-2 col-md-7 col-sm-6 col-6 ">
        <h5 class="">Categories</h5>
        <ul class="list-styled mb-0">
          <?php $query=mysqli_query($con,"select id,CategoryName from tblcategory limit 10");
          while($row=mysqli_fetch_array($query))
          {
          ?>
          <li>
            <a href="category.php?catid=<?php echo htmlentities($row['id'])?>" style="text-decoration:none"><?php echo htmlentities($row['CategoryName']);?></a>
          </li>
          <?php } ?>
        </ul>
      </div>
      <div class="col-lg-4 col-md-5 col-sm-11 col-11 ">
        <h5 class="">Recent News</h5>
        
        <ul class="mb-0">
          <?php
         $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId ORDER BY pid DESC limit 10");
          while ($row=mysqli_fetch_array($query)) {
          ?>
          <li>
            <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" style="text-decoration:none"><?php echo htmlentities($row['posttitle']);?></a>
          </li>
          <?php } ?>
        </ul>
      </div>
      
    </div>
  </div>
  <div class="row justify-content-center">
    <p class="my-3" style="color:#6c757d">2021 © Developed by <span class="text-danger font-weight-bold">Towfiq</span>.</p>
  </div>
</footer>