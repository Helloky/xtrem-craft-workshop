<?php

namespace Tests\MoneyProblem\Domain;

use MoneyProblem\Domain\Bank;
use MoneyProblem\Domain\Currency;
use MoneyProblem\Domain\MissingExchangeRateException;
use PHPUnit\Framework\TestCase;

class BankTest extends TestCase
{

    //Green test   
    public function test_create_returns_bank()
    {
        $eurCurrency = Currency::EUR();
        $usdCurrency = Currency::USD();
        $rate = 1.2;

        $bank = Bank::create($eurCurrency, $usdCurrency, $rate);

        $this->assertInstanceOf(Bank::class, $bank);
    }


    public function test_convert_eur_to_usd_returns_float()
    {
        $eurCurrency = Currency::EUR();
        $usdCurrency = Currency::USD();
        $rate = 1.2;
        $bank = Bank::create($eurCurrency, $usdCurrency, $rate);
        $initialAmount = 10;

        $convertedAmount = $bank->convert($initialAmount, $eurCurrency, $usdCurrency);

        $this->assertIsFloat($convertedAmount);
    }

    public function test_convert_eur_to_eur_returns_same_value()
    {
        $eurCurrency = Currency::EUR();
        $usdCurrency = Currency::USD();
        $rate = 1.2;
        $bank = Bank::create($eurCurrency, $usdCurrency, $rate);
        $initialAmount = 10;

        $convertedAmount = $bank->convert($initialAmount, $eurCurrency, $eurCurrency);

        $this->assertEquals($initialAmount, $convertedAmount);
    }

    // Red test
    public function test_convert_eur_to_eur_returns_same_value_red()
    {
        $eurCurrency = Currency::EUR();
        $usdCurrency = Currency::USD();
        $rate = 1.2;
        $bank = Bank::create($eurCurrency, $usdCurrency, $rate);
        $initialAmount = 11;

        $convertedAmount = $bank->convert($initialAmount, $eurCurrency, $eurCurrency);

        $this->assertEquals($initialAmount, $convertedAmount);
    }

    public function test_convert_throws_exception_on_missing_exchange_rate()
    {
        $eurCurrency = Currency::EUR();
        $krwCurrency = Currency::KRW();
        $usdCurrency = Currency::USD();
        $rate = 1.2;
        $bank = Bank::create($eurCurrency, $usdCurrency, $rate);
        $exceptedMessage = "$eurCurrency->$krwCurrency";

        $initialAmount = 10;

        $this->expectException(MissingExchangeRateException::class);
        $this->expectExceptionMessage($exceptedMessage);

        $bank->convert($initialAmount, $eurCurrency, $krwCurrency);
    }

    public function test_convert_with_different_exchange_rates_returns_different_floats()
    {
        $eurCurrency = Currency::EUR();
        $usdCurrency = Currency::USD();
        $rate = 1.2;
        $bank = Bank::create($eurCurrency, $usdCurrency, $rate);
        $initialAmount = 10;
        $testAmount = 12;

        $this->assertEquals($testAmount, $bank->convert($initialAmount, $eurCurrency, $usdCurrency));

        $rate = 1.3;
        $testAmount = 13;
        $bank = Bank::create($eurCurrency, $usdCurrency, $rate);

        $this->assertEquals($testAmount, $bank->convert($initialAmount, $eurCurrency, $usdCurrency));
    }

    public function test_convert_between_currencies()
    {
        $exchangeRates = [
            'USD->EUR' => 0.9,
            'EUR->JPY' => 120,
        ];

        $bank = new Bank($exchangeRates);

        // Convert 100 USD to EUR
        $resultEUR = $bank->convert(100, Currency::USD(), Currency::EUR());
        $this->assertEquals(90, $resultEUR);

    }

    public function test_convert_with_missing_exchange_rate()
    {
        $exchangeRates = [
            'USD->EUR' => 0.9,
        ];

        $bank = new Bank($exchangeRates);

        // Try to convert from USD to JPY, which should throw an exception
        $this->expectException(MissingExchangeRateException::class);
        $bank->convert(100, Currency::USD(), Currency::JPY());
    }
}
