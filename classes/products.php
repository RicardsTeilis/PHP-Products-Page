<?php
class Products extends DbConnect {
	
	public function select() {
		$sql = "SELECT * FROM products";

		$result = $this->connect()->query($sql);

		if($result->rowCount() > 0){
			while ($row = $result->fetch()){
				$data[] = $row;
			}
		return $data;
		}
	}

	public function insert($fields) {

		$implodeColumns = implode(', ', array_keys($fields));
		$implodeValues = implode(", :", array_keys($fields));

		$sqlCheckSKU = "SELECT * FROM products WHERE SKU = '" . $fields['SKU'] . "'";
		$resultCheckSKU = $this->connect()->query($sqlCheckSKU);

		if($resultCheckSKU->rowCount() > 0 && !empty($fields['SKU'])) {
			echo "<script language='javascript'>alert('A product with this SKU already exists!')</script>";
		}

		else {
			$sql = "INSERT INTO products ($implodeColumns) VALUES (:".$implodeValues.")";

			$result = $this->connect()->prepare($sql);

			foreach ($fields as $key => $value) {
				$result->bindValue(':'.$key, $value);
			}

			$resultExec = $result->execute();

			if($resultExec) {
				header('Location: index.php');
			}
		}

	}

	public function delete($idString) {

		$sql = "DELETE FROM products WHERE Id IN (".$idString.")";
		$result = $this->connect()->query($sql);
		$resultExec = $result->execute();

		if($resultExec) {
				header('Location: index.php');
			}

	}

}