# htfx

[![pipeline status](https://gitlab.hostmax.ch/kuettel-informatik/htfx/badges/main/pipeline.svg)](https://gitlab.hostmax.ch/kuettel-informatik/htfx/-/commits/main) [![Latest Release](https://gitlab.hostmax.ch/mku/htfx/-/badges/release.svg)](https://gitlab.hostmax.ch/mku/htfx/-/releases) [![coverage report](https://gitlab.hostmax.ch/mku/htfx/badges/main/coverage.svg)](https://gitlab.hostmax.ch/kuettel-informatik/htfx/-/commits/main)

Declarative Hypertext Template Engine for PHP.

## Features

* Decorate your html to suit your needs
* Partials, Layouts
* Extensibility, Customization
* Streaming of Tokens for rendering
* more coming...


<!-- TOOD(Visuals) Depending on what you are making, it can be a good idea to include screenshots or even a video (you'll frequently see GIFs rather than actual videos). Tools like ttygif can help, but check out Asciinema for a more sophisticated method.-->

## Roadmap

* implement fibers or passing lazy functions to, to allow for rendering template as soon as possible


## Installation

Clone this repository. Once you've navigated into the just cloned directory you'll first
need to install all the dependencies using composer. (If you can't simply install composer
on your machine there is a composer.phar file available)

    composer install

(Note: use `composer install --no-dev` when deploying, preventing the installing of dev tools)

Then to configure the application to your computing environment you can copy
the `env` file at the root folder of this repository and adjust the `.env` file like this:

    cp env .env
    $EDITOR .env


## Development   

### Configuration

First, if you plan to develop this software, you'll probably want to set `FX_ENVIRONMENT=development` variable in your `.env` file to development.


## Support
Tell people where they can go to for help. It can be any combination of an issue tracker, a chat room, an email address, etc.

## Roadmap
If you have ideas for releases in the future, it is a good idea to list them in the README.

* more modules based upon this repo will follow


### Repo management

- [ ] [Set up protected environments](https://docs.gitlab.com/ee/ci/environments/protected_environments.html)
- [ ] [Automatically close issues from merge requests](https://docs.gitlab.com/ee/user/project/issues/managing_issues.html#closing-issues-automatically)
- [ ] [Enable merge request approvals](https://docs.gitlab.com/ee/user/project/merge_requests/approvals/)
- [ ] [Set auto-merge](https://docs.gitlab.com/ee/user/project/merge_requests/merge_when_pipeline_succeeds.html)

## Contributing

State if you are open to contributions and what your requirements are for accepting them.

For people who want to make changes to your project, it's helpful to have some documentation on how to get started. Perhaps there is a script that they should run or some environment variables that they need to set. Make these steps explicit. These instructions could also be useful to your future self.

You can also document commands to lint the code or run tests. These steps help to ensure high code quality and reduce the likelihood that the changes inadvertently break something. Having instructions for running tests is especially helpful if it requires external setup, such as starting a Selenium server for testing in a browser.

## Authors and acknowledgment

* Development: Moritz Küttel <moritz_kuettel+htfx_readme@fastmail.com>, Küttel Informatik <moritz_kuettel+hostmax_website@fastmail.com> 

## License

Lesser GNU General Public License version 3 or later. See the file `COPYING`.

Copyright © by Moritz Küttel


## Project status

Beta, Unfinished
