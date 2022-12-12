<?php
require_once __DIR__ . '/Customer.php';
class Account extends Customer
{
    protected $username;
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getDiscount()
    {
        return $this->discount;
    }
    public function setDiscount()
    {
        if (strtolower($this->username) != 'Guest') {
            $this->discount = 20;
        } else {
            $this->discount = 0;
        }
    }
}
