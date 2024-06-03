<?php


namespace Tests\Unit;

use PHPUnit\Framework\Assert;
use Tests\Support\UnitTester;
use function PHPUnit\Framework\isInstanceOf;

class PreludeHtml5PartialCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests
    public function tryToTest(UnitTester $I)
    {
        $html5 = $I->requireTemplate('simple_prelude_html5');
        Assert::assertInstanceOf(\Generator::class, $html5);
    }
}
