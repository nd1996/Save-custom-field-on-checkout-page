<?php

namespace Nilesh\DropShip\Observer\Sales;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;
use Nilesh\DropShip\Api\SaveDropShipManagementInterface;

/**
 * Class OrderSaveAfter
 *
 * @package Ayakil\OrdersModification\Observer\Sales
 */
class OrderSaveAfter implements ObserverInterface
{
    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return void
     * @throws NoSuchEntityException
     */
    public function execute(
        Observer $observer
    ) {
        /** @var $quote Quote $quote */
        $quote = $observer->getEvent()->getQuote();

        /* @var $order Order */
        $order = $observer->getEvent()->getOrder();

        if ($ndDropShip = $quote->getData(SaveDropShipManagementInterface::DROP_SHIP_ATTR)) {
            $order->setData(SaveDropShipManagementInterface::DROP_SHIP_ATTR, $ndDropShip);
        }
    }
}
