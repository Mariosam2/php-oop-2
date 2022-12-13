<?php
require_once __DIR__ . '/../Traits/CategoryType.php';
class Type
{
    use CategoryType;
    public function __construct(String $name)
    {
        $this->name = $name;
    }
}
