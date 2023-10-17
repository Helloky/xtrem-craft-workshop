<?php

namespace MoneyProblem\Domain;

class Portfolio
{
    private $amounts = [];

    /**
     * @param float $amount
     * @param Currency $currency
     * @param Bank $bank
     * @return void
     */
    public function add(float $amount, Currency $currency)
    {
        $this->amounts[] = [
            'amount' => $amount,
            'currency' => $currency,
        ];
    }

    /**
     * @param Currency $currency
     * @return float
     */
    public function total(Currency $currency, Bank $bank)
    {
        $total = 0;
        foreach ($this->amounts as $amount) {
            $total += $bank->convert($amount['amount'], $amount['currency'], $currency);
        }
        return $total;
    }

}

?>