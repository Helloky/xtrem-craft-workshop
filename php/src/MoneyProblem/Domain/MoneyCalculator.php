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
    public static function add(float $amount, float $amountToAdd): float
    {
        return $amount + $amountToAdd;
    }

    /*
        * subtract two amounts
        * @param float $amount
        * @param Currency $currency
        * @param float $amount2
        * @return float
        */
    public static function times(float $amount, int $value): float
    {
        return $amount * $value;
    }

    /*
    * divide two amounts
    * @param float $amount
    * @param Currency $currency
    * @return float
    */
    public static function divide(float $amount, int $value): float
    {
        return $amount / $value;
    }
}
