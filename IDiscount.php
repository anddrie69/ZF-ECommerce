<?php
/**
 * User: The Who
 * Date: 19.04.12
 * Time: 4:40
 */
interface ECommerce_IDiscount
{
    /**
     * Метод применяет скидку для товара(-ов)
     *
     * @abstract
     * @param null $itemId
     */
    public function setDiscount($itemId = null);

    /**
     * В методе описывается реализация скидки
     * для товаров(-а)
     *
     * @abstract
     *
     */
    public function discount();

}
