<?php
	require_once "classes/dbconn.php";
	require_once "classes/products.php";

	$product = new Products();
	$rows = $product->select();

	if(isset($_POST['deleteSelected'])) {
		$idString = implode(', ', $_POST['delete']);
		$product = new Products();
		$product->delete($idString);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Online Shop</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<!-- Navbar -->
	<nav class="navbar navbar-inverse navbar-sticky">
		<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Shop</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

<!-- Products -->

	<div class="container body-content">
		<form method="post" action="">
			<div class="row" style="padding-left: 15px; margin-bottom: 20px;">
				<a href="addProduct.php" class="btn btn-success" role="button">Add product</a>&nbsp;&nbsp;<input type="submit" name="deleteSelected" id="submit" class="btn btn-danger" value="Delete selected" onclick="return confirm('Are you sure you want to delete selected items?')">
			</div>
			<div class="row" style="">
				<?php
					if(empty($rows)) {
				?>
						<div style="margin: 0 15px; text-align: center; font-size: 18px;" class="panel panel-default">
							<div class="panel-body">
								The product list is empty
							</div>
						</div>
				<?php
					}
					else {
						foreach ($rows as $row) {
				?>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input type="checkbox" name="delete[]" value="<?php echo $row['Id']; ?>">
								<div class="thumbnail" style="text-align: center; padding-bottom: 20px;">
									<div class="caption">
										<h3><?php echo $row['Name']; ?></h3>
										<p><?php echo $row['SKU']; ?></p>
										<h4><?php echo $row['Price']; ?> eur</h4>
										<p><?php echo $row['Attributes']; ?></p>
									</div>
								</div>
							</div>
				<?php
						}
					}
				?>
			</div>
		</form>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			var maxHeight = 0;			
			$(".thumbnail").each(function(){
				if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
			});			
			$(".thumbnail").height(maxHeight);
		});
	</script>

</body>
</html>