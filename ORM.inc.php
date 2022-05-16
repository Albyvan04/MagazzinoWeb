<?php
class ORM
{
    private $conn = null;
    private $nameDb;

    public function __construct($name)
    {
        $nameDb = $name;
    }

    public function OpenConn()
    {
        if(!isset($this->conn))
        {
            $this->conn = new mysqli('localhost', 'root', null, $this->nameDb);
        }
    }

    public function CloseConn()
    {
        if(isset($this->conn))
        {
            $this->conn->close();
        }
    }

    public function CreateUser($username, $password, $priviledge)
    {
        $query = "INSERT INTO Accounts (username, password, priviledge) VALUES ('$username', '$password', '$priviledge')";
        $this->conn->query($query);
    }

    public function SearchUser($username, $password)
    {
        $query = "SELECT * FROM Accounts WHERE username = '$username' AND password = '$password'";
        $result = $this->conn->query($query);
        return $result;
    }

    public function CreateProduct($description, $quantity, $price)
    {
        $query = "INSERT INTO Products (description, quantity, price) VALUES ('$description', '$quantity', '$price')";
        $this->conn->query($query);
    }

    public function UpdateProduct($updated_product)
    {
        $query = "UPDATE Products SET description = '$updated_product->description', quantity = '$updated_product->quantity', price = '$updated_product->price' WHERE id = '$updated_product->id'";
        $this->conn->query($query);
    }

    public function DeleteProduct($product)
    {
        $query = "DELETE FROM Products WHERE id = '$product->id'";
        $this->conn->query($query);
    }

    public function SearchProduct($description, $min_price = 0.00, $max_price = 999999.99)
    {
        $query = "SELECT * FROM Products WHERE description LIKE '%$description%' AND price BETWEEN $min_price AND $max_price";
        $result =  $this->conn->query($query);
        return $result;
    }
}
?>