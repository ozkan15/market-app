<?php
class Product
{
    public $id;
    public $name;
    public $image;
    public $preimage;
    public $marketItems;

    function __construct($name, $image, ?int $id = null, ?array $marketItems = null, string $preimage = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->marketItems = $marketItems;
        $this->preimage = $preimage;
    }
}
