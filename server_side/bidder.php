<?php 
	class Bidder {
		public $bidderid;
		public $lastname;
		public $firstname;
		public $address;
		public $phone;

		function __construct($bidderid,$lname, $fname, $address, $phone) {
			$this->bidderid = $bidderid;
			$this->lastname = $lname;
			$this->firstname = $fname;
			$this->address = $address;
			$this->phone = $phone;
		}

		function __toString() {
			$output = "<h2> Bidder Number: $this->bidderid </h2> \n".
					  "<h2> $this->lastname, $this->firstname </h2> \n".
					  "<h2> $this->address </h2> \n".
					  "<h2> $this->phone </h2> \n";

			return $output;
		}

		function saveBidder() {
			$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
			$query = "INSERT INTO bidders VALUES($this->bidderid, "$this->lastname", "$this->firstname", "$this->address", "$this->phone")";
			$queryResult = mysqli_query($connDB, $query);

			$connDB->close();
			return $queryResult;
		}

		function updateBidder() {
			$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
			$query = "UPDATE bidders SET bidderid=$this->bidderid, lastname="$this->lastname", firstname="$this->firstname", address="$this->address", phone="$this->phone" WHERE bidderid=$this->bidderid";
			$queryResult = mysqli_query($connDB, $queryResult);

			$connDB->close();
			return $queryResult;
		}

		function removeBidder() {
			$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
			$query = "DELETE FROM bidders WHERE bidderid=$this->bidderid";
			$queryResult = mysqli_query($connDB, $queryResult);

			return $queryResult;
		}

		static function getBidders() {
			$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
			$query = "SELECT * FROM bidders";
			$queryResult = mysqli_query($connDB, $query);

			if(mysqli_num_rows($queryResult) > 0) { 
				$bidder = array();
				while ($bid = mysqli_fetch_array(MYSQLI_ASSOC)) {
					$bidder = new Bidder($bid['bidderid'], $bid['lastname'], $bid['firstname'], $bid['address'], $bid['phone']);
					array_push($bidder, $bid);
					unset($bid);
				}
				$connDB->close();
				return $bidder;
			} else {
				$connDB->close();
				return NULL;
			}			
		}

		static function findBidder($bidderid) {
			$connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
			$query = "SELECT * FORM bidders WHERE bidderid = $bidderid";
			$queryResult = mysqli_query($connDB, $query);
			$row = $queryResult->fetch_array(MYSQLI_ASSOC);
			
			if($row) {
			$bidder = new Bidder($bid['bidderid'], $bid['lastname'], $bid['firstname'], $bid['address'], $bid['phone']);

			$connDB->close();
			return $bidder;
			} else {
				$connDB->close();
				return NUll;
			}
		}
	}
 ?>e