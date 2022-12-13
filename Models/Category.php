<?php
require_once __DIR__ . '/../Traits/CategoryType.php';
class Category
{
    use CategoryType;
    public function __construct(String $name)
    {
        $this->name = $name;
    }
}
