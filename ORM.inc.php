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
        if(!$this->conn)
        {
            $this->conn = new mysqli('localhost', 'root', null, $this->nameDb);
            #$this->conn->select_db($this->nameDb);
        }
        #print_r($this->conn);
    }

    public function CloseConn()
    {
        if($this->conn)
        {
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
        $query = "SELECT * FROM utenti WHERE username = '$username' AND password = '$password'";
        $result = $this->conn->query($query);
        return $result;
    }

    public function CreateProduct($descrizione, $quantita, $prezzo)
    {
        $query = "INSERT INTO articoli (descrizione, quantita, prezzo) VALUES ('$descrizione', '$quantita', '$prezzo')";
        $this->conn->query($query);
    }

    public function UpdateProduct($updated_product)
    {
        $query = "UPDATE articoli SET descrizione = '$updated_product->descrizione', quantita = '$updated_product->quantita', prezzo = '$updated_product->prezzo' WHERE id = '$updated_product->id'";
        $this->conn->query($query);
    }

    public function DeleteProduct($product)
    {
        $query = "DELETE FROM articoli WHERE id = '$product->id'";
        $this->conn->query($query);
    }

    public function SearchProduct($descrizione, $min_price = 0.00, $max_price = 999999.99)
    {
        $query = "SELECT * FROM articoli WHERE descrizione LIKE '%$descrizione%' AND prezzo BETWEEN $min_price AND $max_price";
        $result =  $this->conn->query($query);
        return $result;
    }

    public function SelectProducts()
    {
        $query = "SELECT * FROM articoli";
        $result =  $this->conn->query($query);
        return $result;
    }

    public function CountResult()
    {
        return mysqli_field_count($this->conn);
    }
}
?>