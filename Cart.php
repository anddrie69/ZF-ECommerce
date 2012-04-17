<?php
/**
 * User: The Who
 * Date: 17.04.12
 * Time: 13:57
 */
class ECommerce_Cart implements ECommerce_ICart
{
    private $_items = array();

    static $_instance = null;

    private function __construct() {}

    public function __clone(){}

    static  function getInstance()
    {
        if (null == self::$_instance) {
            self::$_instance = new ECommerce_Cart();
        }
        return self::$_instance;
    }

    /**
     * Добавляет позицию в корзину
     *
     * @param $item
     * @param $count
     */
    public function add($item, $count = 1)
    {
        if ($item instanceof ECommerce_Interface) {
            if (!isset($this->_items[$item->getId()])) {
               $this->_items[$item->getId()] = array(
                    'item' => $item,
                    'count' => $count,
                );
            }
        }
    }

    /**
     * Удаляет позицию из корзины
     *
     * @param $item
     */
    public function remove($item)
    {
        // TODO: Implement remove() method.
    }

    /**
     * Обновляет позицию в корзине
     *
     * @param $item
     * @param $count
     */
    public function update($item, $count)
    {
        // TODO: Implement update() method.
    }

    /**
     * Очищает корзину полностью
     *
     */
    public function clearAll()
    {
        // TODO: Implement clearAll() method.
    }

    /**
     * Возвращает true если корзина пустая
     *
     *
     */
    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
    }

    /**
     * Проверка, есть ли в корзине объект
     *
     * @param $item
     */
    public function isItem($item)
    {
        // TODO: Implement isItem() method.
    }

    /**
     * Возвращает все позиции в корзине
     * (товар * количество)
     *
     *
     */
    public function getItemsCount()
    {
        // TODO: Implement getItemsCount() method.
    }

    /**
     * Возвращает количество элементов
     * в корзине
     *
     *
     */
    public function getCount()
    {
        // TODO: Implement getCount() method.
    }

    /**
     * Возвращает цену товара $item
     *
     * @param $item
     */
    public function getPrice($item)
    {
        // TODO: Implement getPrice() method.
    }

    /**
     * Возвращает сумму всей корзины
     *
     *
     */
    public function getAllCost()
    {
        // TODO: Implement getAllCost() method.
    }

    /**
     * Возвращает объект по ключу
     *
     * @param $item
     */
    public function getItem($item)
    {
        // TODO: Implement getItem() method.
    }

    /**
     * Возвращает массив товаров
     *
     * @return array
     */
    public function getItems()
    {
        return $this->_items;
    }
}
