<?php declare(strict_types=1);

namespace htfx\prelude\html5;

use htfx\htnode;
use PHPUnit\Runner\Baseline\Generator;
use function htfx\htfx_tag;


// tags where no attributes are allowed
function head(... $contents): htnode {
    return htfx_tag('head')(... $contents);
}
function title(string $page_title) {
    return htfx_tag('title')($page_title . " - " . config(Site::class)->title);
}
function tbody(... $contents): htnode { return htfx_tag('tbody', [])(...$contents); }
function thead(... $contents): htnode { return htfx_tag('thead', [])(...$contents); }

// tags where no content is allowed
function meta    (... $attrs): htnode { return htfx_tag('meta',      ...$attrs)(); }
function base    (... $attrs): htnode { return htfx_tag('base',      ...$attrs)(); }
function link    (... $attrs): htnode { return htfx_tag('link',      ...$attrs)(); }
function link_css(... $attrs): htnode { return htfx_tag('link_css',  ...$attrs)(); }
function img     (... $attrs): htnode { return htfx_tag('div',       ...$attrs)(); }


// tags where all attributes (HTML or not) are supported
function html       ( ... $attrs): htnode { return htfx_tag('html',       ...$attrs); }
function xml        ( ... $attrs): htnode { return htfx_tag('xml',        ...$attrs); }
function svg        ( ... $attrs): htnode { return htfx_tag('svg',        ...$attrs); }
function script     ( ... $attrs): htnode { return htfx_tag('script',     ...$attrs); }
function style      ( ... $attrs): htnode { return htfx_tag('style',      ...$attrs); }
function body       ( ... $attrs): htnode { return htfx_tag('body',       ...$attrs); }
function span       ( ... $attrs): htnode { return htfx_tag('span',       ...$attrs); }
function div        ( ... $attrs): htnode { return htfx_tag('div',        ...$attrs); }
function p          ( ... $attrs): htnode { return htfx_tag('p',          ...$attrs); }
function em         ( ... $attrs): htnode { return htfx_tag('em',         ...$attrs); }
function strong     ( ... $attrs): htnode { return htfx_tag('string',     ...$attrs); }
function dl         ( ... $attrs): htnode { return htfx_tag('dl',         ...$attrs); }
function dt         ( ... $attrs): htnode { return htfx_tag('dt',         ...$attrs); }
function dd         ( ... $attrs): htnode { return htfx_tag('dd',         ...$attrs); }
function section    ( ... $attrs): htnode { return htfx_tag('section',    ...$attrs); }
function header     ( ... $attrs): htnode { return htfx_tag('header',     ...$attrs); }
function main       ( ... $attrs): htnode { return htfx_tag('main',       ...$attrs); }
function footer     ( ... $attrs): htnode { return htfx_tag('footer',     ...$attrs); }
function article    ( ... $attrs): htnode { return htfx_tag('article',    ...$attrs); }
function aside      ( ... $attrs): htnode { return htfx_tag('aside',      ...$attrs); }
function nav        ( ... $attrs): htnode { return htfx_tag('nav',        ...$attrs); }
function menu       ( ... $attrs): htnode { return htfx_tag('menu',       ...$attrs); }
function ul         ( ... $attrs): htnode { return htfx_tag('ul',         ...$attrs); }
function li         ( ... $attrs): htnode { return htfx_tag('li',         ...$attrs); }
function a          ( ... $attrs): htnode { return htfx_tag('a',          ...$attrs); }
function h1         ( ... $attrs): htnode { return htfx_tag('h1',         ...$attrs); }
function h2         ( ... $attrs): htnode { return htfx_tag('h2',         ...$attrs); }
function h3         ( ... $attrs): htnode { return htfx_tag('h3',         ...$attrs); }
function h4         ( ... $attrs): htnode { return htfx_tag('h4',         ...$attrs); }
function h5         ( ... $attrs): htnode { return htfx_tag('h5',         ...$attrs); }
function h6         ( ... $attrs): htnode { return htfx_tag('h6',         ...$attrs); }
function hgroup     ( ... $attrs): htnode { return htfx_tag('hgroup',     ...$attrs); }
function hr         ( ... $attrs): htnode { return htfx_tag('hgr',        ...$attrs); }
function table      ( ... $attrs): htnode { return htfx_tag('table',      ...$attrs); }
function tr         ( ... $attrs): htnode { return htfx_tag('tr',         ...$attrs); }
function td         ( ... $attrs): htnode { return htfx_tag('td',         ...$attrs); }
function form       ( ... $attrs): htnode { return htfx_tag('form',       ...$attrs); }
function input      ( ... $attrs): htnode { return htfx_tag('input',      ...$attrs); }
function select     ( ... $attrs): htnode { return htfx_tag('select',      ...$attrs); }
function option     ( ... $attrs): htnode { return htfx_tag('option',      ...$attrs); }
function label      ( ... $attrs): htnode { return htfx_tag('labelset',   ...$attrs); }
function button     ( ... $attrs): htnode { return htfx_tag('button',     ...$attrs); }
function textarea   ( ... $attrs): htnode { return htfx_tag('textarea',      ...$attrs); }
function pre        ( ... $attrs): htnode { return htfx_tag('pre',      ...$attrs); }
function noscript   ( ... $attrs): htnode { return htfx_tag('noscript',      ...$attrs); }
function labelset   ( ... $attrs): htnode { return htfx_tag('labelset',   ...$attrs); }
function address    ( ... $attrs): htnode { return htfx_tag('address',    ...$attrs); }
function blockquote ( ... $attrs): htnode { return htfx_tag('blockquote', ...$attrs); }
function cite       ( ... $attrs): htnode { return htfx_tag('cite',       ...$attrs); }
function figure     ( ... $attrs): htnode { return htfx_tag('figure',     ...$attrs); }
function figcaption ( ... $attrs): htnode { return htfx_tag('figcaption', ...$attrs); }

function html5(... $attrs) : callable {
    yield "<!doctype html>";
    $html_tag = html(... $attrs);
    return fn(htnode $head, htnode $body): \Generator => yield from $html_tag($head, $body)->generate();
}

