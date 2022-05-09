<?php
/**
 * Copyright © Nilesh Dubey All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nilesh\DropShip\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Nilesh\DropShip\Api\SaveDropShipManagementInterface;

class SaveDropShipManagement implements \Nilesh\DropShip\Api\SaveDropShipManagementInterface
{

    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository

    ) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * {@inheritdoc}
     * @throws CouldNotSaveException|NoSuchEntityException
     */
    public function postSaveDropShip($cartId, $dropShip)
    {
        $quote = $this->quoteRepository->getActive($cartId);
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }

        try {
            $quote->setData(SaveDropShipManagementInterface::DROP_SHIP_ATTR, (int) strip_tags($dropShip));
            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('The order comment could not be saved'));
        }

        return $cartId."-".$dropShip;
    }
}
