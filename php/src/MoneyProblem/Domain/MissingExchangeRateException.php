<?php

namespace MoneyProblem\Domain;

class MissingExchangeRateException extends \Exception
{

    /**
     * MissingExchangeRateException constructor.
     * @param Currency $firstCurrency
     * @param Currency $otherCurrency
     */
    public function __construct(Currency $firstCurrency, Currency $otherCurrency)
    {
        parent::__construct(sprintf('%s->%s', $firstCurrency, $otherCurrency));
    }
}
