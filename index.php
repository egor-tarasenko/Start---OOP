<?php
class Product {
    public $name;
    public $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }
}

class Order {
    public $number;
    public $products = array();

    public function __construct($number) {
        $this->number = $number;
    }

    public function addProduct($product, $quantity) {
        foreach ($this->products as $item) {
            if ($item['product'] === $product) {
                $item['quantity'] += $quantity;
                return;
            }
        }
        $this->products[] = array('product' => $product, 'quantity' => $quantity);
    }

    public function removeProduct($product) {
        foreach ($this->products as $key => $item) {
            if ($item['product'] === $product) {
                unset($this->products[$key]);
                return;
            }
        }
    }

    public function calculateTotal() {
        $total = 0;
        foreach ($this->products as $item) {
            $total += $item['product']->price * $item['quantity'];
        }
        return $total;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getProducts() {
        return $this->products;
    }
}

$product1 = new Product("Ноутбук", 1200);
$product2 = new Product("Смартфон", 800);
$product3 = new Product("Планшет", 500);

$order1 = new Order(1);
$order2 = new Order(2);

$order1->addProduct($product1, 2);
$order1->addProduct($product2, 1);
$order1->addProduct($product3, 3);

$order2->addProduct($product1, 1);
$order2->addProduct($product2, 2);

$order1->removeProduct($product2);

$order2->addProduct($product2, 1);

echo "Загальна сума замовлення №" . $order1->getNumber() . ":" . $order1->calculateTotal() . "$\n";
echo "Загальна сума замовлення №" . $order2->getNumber() . ":" . $order2->calculateTotal() . "$\n";

?>

