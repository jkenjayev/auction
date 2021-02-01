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
		// $query = "INSERT INTO items VALUES ($this->itemid, "$this->title", "$this->description", $this->resaleprice, $this->winbidder, $this->winprice)";
		$queryResult = mysqli_query($connDB, $query);
		$connDB->close();

		return $queryResult;
	}

	function updateItem() {
		$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
		// $query = "UPDATE items SET "$this->title", "$this->description", $this->resaleprice, "$this->winbidder", $this->winprice WHERE itemid=$this->itemid";
		$queryResult = mysqli_query($connDB, $query);
		$connDB->close();	

		return $queryResult;
	}

	function removeItem() {
		$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
		$query = "DELETE FROM items WHERE itemid=$this->itemid";
		$queryResult = mysqli_query($connDB, $query);
		$connDB->close();

		return $queryResult;
	}

	static function getItems() {
		$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
		$query = "SELECT * FROM items";
		$queryResult = mysqli_query($connDB, $query);

		if(mysqli_num_rows($queryResult) > 0) {
			$items = array();
			while ($row = $queryResult->fetch_array(MYSQLI_ASSOC)) {
				$item = new Items($row['itemid'], $row['title'],
					$row['description'], $row['resaleprice'], $row['winbidder'], $row['winprice']);
				array_push($items, $item);
			}

			$connDB->close();
			return $items;
		} else {
			$connDB->close();
			return NULL;
		}
	}

	static function getItemsByBidder($bidderid) {
		$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
		$query = "SELECT * FROM items WHERE  winbidder=$bidderid";
		$queryResult = mysqli_query($connDB, $query);

		if(mysqli_num_rows($queryResult) > 0) {
			$items = array();
			while($row = $queryResult->fetch_array(MYSQLI_ASSOC)) {
					$item = new Item($row['itemid'], $row['title'], $row['description'], $row['resaleprice'], 
							$row['winbidder'], $row['winprice']);
					array_push($items, $item);
			}

			$connDB->close();
			return $queryResult;
		} else {
			$connDB->close();
			return NULL;
		}
	}

	static function findItem($itemid) {
		$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
		$query = "SELECT * FROM items WHERE itemid= $itemid";
		$queryResult = mysqli_query($connDB, $query);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		if ($row) {
			$item = new Item($row['itemid'], $row['name'], $row['description'],
			$row['resaleprice'], $row['winbidder'], $row['winprice']);
			$db->close();
			return $item;
		} else {
			$db->close();
			return NULL;
		}
	}
 ?>

















