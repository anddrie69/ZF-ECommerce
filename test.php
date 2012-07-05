<?php
/**
 * User: TheWho
 * Date: 29.06.12
 * Time: 10:59
 */
require_once 'ICart.php';
require_once 'IAdapter.php';
require_once 'Interface.php';
require_once 'IDiscount.php';
require_once 'Session_Adapter.php';
require_once 'Cart.php';

    class Application_Model_Book implements ECommerce_Interface
    {
        private $_id = null;

        public function __construct($id = null)
        {
            $this->_id = $id;
        }

        public function info()
        {
            return "Good Book";
        }

        public function getId()
        {
            /* Возвращаем id из БД.
            * (Здесь для примера id передаем
            * через конструктор)
            */
            return $this->_id;
        }

        public function getPrice()
        {
            /* Возвращаем price из БД.
            * (price для примера берется как id * 10)
            */
            return $this->_id * 10;
        }
    }

$book1 = new Application_Model_Book(1);
$book2 = new Application_Model_Book(2);
$book3 = new Application_Model_Book(3);

$cart = ECommerce_Cart::getInstance(new Ecommerce_Zend_Session_Adapter());

$cart->add($book1, 2);
$cart->add($book2, 3);
$cart->add($book3, 4);

$items = $cart->getItems();

print_r($items);





