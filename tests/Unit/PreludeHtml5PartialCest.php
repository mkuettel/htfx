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
    public function testGenerates(UnitTester $I)
    {
        $html5 = $I->requireTemplate('simple_prelude_html5');
        Assert::assertInstanceOf(\Generator::class, $html5);
    }


    public function testDoctype(UnitTester $I)
    {
        $html5 = $I->requireTemplate('simple_prelude_html5');
        Assert::assertStringContainsStringIgnoringCase("<!doctype html>", $html5->current());
    }
}
