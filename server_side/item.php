<?php
class Item
{
    public $itemid;
    public $title;
    public $description;
    public $resaleprice;
    public $winbidder;
    public $winprice;

    function __construct($itemid, $title, $description, $resaleprice, $winbidder, $winprice)
    {
        $this->itemid = $itemid;
        $this->title = $title;
        $this->description = $description;
        $this->resaleprice = $resaleprice;
        $this->winbidder = $winbidder;
        $this->winprice = $winprice;
    }

    function __toString()
    {
        $output = "<h2> Item: $this->itemid </h2> \n" .
            "<h2> Name: $this->title </h2> \n" .
            "<h2> Description: $this->description </h2> \n" .
            "<h2> Resale price: $this->resaleprice </h2> \n" .
            "<h2> Winning bid: $this->winbidder at $this->winprice </h2>";
        return $output;
    }

    function saveItem()
    {
        $connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
        $query = "INSERT INTO items VALUES ($this->itemid, $this->title, 
                $this->description, 
                $this->resaleprice,
                $this->winbidder,
                $this->winprice)";
        $queryResult = mysqli_connect($connDB, $query);
        return $queryResult;
    }

    function updateItem()
    {
        $connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
        $query = "UPDATE items SET $this->title, 
                $this->description, 
                $this->resaleprice, 
                $this->winbidder, 
                $this->winprice 
                WHERE itemid=$this->itemid";
        $queryResult = mysqli_connect($connDB, $query);

        return $queryResult;
    }

    function removeItem()
    {
        $connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
        $query = "DELETE FROM items WHERE itemid=$this->itemid";
        $queryResult = mysqli_connect($connDB, $query);
        return $queryResult;
    }

    static function getItems()
    {
        $connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
        $query = "SELECT * FROM items";
        $queryResult = mysqli_connect($connDB, $query);

        if (mysqli_num_rows($queryResult) > 0) {
            $items = array();
            while ($row = mysqli_fetch_assoc($queryResult)) {
                $item = new Item(
                    $row['itemid'],
                    $row['title'],
                    $row['description'],
                    $row['resaleprice'],
                    $row['winbidder'],
                    $row['winprice']
                );

                array_push($items, $item);
            }

            return $items;
        } else {
            return NULL;
        }
    }

    static function getItemsByBidder($bidderid)
    {
        $connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
        $query = "SELECT * FROM items WHERE winbidder= $bidderid";
        $queryResult = mysqli_connect($connDB, $query);

        if (mysqli_num_rows($queryResult) > 0) {
            $items = array();
            while ($row = mysqli_fetch_assoc($queryResult)) {
                $item = new Item(
                    $row['itemid'],
                    $row['title'],
                    $row['description'],
                    $row['resaleprice'],
                    $row['winbidder'],
                    $row['winprice']
                );

                array_push($items, $item);
            }

            return $queryResult;
        } else {
            return NULL;
        }
    }

    static function findItem($itemid)
    {
        $connDB = mysqli_connect('localhost', 'root', 'root', 'auctionHelper');
        $query = "SELECT * FROM items  WHERE itemid=$itemid";
        $queryResult = mysqli_connect($connDB, $query);
        $row = mysqli_fetch_assoc($queryResult);
        if ($row) {
            $item = new Item(
                $row['itemid'],
                $row['title'],
                $row['description'],
                $row['resaleprice'],
                $row['winbidder'],
                $row['winprice']
            );

            return $item;
        } else {
            return NULL;
        }
    }
}
