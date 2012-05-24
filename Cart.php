<?php
/**
 * User: The Who
 * Date: 17.04.12
 * Time: 13:57
 */
class ECommerce_Cart implements ECommerce_ICart, ECommerce_IDiscount
{
    /**
     * Массив всех объектов из корзины
     *
     * @var array
     */
    static private $_items = array();
    /**
     * Скидка в процентах от стоимости
     *
     * @var null
     */
    private $_discount = null;

    /**
     * @var null
     */
    static private $_instance = null;

    private function __construct() {}

    public function __clone(){}

    static  function getInstance()
    {
        if (null == self::$_instance) {
            self::$_instance = new ECommerce_Cart();
        }
        self::_sessionRestore();
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
            if (!isset(self::$_items[(int)$item->getId()])) {
                self::$_items[(int)$item->getId()] = array(
                    'item' => $item,
                    'count' => (int)$count,
                    'price' => $item->getPrice(),
                );
            }
        }
        self::_sessionAdd();
    }

    /**
     * Удаляет позицию из корзины
     *
     * @param $itemId
     */
    public function remove($itemId)
    {
        if (isset(self::$_items[(int)$itemId])) {
            unset (self::$_items[(int)$itemId]);
        }
        self::_sessionAdd();
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
            if (isset(self::$_items[(int)$item->getId()])) {
                self::$_items[(int)$item->getId()] = array(
                    'item' => $item,
                    'count' => (int)$count,
                    'price' => $item->getPrice(),
                );
                self::_sessionAdd();
            }
        }
    }

    /**
     * Обновляет количество для определеной
     * позиции в корзине
     *
     * @param $itemId
     * @param $count
     */
    public function updateCount($itemId, $count)
    {
        if (isset(self::$_items[(int)$itemId])) {
            self::$_items[(int)$itemId]['count'] =(int)$count;
            self::_sessionAdd();
        }
    }

    /**
     * Очищает корзину полностью
     *
     */
    public function clearAll()
    {
        if (!empty(self::$_items)) {
            self::$_items = null;
        }
        self::_sessionClear();
    }

    /**
     * Возвращает true если корзина пустая
     *
     * @return bool
     */
    public function isEmpty()
    {
        if (!isset(self::$_items) || empty(self::$_items)) {
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
        if (isset(self::$_items[(int)$itemId])) {
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
        if (isset(self::$_items[(int)$itemId])) {
            return self::$_items[(int)$itemId]['count'];
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
        foreach (self::$_items as $key) {
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
        return count(self::$_items);
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
        if (isset(self::$_items[(int)$itemId])) {
            return self::$_items[(int)$itemId]['price'];
        }
    }

    /**
     * Возвращает сумму всей корзины
     *
     * @return int
     */
    public function getAllCost()
    {
        $cost = 0;
        foreach (self::$_items as $key) {
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
        if (isset(self::$_items[(int)$itemId])) {
            return self::$_items[(int)$itemId];
        }
    }

    /**
     * Возвращает массив товаров
     *
     * @return array
     */
    public function getItems()
    {
        if (!empty(self::$_items)) {
            return self::$_items;
        }
    }

    /**
     * Задает скидку в процентах
     *
     * @param $discountPercent
     * @internal param $percent
     */
    public function setDiscount($discountPercent)
    {
        $this->_discount = $discountPercent;
    }

    /**
     * Метод применяет скидку для товара(-ов)
     *
     * @param null $itemId
     */
    public function getDiscount($itemId = null)
    {
        if (null === $itemId) {
            foreach (self::$_items as $key) {
                self::$_items[$key['item']->getId()]['price']
                    -= $this->_discount($key['price']);
            }
        }
        else {
            self::$_items[$itemId]['price']
                -= $this->_discount(self::$_items[$itemId]['price']);
        }
    }

    /**
     * В методе описывается реализация скидки
     * для товаров(-а)
     *
     * @param $price
     * @return float
     */
    protected function _discount($price)
    {
        if (isset($this->_discount)) {
            /* Скидка в процентах от стоимости товара */
            return $price / 100 * $this->_discount;
        }
        else {
            /*
             * Это свободная реализация системы скидок.
             * Перегрузите метод или задайте собственный
             * алгоритм вычисления скидки для товара
             */
            return $price / 100 * 1;
        }
    }

    /**
     * Добавляет в регистр массив
     * объектов корзины
     *
     * @static
     *
     */
    static private function _sessionAdd()
    {
        $cartSession = new Zend_Session_Namespace('Cart');
        $cartSession->_items = self::$_items;
    }

    /**
     * Очищает сессию от данных
     *
     * @static
     *
     */
    static private function _sessionClear()
    {
        $cartSession = new Zend_Session_Namespace('Cart');
        $cartSession->unsetAll();
    }

    /**
     * Восстанавливает из регистра
     * массив объектов корзины
     *
     * @static
     *
     */
    static private function _sessionRestore()
    {
        $cartSession = new Zend_Session_Namespace('Cart');
        if (isset($cartSession->_items)) {
            self::$_items = $cartSession->_items;
        }
    }
}