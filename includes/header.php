<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top p-2">
  <a class="navbar-brand" href="index.php">Blogging</a>
 
  
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown active" >
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Category
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php $query=mysqli_query($con,"select id,CategoryName from tblcategory where Is_Active='1' limit 7");
          while($row=mysqli_fetch_array($query))
          {
          ?>
          <a href="category.php?catid=<?php echo htmlentities($row['id'])?>" class="dropdown-item"><?php echo htmlentities($row['CategoryName']);?>
            
          </a>
          
          <?php } ?>
          <div class="dropdown-divider "></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      
    </ul>
  </div>
   <form class="form-inline my-2 my-lg-0"  name="search" action="search.php" method="post">
    <input class="form-control col-lg-10 col-md-10 col-sm-10 col-10 " type="search" placeholder="Search" aria-label="Search" name="searchtitle">
    <button class="btn btn-light col-lg-2 col-md-2 col-sm-2 col-2 text-dark my-2 my-sm-0" type="submit" style="border:1px solid black"><i class="fas fa-search"></i></button>
  </form>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
</nav>