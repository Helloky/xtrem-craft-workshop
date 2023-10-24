<?php

namespace MoneyProblem\Domain;

use MoneyProblem\Domain\Currency;
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
        $money1 = Money::create($amount, $currency1);
        return $this->convertMoney($money1, $currency2, $amount);
    }

    public function convertMoney(Money $money, Currency $to, float $amount): float{


        if (!($this->canConvert($money, $to))) {
            throw new MissingExchangeRateException($money->getCurrency(), $to);
        }


        return $money->getCurrency() == $to
            ? $amount
            : $amount * $this->exchangeRates[($money->getCurrency() . '->' . $to)];
    }

    public function canConvert(Money $money, Currency $to){
        return $money->getCurrency() == $to || array_key_exists($money->getCurrency() . '->' . $to, $this->exchangeRates);
    }

    


}

