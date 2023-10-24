<?php

namespace MoneyProblem\Domain;

class Amount
{
    private float $value;
    private Currency $currency;

    public function __construct(float $value, Currency $currency)
    {
        if($value < 0) throw new \InvalidArgumentException("peut pas avoir de valeur negative");
        $this->value = $value;
        $this->currency = $currency;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function add(Amount $amountToAdd): Amount
    {
        if ($amountToAdd === null) {
            throw new \InvalidArgumentException("peut pas rien ajouter");
        } elseif ($amountToAdd->getValue() < 0) {
            throw new \InvalidArgumentException("peut pas ajouter un montant negatif");
        } elseif ($this->currency !== $amountToAdd->getCurrency()) {
            throw new \InvalidArgumentException("doivent avoir la mm devise");
        }

        $newValue = $this->value + $amountToAdd->getValue();

        return new Amount($newValue, $this->currency);
    }

    public function times(int $value): Amount
    {
        $newValue = $this->value * $value;

        return new Amount($newValue, $this->currency);
    }

    public function divide(int $value): Amount
    {

        if ($value === 0) {
            throw new \InvalidArgumentException("peut pas diviser par 0");
        } else {
            $newValue = $this->value / $value;
        }

        return new Amount($newValue, $this->currency);
    }

}

?>

