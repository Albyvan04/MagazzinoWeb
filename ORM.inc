<?php
class ORM
{
    private $conn = null;
    private $nameDb = 'login_5f';

    public function OpenConn()
    {
        $this->conn = new mysqli('localhost', 'root', null, $this->nomeDb);
    }

    public function CloseConn()
    {
        $this->conn->close();
    }

    public function CreateUser($username, $password, $priviledge)
    {
        $query = "INSERT INTO Accounts (username, password, priviledge) VALUES ('$username', '$password', '$priviledge')";
        $conn->query($query);
    }

    public function SearchUser($username, $password)
    {
        $query = "SELECT * FROM Accounts WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($query);
        return $result;
    }

    public function CreateProduct($description, $quantity, $price)
    {
        $query = "INSERT INTO Products (description, quantity, price) VALUES ('$description', '$quantity', '$price')";
        $conn->query($query);
    }

    public function UpdateProduct($updated_product)
    {
        $query = "UPDATE Products SET description = '$updated_product->description', quantity = '$updated_product->quantity', price = '$updated_product->price' WHERE id = '$updated_product->id'";
        $conn->query($query);
    }

    public function DeleteProduct($product)
    {
        $query = "DELETE FROM Products WHERE id = '$product->id'";
        $conn->query($query);
    }

    public function SearchProduct($description, $min_price = 0.00, $max_price = 999999.99)
    {
        $query = "SELECT * FROM Products WHERE description LIKE '%$description%' AND price BETWEEN $min_price AND $max_price";
        $result =  $conn->query($query);
        return = $result;
    }
}
?>