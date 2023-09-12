<?php

namespace MoneyProblem\Domain;

use function array_key_exists;

class Bank
{
    /** @var array */
    private $exchangeRates = [];

    /**
     * Bank constructor.
     * @param array $exchangeRates
     */
    public function __construct(array $exchangeRates = [])
    {
        $this->exchangeRates = $exchangeRates;
    }

    /**
     * create a bank with one exchange rate
     * @param Currency $currency1
     * @param Currency $currency2
     * @param float $rate
     * @return Bank
     */
    public static function create(Currency $currency1, Currency $currency2, float $rate)
    {
        $bank = new Bank([]);
        $bank->addEchangeRate($currency1, $currency2, $rate);

        return $bank;
    }

    /**
     * add an exchange rate to the bank
     * @param Currency $currency1
     * @param Currency $currency2
     * @param float $rate
     * @return void
     */
    public function addEchangeRate(Currency $currency1, Currency $currency2, float $rate): void
    {
        $this->exchangeRates[($currency1 . '->' . $currency2)] = $rate;
    }

    /**
     * convert an amount from a currency to another
     * @param float $amount
     * @param Currency $currency1
     * @param Currency $currency2
     * @return float
     * @throws MissingExchangeRateException
     */
    public function convert(float $amount, Currency $currency1, Currency $currency2): float
    {
        if (!($currency1 == $currency2 || array_key_exists($currency1 . '->' . $currency2, $this->exchangeRates))) {
            throw new MissingExchangeRateException($currency1, $currency2);
        }
        return $currency1 == $currency2
            ? $amount
            : $amount * $this->exchangeRates[($currency1 . '->' . $currency2)];
    }
}
