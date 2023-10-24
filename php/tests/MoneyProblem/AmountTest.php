<?php

namespace Tests\MoneyProblem\Domain;

use MoneyProblem\Domain\Amount;
use MoneyProblem\Domain\Currency;
use PHPUnit\Framework\TestCase;

class AmountTest extends TestCase
{
    // we have to do tests at the next week

    public function test_add_two_amounts()
    {
        $currency = Currency::USD();

        $amount = Amount::create(100, $currency);
        $amountToAdd = Amount::create(100, $currency);

        $newAmount = $amount->add($amountToAdd);

        $this->assertEquals(200, $newAmount->getValue());
        $this->assertEquals('USD', $newAmount->getCurrency());
    }

    public function test_add_two_amounts_with_different_currency()
    {
        $currency = Currency::USD();
        $currency_different = Currency::EUR();

        $amount = Amount::create(100, $currency);
        $amountToAdd = Amount::create(100, $currency_different);

        $this->expectException(\InvalidArgumentException::class);
        $amount->add($amountToAdd);
    }

    public function test_cant_create_negative_amount()
    {
        $currency = Currency::USD();

        $this->expectException(\InvalidArgumentException::class);
        $amountToAdd = Amount::create(-100, $currency);
    }

    public function test_divide()
    {
        $currency = Currency::USD();

        $amount = Amount::create(100, $currency);

        $newAmount = $amount->divide(2);

        $this->assertEquals(50, $newAmount->getValue());
        $this->assertEquals('USD', $newAmount->getCurrency());
    }

    public function test_divide_by_zero()
    {
        $currency = Currency::USD();

        $amount = Amount::create(100, $currency);

        $this->expectException(\InvalidArgumentException::class);
        $amount->divide(0);
    }
}

?>
