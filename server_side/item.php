<?php 
	class Item {
		public $itemid;
		public $title;
		public $description;
		public $resaleprice;
		public $winbidder;
		public $winprice;
	}

	function __construct($itemid, $title, $description, $resaleprice, $winbidder, $winprice) {
		$this->itemid = $itemid;
		$this->title = $title;
		$this->description = $description;
		$this->winbidder = $winbidder;
		$this->winprice = $winprice;
	}

	function __toString() {
		$output = "<h2> Item: $this->itemid </h2>".
				  "<h2> Name: $this->title </h2>\n";
				  "<h2> Description: $this->description </h2> \n";
				  "<h2> Resaleprice: $this->resaleprice </h2> \n";
				  "<h2> Winning bid: $this->winbidder at $this->winprice </h2> \n";
		return $output;
	}

	function saveItem() {
		$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
		$query = "INSERT INTO items VALUES ($this->itemid, "$this->title", "$this->description", $this->resaleprice, $this->winbidder, $this->winprice)";
		$queryResult = mysqli_query($connDB, $query);
		$connDB->close();

		return $queryResult;
	}

	function updateItem() {
		$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
		$query = "UPDATE items SET "
	}
 ?>