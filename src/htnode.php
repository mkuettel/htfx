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

namespace htfx;

use \htfx\error;
use function htfx\prelude\html5\html5;

class htnode {

    public const SELF_CLOSING_TAG = false;

    public static function new(string $name, array $attrs, array $contents = []): self {
        if (!empty($attrs) && array_is_list($attrs)) {
            // error::forInvalidAttributes($attrs); // TODO fix this
            throw new \TypeError("Attributes for '$name' must be array not a simple list: " . var_export($attrs, true));
        }
        return new htnode($name, $attrs, $contents);
    }

    protected function __construct(
        public readonly string $name,
        public readonly array $attrs,
        private array $contents = [],
    ) {
    }

    public function add(htnode $content) {
        $this->contents[] = $content;
    }

    public function attrs(): array {
        return $this->attrs;
    }

    public function contents(): iterable|\Generator
    {
        return $this->contents;
    }
    public function hasContents(): bool {
        return !empty($this->contents);
    }

    public function generate($compress = false): \Generator {
        $indentLevel = 1;

        yield from ['<', $this->name];



        foreach ($this->attrs() as $attribute => $value) {
            if (!$compress) {
                yield "\n";
            }
            yield ' ';
            yield from $this->renderAttribute($attribute);
            if ($this->hasAttributeValue($attribute)) {
                yield '="'; yield from $this->renderAttributeValue($attribute, $value); yield '"';
            }
        }

        if ($this->hasContents() && !static::SELF_CLOSING_TAG) {
            if (!$compress) {
                yield "\n";
            }
            yield '>'; // TODO: this is html5 specific
            if (!$compress) {
                yield "\n";
                yield str_repeat("\t", $indentLevel);
            }
            foreach ($this->renderContents() as $content) {
                if (!$compress) {
                    // yield str_repeat("\t", $indentLevel);
                }

                yield $content;
            }
            if (!$compress) {
                yield "\n";
            }
            yield from ['</', $this->name, '>'];
        } else {
            yield ' />';
        }
        if (!$compress) {
            yield "\n";
        }
    }

    protected function resolveValue($value): string {
        return match (true) {
            $value => lazy_string($value),
            default => error::forUnhandledType($value),
        };
    }

    protected function renderAttribute($name): \Generator
    {
//        yield htmlentities($name, ENT_HTML5 | ENT_QUOTES);
        yield htmlentities(lazy_string($name), ENT_DISALLOWED | ENT_HTML5 | ENT_QUOTES);
    }

    protected function renderAttributeValue(string $name, $value): \Generator
    {
        if (is_array($value)) {
            yield from array_map(fn($value) => $this->renderAttributeValue($name, lazy_string($value)), $value);
        } else if (is_null($value)) {
            yield '';
        } else {
            yield htmlentities(lazy_string($value), ENT_HTML5);
        }
    }

    public function hasAttributeValue(string|int $name): bool {
        return !is_null($name) && !is_int($name);
    }

    protected function renderContents(): \Generator
    {
        foreach ($this->contents() as $content) {
            match(true) {
                $content instanceof htnode => yield from $content->generate(),
                is_scalar($content) => yield htmlentities($content),
                default => htfx\errors::forUnhandledType($content),
            };
        }
    }

    public function __invoke(htnode|string|\Generator|callable|null ...$contents): htnode
    {
        $this->contents = $contents;
        return $this;
    }
}
