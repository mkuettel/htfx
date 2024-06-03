<?php declare(strict_types=1);
/**
 * This file is part of htfx.
 * htfx is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * htfx is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with Foobar. If not, see <https://www.gnu.org/licenses/>.
 *
 * @author Moritz Küttel
 * @copyright 2024 Moritz Küttel
 */

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
