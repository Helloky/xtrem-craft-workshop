<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Bank;
use MoneyProblem\Domain\Portfolio;
use PHPUnit\Framework\TestCase;
use MoneyProblem\Domain\Currency;
use MoneyProblem\Domain\MoneyCalculator;

class PortfolioTest extends TestCase
{

    public function test_add_same_currency()
    {
        
        $portfolio = new Portfolio();
        
        $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);

        $portfolio->add(10, Currency::EUR());

        $amountTest = 10;

        $this->assertEquals($amountTest, $portfolio->total(Currency::EUR(), $bank));
        
    }

    public function test_add_different_currency()
    {
            
            $portfolio = new Portfolio();
            
            $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);

            $bank->addEchangeRate(Currency::USD(), Currency::EUR(), 0.8);
    
            $portfolio->add(10, Currency::EUR());
    
            $portfolio->add(10, Currency::USD());
    
            $amountTest = 18;

            $this->assertEquals($amountTest, $portfolio->total(Currency::EUR(), $bank));
        
    }

    public function test_add_different_currency_red()
    {
            
            $portfolio = new Portfolio();
            
            $bank = Bank::create(Currency::EUR(), Currency::USD(), 1.2);

            $bank->addEchangeRate(Currency::USD(), Currency::EUR(), 0.8);
    
            $portfolio->add(10, Currency::EUR());
    
            $portfolio->add(10, Currency::USD());
    
            $amountTest = 19;

            $this->assertEquals($amountTest, $portfolio->total(Currency::EUR(), $bank));
        
    }


}


?>