<?php

namespace MoneyProblem\Domain;

use MyCLabs\Enum\Enum;

/**
 * Class Currency
 * @method static Currency USD()
 * @method static Currency EUR()
 * @method static Currency KRW()
 */
class Currency extends Enum
{
    private const USD = "USD"; // US Dollar
    private const EUR = 'EUR'; // Euro
    private const KRW = "KRW"; // South Korean Won
}
