<?php
class ORM
{
    private $conn = null;
    private $nameDb;

    public function __construct($name)
    {
        $this->nameDb = $name;
    }

    public function OpenConn()
    {
        if (!$this->conn) {
            $this->conn = new mysqli('localhost', 'root', null, $this->nameDb);
        }
    }

    public function CloseConn()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    public function CreateUser($username, $password, $privilegi)
    {
        $query = "INSERT INTO utenti (username, password, privilegi) VALUES ('$username', '$password', '$privilegi')";
        $this->conn->query($query);
    }

    public function SearchUser($username, $password)
    {
        $query = "SELECT * FROM utenti WHERE username = '$username' AND BINARY password = '$password'";
        $result = $this->conn->query($query);
        return $result->fetch_all();
    }

    public function CountUser($username)
    {
        $query = "SELECT COUNT(*) FROM utenti WHERE username = '$username'";
        $result = $this->conn->query($query);
        return $result->fetch_row()[0];
    }

    public function CreateProduct($product)
    {
        $query = "INSERT INTO articoli (descrizione, quantita, prezzo) VALUES ('" . $product->getDescription() . "', '" . $product->getQuantity() . "', '" . $product->getPrice() . "')";
        $this->conn->query($query);
    }

    public function UpdateProduct($updated_product)
    {
        $query = "UPDATE articoli SET descrizione = '" . $updated_product->getDescription() . "', quantita = '" . $updated_product->getQuantity() . "', prezzo = '" . $updated_product->getPrice() . "' WHERE id = '" . $updated_product->getId() . "'";
        $this->conn->query($query);
    }

    public function DeleteProduct($product)
    {
        $query = "DELETE FROM articoli WHERE id = '" . $product->getId() . "'";
        $this->conn->query($query);
    }

    public function SearchProduct($descrizione, $minimo, $massimo)
    {
        $query = "SELECT * FROM articoli WHERE descrizione LIKE '%$descrizione%' AND prezzo BETWEEN $minimo AND $massimo";
        $result =  $this->conn->query($query);
        return $result->fetch_all();
    }

    public function ExistsProduct($descrizione)
    {
        $query = "SELECT COUNT(*) FROM articoli WHERE BINARY descrizione = '$descrizione'";
        $result =  $this->conn->query($query);
        return $result->fetch_row()[0];
    }

    public function SelectProducts()
    {
        $query = "SELECT * FROM articoli";
        $result =  $this->conn->query($query);
        return $result->fetch_all();
    }

    public function CountResult()
    {
        return mysqli_field_count($this->conn);
    }
}
