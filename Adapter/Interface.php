<?php
/**
 * User: The Who
 * Date: 17.04.12
 * Time: 13:59
 */
interface ECommerce_Adapter_Interface
{
    /**
     * Добавление массива в хранилище
     *
     * @abstract
     * @param $_items
     * @return mixed
     */
    public function add($_items);

    /**
     * Очистка хранилища от массива корзины
     *
     * @abstract
     * @return mixed
     */
    public function clear();

    /**
     * Восстановление массива из хранилища
     * (Сессии, БД и прочие)
     *
     * @abstract
     * @return mixed
     */
    public function restore();

}
