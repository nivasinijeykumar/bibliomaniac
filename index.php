 <?php 
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblio";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(!isset($_SESSION['roll_no'])){
	header("location:signin.php");
  }
//Fetching datas from book table

$sql = "SELECT * FROM books WHERE status='1'";
$result = mysqli_query($conn, $sql);
	
$cat_sql = "SELECT * FROM category";
$cat_result = mysqli_query($conn, $cat_sql);

$catt_sql = "SELECT * FROM category";
$catt_result = mysqli_query($conn, $catt_sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>BiblioManiac</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
</head>

<body>

<div class="super_container">

	<?php include('header.php'); ?>
	
</div>
	<!-- Slider -->

	<div class="main_slider" style="background-image:url(images/bg4.jpeg)">
		<div class="container fill_height">
		</div>
	</div>

	<!-- Banner -->

	<div class="banner">
		<div class="container">
			<div class="row">
			<?php if(!empty($row = $cat_result -> fetch_row())){ 
				$i=1;
                do {
					$style = "";
							if($i > 3){
								$style = 'style="margin-top: 30px;"';
							} ?>
				<div class="col-md-4" <?php echo $style; ?>>
					<div class="banner_item align-items-center" style="background-image:url(uploads/category/<?php echo $row[2]; ?>)">
						<div class="banner_category">
							<a href="categories.php?id=<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a>
						</div>
					</div>
				</div>
				<?php $i++; }while ($row = $cat_result -> fetch_row()); } ?>
			</div>
		</div>
	</div>

	<!-- New Arrivals -->

	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>New Arrivals</h2>
					</div>
				</div>
			</div>
			<div class="row align-items-center">
				<div class="col text-center">
					<div class="new_arrivals_sorting">
						<ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
							<?php if(!empty($roww = $catt_result -> fetch_row())){ 
							do { ?>
							<li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".<?php echo $roww[1]; ?>"><?php echo $roww[1]; ?></li>
							<?php }while ($roww = $catt_result -> fetch_row()); } ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

					<?php if(!empty($row = $result -> fetch_row())){ 
						do { ?>
						<?php 
							if($row[6] == 1){
								$type = "Sale";
							 	$style = "product_bubble_right product_bubble_red";
							}elseif ($row[6] == 2) {
								$type = "Rent";
								$style = "product_bubble_rightt product_bubble_red";
							}else{
								$type = "Donate"; 
								$style = "product_bubble_left product_bubble_green";
							} 
							$cat = "SELECT * FROM category WHERE id=".$row[5]." LIMIT 1";
							$catresult = mysqli_query($conn, $cat);
							$category=$catresult->fetch_row();
						?>
						<div class="product-item <?php echo $category[1]; ?>">
							<div class="product discount product_filter">
							<div class="product_image">
								<img src="<?php echo 'uploads/'.$row[14]; ?>" alt="" style="max-height: 235px;">
							</div>
							<div class="favorite favorite_left"></div>
							<div class="product_bubble <?php echo $style; ?> d-flex flex-column align-items-center"><span>
							<?php echo $type; ?>
							</span></div>
							<div class="product_info">
								<h6 class="product_name"><a href="bookview.php?id=<?php echo $row[0]; ?>"><?php echo $row[2]; ?></a></h6>
								<div class="product_price"><?php if($row[6] == 1){ echo '$'.$row[7]; }elseif ($row[6] == 2) {
								echo "No of days : ",$row[11];
							}else{ echo "Free"; } ?></div>
							</div>
							</div>
							<div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
						</div>

					<?php }while ($row = $result -> fetch_row()); }else{ echo "no books found"; } ?>
						
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<!-- Benefit -->

	<div class="benefit">
		<div class="container">
			<div class="row benefit_row">
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>free shipping</h6>
							<p>Suffered Alteration in Some Form</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>cach on delivery</h6>
							<p>The Internet Tend To Repeat</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>45 days return</h6>
							<p>Making it Look Like Readable</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 benefit_col">
					<div class="benefit_item d-flex flex-row align-items-center">
						<div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
						<div class="benefit_content">
							<h6>opening all week</h6>
							<p>8AM - 09PM</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Blogs -->

	<div class="blogs">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title">
						<h2>Latest Blogs</h2>
					</div>
				</div>
			</div>
			<div class="row blogs_container">
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(images/blogs.jpg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Top 10 book facts</h4>
							<a href="blog1.php">Read more</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(images/bg2.jpeg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Thought of the day</h4>
							<a class="blog_more" href="blog2.php">Read more</a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 blog_item_col">
					<div class="blog_item">
						<div class="blog_background" style="background-image:url(images/bg1.jpeg)"></div>
						<div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
							<h4 class="blog_title">Video lectures coming soon</h4
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

<?php include("news.php"); ?>
<?php include("Footer.php"); ?>

	

</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
