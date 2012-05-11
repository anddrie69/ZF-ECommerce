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
    public function add($item, $count = 1);

    /**
     * Удаляет позицию из корзины
     *
     * @abstract
     * @param $itemId
     */
    public function remove($itemId);

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
     * @param $itemId
     */
    public function isItem($itemId);

    /**
     * Возвращает все позиции в корзине
     * (товар * количество)
     *
     * @abstract
     * @param $itemId
     */
    public function getItemCount($itemId);

    /**
     * Возвращает количество позиций во всей
     * корзине для всех объектов
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
     * @param $itemId
     * @internal param $item
     */
    public function getPrice($itemId);

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
     * @param $itemId
     */
    public function getItem($itemId);

    /**
     * Возвращает массив объектов из корзины
     *
     * @abstract
     *
     */
    public function getItems();
}
