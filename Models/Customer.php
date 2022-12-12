<?php

class Customer
{
    protected $discount;
    protected $products;
    public function __construct(protected Account $account, array $products)
    {
        $this->account = $account;
        $this->products = $products;
    }
    public function getAccount()
    {
        return $this->account;
    }
    public function getProducts()
    {
        foreach ($this->products as $product) {
            if ($product instanceof Product) {
                return $this->products;
            }
        }
    }
}
