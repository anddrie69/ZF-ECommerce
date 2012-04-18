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
            if (!isset($this->_items[(int)$item->getId()])) {
               $this->_items[(int)$item->getId()] = array(
                    'item' => $item,
                    'count' => $count,
                    'price' => $item->getPrice(),
                );
            }
        }
    }

    /**
     * Удаляет позицию из корзины
     *
     * @param $itemId
     */
    public function remove($itemId)
    {
        if (isset($this->_items[$itemId])) {
            unset ($this->_items[$itemId]);
        }
    }

    /**
     * Обновляет позицию в корзине
     *
     * @param $item
     * @param $count
     */
    public function update($item, $count)
    {
        if ($item instanceof ECommerce_Interface) {
            if (isset($this->_items[(int)$item->getId()])) {
                $this->_items[(int)$item->getId()] = array(
                    'item' => $item,
                    'count' => $count,
                    'price' => $item->getPrice(),
                );
            }
        }
    }

    /**
     * Очищает корзину полностью
     *
     */
    public function clearAll()
    {
        unset ($this->_items);
    }

    /**
     * Возвращает true если корзина пустая
     *
     * @return bool
     */
    public function isEmpty()
    {
        if (!isset($this->_items) || empty($this->_items)) {
            return true;
        }
    }

    /**
     * Возвращает true, если в корине есть объект
     *
     * @param $itemId
     * @return bool
     */
    public function isItem($itemId)
    {
        if (isset($this->_items[$itemId])) {
            return true;
        }
    }

    /**
     * Возвращает количество позиций в объекте
     * (товар * количество)
     *
     * @param $itemId
     */
    public function getItemCount($itemId)
    {
       if (isset($this->_items[$itemId])) {
           return $this->_items[$itemId]['count'];
       }
    }

    /**
     * Возвращает количество позиций во всей
     * корзине для всех объектов
     *
     * @return int
     */
    public function getItemsCount()
    {
        $count = 0;
        foreach ($this->_items as $key) {
            $count += $key['count'];
        }
        return $count;
    }

    /**
     * Возвращает количество элементов
     * в корзине
     *
     * @return int
     */
    public function getCount()
    {
       return count($this->_items);
    }

    /**
     * Возвращает цену товара $item
     *
     * @param $itemId
     * @internal param $item
     * @return mixed
     */
    public function getPrice($itemId)
    {
       if (isset($this->_items[$itemId])) {
           return $this->_items[$itemId]['price'];
       }
    }

    /**
     * Возвращает сумму всей корзины
     *
     *
     * @return int
     */
    public function getAllCost()
    {
        $cost = 0;
        foreach ($this->_items as $key) {
            $cost += $key['price'] * $key['count'];
        }
        return $cost;
    }

    /**
     * Возвращает объект по ключу
     *
     * @param $itemId
     */
    public function getItem($itemId)
    {
        if (isset($this->_items[$itemId])) {
            return $this->_items[$itemId];
        }
    }

    /**
     * Возвращает массив товаров
     *
     * @return array
     */
    public function getItems()
    {
        if (!empty($this->_items)) {
            return $this->_items;
        }
    }

}
