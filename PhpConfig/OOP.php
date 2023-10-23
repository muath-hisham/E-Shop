<?php
class Product implements Serializable
{
    private $id;
    private $name;
    private $desc;
    private $price_before;
    private $price_after;
    private $category_id;

    private $imgs = [];

    public function __construct($id, $name, $desc, $price_before, $price_after, $category_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->price_before = $price_before;
        $this->price_after = $price_after;
        $this->category_id = $category_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    public function getPriceBefore()
    {
        return $this->price_before;
    }

    public function setPriceBefore($price_before)
    {
        $this->price_before = $price_before;
    }

    public function getPriceAfter()
    {
        return $this->price_after;
    }

    public function setPriceAfter($price_after)
    {
        $this->price_after = $price_after;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function getImgs()
    {
        return $this->imgs;
    }

    public function getFirstImg()
    {
        return $this->imgs[0];
    }

    public function setImg($img)
    {
        $this->imgs[] = $img;
    }

    public function serialize() {
        return serialize([
            'id' => $this->id,
            'name' => $this->name,
            'desc' => $this->desc,
            'price_before' => $this->price_before,
            'price_after' => $this->price_after,
            'category_id' => $this->category_id,
            'imgs' => $this->imgs,
        ]);
    }

    public function unserialize($data) {
        $unserializedData = unserialize($data);
        $this->id = $unserializedData['id'];
        $this->name = $unserializedData['name'];
        $this->desc = $unserializedData['desc'];
        $this->price_before = $unserializedData['price_before'];
        $this->price_after = $unserializedData['price_after'];
        $this->category_id = $unserializedData['category_id'];
        $this->imgs = $unserializedData['imgs'];
    }
}

class ProductBuyed implements Serializable {
    private $product; // This should be an instance of the Product class or an array of product details
    private $size;
    private $color;
    private $quantity;

    public function __construct($product, $size, $color, $quantity) {
        $this->product = $product;
        $this->size = $size;
        $this->color = $color;
        $this->quantity = $quantity;
    }

    public function getProduct() {
        return $this->product;
    }

    public function getSize() {
        return $this->size;
    }

    public function getColor() {
        return $this->color;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function serialize() {
        return serialize([
            'product' => $this->product,
            'size' => $this->size,
            'color' => $this->color,
            'quantity' => $this->quantity,
        ]);
    }

    public function unserialize($data) {
        $unserializedData = unserialize($data);
        $this->product = $unserializedData['product'];
        $this->size = $unserializedData['size'];
        $this->color = $unserializedData['color'];
        $this->quantity = $unserializedData['quantity'];
    }
}
