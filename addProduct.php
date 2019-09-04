<?php
	require_once "classes/dbconn.php";
	require_once "classes/products.php";

	$sku = "";
	$name = "";
	$price = "";
	$type = "";
	$attributes = "";

	$errorSKU = "";
	$errorName = "";
	$errorPrice = "";
	$errorType = "";
	$errorCount = 0;

	if(isset($_POST['submit'])) {
		if(!empty($_POST['sku'])) {
			$sku = $_POST['sku'];
		}
		else {
			$errorSKU = "SKU is required!";
			$errorCount ++;
		}
		if(!empty($_POST['name'])) {
			$name = $_POST['name'];
		}
		else {
			$errorName = "Name is required!";
			$errorCount ++;
		}
		if(!empty($_POST['price'])) {
			$price = $_POST['price'];
		}
		else {
			$errorPrice = "Price is required!";
			$errorCount ++;
		}
		if(!empty($_POST['type'])) {
			if($_POST['type'] == "DVD-disc") {
				if(empty($_POST['size'])) {
					$errorType = "Type and attributes are required!";
					$errorCount ++;
				}
				else {
					$type = $_POST['type'];
					$attributes = "Size: " . $_POST['size'] . " Mb";
				}
			}
			else if($_POST['type'] == "Book") {
				if(empty($_POST['weight'])) {
					$errorType = "Type and attributes are required!";
					$errorCount ++;
				}
				else {
					$type = $_POST['type'];
					$attributes = "Weight: " . $_POST['size'] . " kg";
				}
			}
			else if($_POST['type'] == "Furniture") {
				if(empty($_POST['height']) || empty($_POST['width']) || empty($_POST['length'])) {
					$errorType = "Type and attributes are required!";
					$errorCount ++;
				}
				else {
					$type = $_POST['type'];
					$attributes = "Dimensions: ".$_POST['height']." x ".$_POST['width']." x ".$_POST['length']." mm";
				}
			}
		}
		else {
			$errorType = "Type is required!";
			$errorCount ++;
		}

		if($errorCount > 0) {
			// var_dump($_POST);
		}
		else {
			$fields = [
			'SKU'=>$sku,
			'Name'=>$name,
			'Price'=>$price,
			'Type'=>$type,
			'Attributes'=>$attributes
			];

			$product = new Products();
			$product->insert($fields);
		}

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Product</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<div class="container body-content">
		<div class="row">
			<div class="jumbotron col-md-6 col-sm-9 col-xs-12" style="margin-top: 20px; padding-top: 20px;">
				<h2>Add Product</h2>
				<form action="" method="post">
					<div class="form-group">
						<label for="sku">SKU</label>&nbsp;<span class="errorMessage"><?php echo $errorSKU; ?></span>
						<input type="text" class="form-control" id="sku" name="sku" value="<?php echo $sku; ?>">
					</div>
					<div class="form-group">
						<label for="name">Name</label>&nbsp;<span class="errorMessage"><?php echo $errorName; ?></span>
						<input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
					</div>
					<div class="form-group">
						<label for="price">Price</label>&nbsp;<span class="errorMessage"><?php echo $errorPrice; ?></span>
						<input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>">
					</div>
					<div class="form-group">
						<label for="type">Type</label>&nbsp;<span class="errorMessage"><?php echo $errorType; ?></span>
						<select id="type" name="type" class="form-control">
							<option></option>
							<option value="DVD-disc">DVD-disc</option>
							<option value="Book">Book</option>
							<option value="Furniture">Furniture</option>
						</select>
					</div>
					<div id="DVD-disc" class="attributes_div" style="display:none;">
						<label for="">Attributes</label> <span style="font-size: 12px;">(Please provide size in "X Mb" format)</span>
						<div class="form-group" style="padding-left: 30px;">
							<label for="size">Size</label>
							<input type="text" class="form-control" id="size" name="size">
						</div>
					</div>
					<div id="Book" class="attributes_div" style="display:none;">
						<label for="">Attributes</label> <span style="font-size: 12px;">(Please provide weight in "X kg" format)</span>
						<div class="form-group" style="padding-left: 30px;">
							<label for="weight">Weight</label>
							<input type="text" class="form-control" id="weight" name="weight">
						</div>
					</div>
					<div id="Furniture" class="attributes_div" style="display:none;">
						<label for="">Attributes</label> <span style="font-size: 12px;">(Please provide dimensions in "H x W x L mm" format)</span>
						<div class="form-group" style="padding-left: 30px;">
							<label for="height">Height</label>
							<input type="text" class="form-control" id="height" name="height">
						</div>
						<div class="form-group" style="padding-left: 30px;">
							<label for="width">Width</label>
							<input type="text" class="form-control" id="width" name="width">
						</div>
						<div class="form-group" style="padding-left: 30px;">
							<label for="length">Length</label>
							<input type="text" class="form-control" id="length" name="length">
						</div>
					</div>
					<input type="submit" name="submit" id="submit" class="btn btn-default">
				</form>
			</div>

		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#type').change(function(){
				$('.attributes_div').hide();
				$('#' + $(this).val()).show();
			});
		});
	</script>

</body>
</html>