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

namespace Tests\Support;

/**
 * Inherited Methods
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
*/
class UnitTester extends \Codeception\Actor
{
    use _generated\UnitTesterActions;

    public function requireExample(string $name)
    {
        $file = __DIR__ . '/../../examples/' . $name . '.php';
        return (require $file);
    }

    public function requireTemplate(string $name)
    {
        $file = __DIR__ . '/Helper/' . $name . '.php';
        return (require $file);
    }

    public function streamTemplate(\Generator $gen, $callback = null): \Generator
    {
        foreach($gen as $key => $value) {
            $value = $callback($value, key: $key);
            yield $key => $value;
        }
    }
}
