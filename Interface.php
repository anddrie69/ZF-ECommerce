<?php
/**
 * User: The Who
 * Date: 17.04.12
 * Time: 15:35
 */
interface ECommerce_Interface
{
    /**
     * Возвращает ID товара из БД
     *
     * @abstract
     *
     */
    public function getId();

    /**
     * Возвращает стоимость товара из БД
     *
     * @abstract
     *
     */
    public function getPrice();
}
