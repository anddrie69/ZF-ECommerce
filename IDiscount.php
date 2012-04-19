<?php
/**
 * User: The Who
 * Date: 19.04.12
 * Time: 4:40
 */
interface ECommerce_IDiscount
{
    /**
     * Задает скидку в процентах
     *
     * @abstract
     * @param $discountPercent
     * @internal param $percent
     */
    public function setDiscount($discountPercent);

    /**
     * Метод применяет скидку для товара(-ов)
     *
     * @abstract
     * @param null $itemId
     */
    public function getDiscount($itemId = null);
}
