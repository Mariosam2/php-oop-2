<?php
class Product
{
    protected $title;
    protected $price;
    protected $image;
    protected $rating;
    public function __construct(String $title, Float $price, String $image, Float $rating, protected Category $category, protected Type $type)

    {
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
        $this->rating = $rating;
        $this->category = $category;
        $this->type = $type;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getPrice()
    {
        return number_format($this->price, 2, '.') . "&euro;";
    }

    public function getRating()
    {
        return round($this->rating, 0);
    }

    public function getCategory()
    {
        return $this->category;
    }
    public function getType()
    {
        return $this->type;
    }
}
