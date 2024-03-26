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
    public $items = [];

    public function __construct($number) {
        $this->number = $number;
    }

    public function addItem(OrderItem $item) {
        $this->items[] = $item;
    }

    public function removeItem(OrderItem $itemToRemove) {
        foreach ($this->items as $key => $item) {
            if ($item === $itemToRemove) {
                unset($this->items[$key]);
                return;
            }
        }
    }

    public function calculateTotal(): int {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item->getTotal();
        }
        return $total;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getItems() {
        return $this->items;
    }
}

class OrderItem {
    public $product;
    public $quantity;

    public function __construct($product, $quantity) {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getTotal() {
        return $this->product->price * $this->quantity;
    }
}

$product1 = new Product("Ноутбук", 2200.0);
$product2 = new Product("Смартфон", 800.0);
$product3 = new Product("Планшет", 500.0);

$order1 = new Order(1);
$order2 = new Order(2);

$order1->addItem(new OrderItem($product1, 2));
$order1->addItem(new OrderItem($product2, 1));
$order1->addItem(new OrderItem($product3, 3));

$order2->addItem(new OrderItem($product1, 1));
$order2->addItem(new OrderItem($product2, 2));

$order1->removeItem($order1->items[1]);

$order2->addItem(new OrderItem($product2, 1));

echo "Загальна сума замовлення №" . $order1->getNumber() . ": $" . $order1->calculateTotal() . "\n";
echo "Загальна сума замовлення №" . $order2->getNumber() . ": $" . $order2->calculateTotal() . "\n";


?>

