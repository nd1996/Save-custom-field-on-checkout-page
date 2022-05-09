<?php
/**
 * Copyright © Nilesh Dubey All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Nilesh\DropShip\Api;

interface SaveDropShipManagementInterface
{

    public const DROP_SHIP_ATTR = "drop_ship";

    /**
     * POST for saveDropShip api
     * @param string|int $cartId
     * @param string|int $dropShip
     * @return mixed
     */
    public function postSaveDropShip($cartId, $dropShip);
}
