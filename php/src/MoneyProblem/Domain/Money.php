<?php

namespace MoneyProblem\Domain;

class Money
{
    /**
     * Summary of value
     * @var float
     */
    private float $value;
    /**
     * Summary of currency
     * @var Currency
     */
    private Currency $currency;

    /**
     * Summary of __construct
     * @param float $value
     * @param \MoneyProblem\Domain\Currency $currency
     */
    private function __construct(float $value, Currency $currency)
    {
        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * Summary of create
     * @param float $value
     * @param \MoneyProblem\Domain\Currency $currency
     * @throws \InvalidArgumentException
     * @return \MoneyProblem\Domain\Money
     */
    public static function create(float $value, Currency $currency): Money
    {
        if($value < 0) throw new \InvalidArgumentException("peut pas avoir de valeur negative");
        return new Money($value, $currency);
    }

    /**
     * Summary of getValue
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Summary of getCurrency
     * @return \MoneyProblem\Domain\Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    /**
     * Summary of add
     * @param \MoneyProblem\Domain\Money $amountToAdd
     * @throws \InvalidArgumentException
     * @return \MoneyProblem\Domain\Money
     */
    public function add(Money $amountToAdd): Money
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

    /**
     * Summary of times
     * @param int $value
     * @return \MoneyProblem\Domain\Money
     */
    public function times(int $value): Money
    {
        $newValue = $this->value * $value;

        return $this->create($newValue, $this->currency);
    }

    /**
     * Summary of divide
     * @param int $value
     * @throws \InvalidArgumentException
     * @return \MoneyProblem\Domain\Money
     */
    public function divide(int $value): Money
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

