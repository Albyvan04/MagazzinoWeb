<?php
class Account
{
    private $id;
    private $username;
    private $password;
    private $priviledge;

    public function __construct($id, $username, $password, $priviledge)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->priviledge = $priviledge;
    }

    public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getPassword() { return $this->password; }
    public function getPriviledge() { return $this->priviledge; }

    public function setUsername($username) { $this->username = $username; }
    public function setPassword($password) { $this->password = $password; }
    public function setPriviledge($priviledge) { $this->priviledge = $priviledge; }
}
?>