<?php declare(strict_types=1); namespace htfx\prelude\html5;

return html5(lang: "en")(
    head(
        title("Simple Prelude HTML5")
    ),
    body()(
        header()(
            "Header"
        ),
        main()(
            "Main"
        ),
        footer()(
            "Footer"
        )
    )
);