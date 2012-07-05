<?php
/**
 * User: TheWho
 * Date: 29.06.12
 * Time: 11:10
 */
class ECommerce_Adapter_Session implements ECommerce_Adapter_Interface
{

    public function add($_items)
    {
        $cartSession = new Zend_Session_Namespace('Cart');
        $cartSession->_items = $_items;
    }

    public function clear()
    {
        $cartSession = new Zend_Session_Namespace('Cart');
        $cartSession->unsetAll();
    }

    public function restore()
    {
        $cartSession = new Zend_Session_Namespace('Cart');
        if (isset($cartSession->_items)) {
            return $cartSession->_items;
        }
    }
}
