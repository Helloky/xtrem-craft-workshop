<?php

namespace Tests\MoneyProblem;

use MoneyProblem\Domain\Bank;
use MoneyProblem\Domain\Portfolio;
use PHPUnit\Framework\TestCase;

class PortfolioTest extends TestCas
{

    public function test_add_same_currency()
    {
        
        $portfolio = new Portfolio();
        
        $bank = Bank::create();
        
    }

    public function test_add_different_currency()
    {

    }


}


?>