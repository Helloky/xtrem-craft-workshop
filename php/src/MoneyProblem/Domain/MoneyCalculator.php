<?php

namespace MoneyProblem\Domain;

class MoneyCalculator
{
    /**
     * add two amounts
     * @param float $amount
     * @param Currency $currency
     * @param float $amount2
     * @return float
     */
    public static function add(float $amount, Currency $currency, float $amount2): float
    {
        return $amount + $amount2;
    }

    /*
        * subtract two amounts
        * @param float $amount
        * @param Currency $currency
        * @param float $amount2
        * @return float
        */
    public static function times(float $amount, Currency $currency, int $value): float
    {
        return $amount * $value;
    }

    /*
    * divide two amounts
    * @param float $amount
    * @param Currency $currency
    * @return float
    */
    public static function divide(float $amount, Currency $currency, int $value): float
    {
        return $amount / $value;
    }
}
