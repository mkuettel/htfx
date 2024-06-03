<?php  declare(strict_types=1);
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

namespace htfx;

// just load all function, this way no more
// problems with autoloading, but just remmebering
// putting the released files here
foreach([
//    'attributes.php',
//    'error.php',
    'htnode.php',
//    'rawhtmlnode.php',
//    'textnode.php',
    'prelude/html5.php',
//    'prelude/htmx.php',
//    'prelude/json.php',
//    'prelude/restrictedhtml.php',
//    'prelude/seohtml5.php',
//    'prelude/xml.php',
] as $f) require_once __DIR__ . '/' . $f;


class config {


}

class HTFX
{
    public function __invoke()
    {
    }
}



/**
 * @author Moritz Küttel
 */
function htfx($config = null): HTFX {
    $config ??= config('htfx');

    return new HTFX($config);
}


function rawhtml(string ...$unsafe_html): \Generator {
    yield from $unsafe_html;
}


function printer(\Generator $printableGenerator): void {
    foreach($printableGenerator as $html) {
        print(lazy_string($html));
    }
}


function ob_buffer(\Generator $printableGenerator): string {
    ob_start(/* fn() => printer($printableGenerator) */);
    printer($printableGenerator);
    return ob_end_clean();
}

function lazy_string($stringable): ?string {
    /** @var \Generator|null|int|string|float|double|iterable|$stringable */
    return match (true) { // ignore null values, has contents might just be null if no arguments where given{
        is_bool($stringable) => $stringable,
        is_scalar($stringable) => (string)$stringable,
        is_float($stringable) => number_format(),
        is_null($stringable) => "<!--null-->",
        $stringable instanceof \Fiber => $stringable(),
        $stringable instanceof \Generator => printer($stringable),
        $stringable instanceof htnode => $stringable,
        is_iterable($stringable) => array_map('htfx\lazy_string', $stringable),
//        is_array($stringable) => array_map('htfx\lazy_string', $stringable),
        is_callable($stringable) => lazy_string($stringable()),
        $stringable instanceof \Stringable => $stringable->__toString(),
        default => log_message(),
    };
}

function buffer(\Generator $printableGenerator): string {
    ob_start(/* fn() => printer($printableGenerator) */);
    printer($printableGenerator);
    return ob_end_clean();
}

function convert_to_string_tokens(\Generator $printableGenerator) {
    foreach($printableGenerator as $printable) {
        match(true) {
            is_array($printable) => yield from array_map('htfx\lazy_string', array_map('htfx\convert_to_string_tokens', $printable)),
            default => yield $printable,
        };
    }
}

function render(htnode $node) {
    return printer($node->generate());
}

function register(callable $resolver, string ...$key) {
    return fn(string ...$key) => $resolver(...$key);
}

function inject(string ...$key): \Fiber {
    new \Fiber(fn() => lazy_string(\Fiber::suspend(['htfx_inject', $key])));
}

function htfx_tag(string $tag_name, ...$attrs): htnode {
    return htnode::new($tag_name, $attrs);
}


function view(string $tmpl): callable {
    return static fn(... $view_args): htnode => (require $tmpl);
}