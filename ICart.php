<?php
/**
 * User: The Who
 * Date: 17.04.12
 * Time: 13:59
 */
interface ECommerce_ICart
{
    /**
     * Добавляет позицию в корзину
     *
     * @abstract
     * @param $item
     * @param $count
     */
    public function add($item, $count);

    /**
     * Удаляет позицию из корзины
     *
     * @abstract
     * @param $item
     */
    public function remove($item);

    /**
     * Обновляет позицию в корзине
     *
     * @abstract
     * @param $item
     * @param $count
     */
    public function update($item, $count);

    /**
     * Очищает корзину полностью
     *
     * @abstract
     */
    public function clearAll();

    /**
     * Возвращает true если корзина пустая
     *
     * @abstract
     *
     */
    public function isEmpty();

    /**
     * Проверка, есть ли в корзине объект
     *
     * @abstract
     * @param $item
     */
    public function isItem($item);

    /**
     * Возвращает все позиции в корзине
     * (товар * количество)
     *
     * @abstract
     *
     */
    public function getItemsCount();

    /**
     * Возвращает количество элементов
     * в корзине
     *
     * @abstract
     *
     */
    public function getCount();

    /**
     * Возвращает цену товара $item
     *
     * @abstract
     * @param $item
     */
    public function getPrice($item);

    /**
     * Возвращает сумму всей корзины
     *
     * @abstract
     *
     */
    public function getAllCost();

    /**
     * Возвращает объект по ключу
     *
     * @abstract
     * @param $item
     */
    public function getItem($item);

    /**
     * Возвращает массив объектов из корзины
     *
     * @abstract
     *
     */
    public function getItems();
}
