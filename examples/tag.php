<?php declare(strict_types=1); namespace htfx\prelude\html5;

// Note: this partial must not define any classes or functions,
//       because it may get included multiple times

return article(class: ["post", "post-hello"])(
	h1(class: "post-title", id: $jump = "h1-hello-world")("Hello, World"),
	p()("this is some text"),
	p()("this is some text"),
	a(href: "#" . $jump)("Jump to top of article"),
);
