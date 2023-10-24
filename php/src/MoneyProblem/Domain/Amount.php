<?php

namespace MoneyProblem\Domain;

class Amount
{
    private float $value;
    private Currency $currency;

    private function __construct(float $value, Currency $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    public static function create(float $value, Currency $currency): Amount
    {
        if($value < 0) throw new \InvalidArgumentException("peut pas avoir de valeur negative");
        return new Amount($value, $currency);
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

        return $this->create($newValue, $this->currency);
    }

    public function times(int $value): Amount
    {
        $newValue = $this->value * $value;

        return $this->create($newValue, $this->currency);
    }

    public function divide(int $value): Amount
    {

        if ($value === 0) {
            throw new \InvalidArgumentException("peut pas diviser par 0");
        } else {
            $newValue = $this->value / $value;
        }

        return $this->create($newValue, $this->currency);
    }

}

?>

