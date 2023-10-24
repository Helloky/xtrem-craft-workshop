<?php

namespace MoneyProblem\Domain;

class Portfolio
{
    private $amounts = [];

    public function add(float $amount, Currency $currency)
    {
        $this->amounts[] = compact('amount', 'currency');
    }

    public function total(Currency $targetCurrency, Bank $bank)
    {
        $total = 0;

        foreach ($this->amounts as $amount) {
            $total += $this->convertAmount($amount['amount'], $amount['currency'], $targetCurrency, $bank);
        }

        return $total;
    }

    private function convertAmount(float $amount, Currency $fromCurrency, Currency $toCurrency, Bank $bank): float
    {
        return $bank->convert($amount, $fromCurrency, $toCurrency);
    }
}


?>