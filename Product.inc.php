<?php
class Product
{
    private $id;
    private $description;
    private $quantity;
    private $price;

    public function __construct($id = -1, $description, $quantity, $price)
    {
        $this->id = $id;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function getPrice()
    {
        return $this->price;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
}
