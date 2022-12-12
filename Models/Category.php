<?php
class Category
{
    protected $name;
    public function __construct(String $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
