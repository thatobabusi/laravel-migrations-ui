**As of 27 July 2020, I forked this to take over and use this separately from the main repo as Dave is no longer supporting it. 
Also tired of getting the notifications "package no longer supported" when I do composer install/update/dumpautoload etc.

— *Thato*

---

**As of 18 April 2020, Laravel Migrations UI is not being maintained.**

I was originally planning to build a GUI for generating migrations, not just running them, but it took about 18 months to get this far (the [wireframes](resources/views/wireframes/) weren't originally in Git) and I don't think I'm likely to go back to it any time soon.

If you want to create your own fork, to fix bugs or add new features, please see [the instructions below](#creating-a-pull-request). The [MIT license](#license) requires you to keep the copyright notice and license information, but otherwise you can do what you like with the code and documentation.

— *Dave*

---

Laravel Migrations UI
================================================================================

[![Latest Stable Version](https://poser.pugx.org/thatobabusi/laravel-migrations-ui/v/stable)](https://packagist.org/packages/thatobabusi/laravel-migrations-ui)
[![Total Downloads](https://poser.pugx.org/thatobabusi/laravel-migrations-ui/downloads)](https://packagist.org/packages/thatobabusi/laravel-migrations-ui)
[![Monthly Downloads](https://poser.pugx.org/thatobabusi/laravel-migrations-ui/d/monthly)](https://packagist.org/packages/thatobabusi/laravel-migrations-ui)
[![License](https://poser.pugx.org/thatobabusi/laravel-migrations-ui/license)](https://packagist.org/packages/thatobabusi/laravel-migrations-ui)
[![Latest Unstable Version](https://poser.pugx.org/thatobabusi/laravel-migrations-ui/v/unstable)](https://packagist.org/packages/thatobabusi/laravel-migrations-ui)
[![Build Status](https://travis-ci.com/thatobabusi/laravel-migrations-ui.svg?branch=master)](https://travis-ci.com/thatobabusi/laravel-migrations-ui)
[![Coverage Status](https://coveralls.io/repos/github/thatobabusi/laravel-migrations-ui/badge.svg?branch=master)](https://coveralls.io/github/thatobabusi/laravel-migrations-ui?branch=master)

A web-based GUI for ~~creating~~ (coming soon) ~~and~~ running migrations in [Laravel](https://laravel.com/).

![](screenshot.png)


 Table of Contents
--------------------------------------------------------------------------------

- [Compatibility Chart](#compatibility-chart)
- [Installation](#installation)
- [Contributing](#contributing)
- [No Technical Support](#no-technical-support)
- [Changelog](#changelog)
- [License](#license)


 Compatibility Chart
--------------------------------------------------------------------------------

| Laravel Migrations UI | Laravel   | PHP  |
|-----------------------|-----------|------|
| **1.0.1+**            | 5.6+      | 7.1+ |
| 1.0.0                 | 5.8+      | 7.1+ |


 Installation
--------------------------------------------------------------------------------

```bash
composer require --dev thatobabusi/laravel-migrations-ui
```

Optionally publish and edit the config file (`config/migrations-ui.php`):

```bash
php artisan vendor:publish --tag=migrations-ui-config
```

Then visit `/migrations` (or the path set in your config file).

For security, by default, Migrations UI is only active if `APP_ENV=local` and `APP_DEBUG=true`, *or* you set `MIGRATIONS_UI_ENABLED=true`, in `.env`. You should not enable it in production or any publically accessible environments - that would be a major security vulnerability!

 Contributing
--------------------------------------------------------------------------------

**Documentation:** If you think the documentation can be improved in any way, please do [edit this file](https://github.com/thatobabusi/laravel-migrations-ui/edit/master/README.md) and make a pull request.

**Bug fixes:** Please fix it and open a [pull request](https://github.com/thatobabusi/laravel-migrations-ui/pulls). ([See below](#creating-a-pull-request) for more detailed instructions.) Bonus points if you add a unit test to make sure it doesn't happen again!

**New features:** Please build it and open a [pull request](https://github.com/thatobabusi/laravel-migrations-ui/pulls). If you want to discuss it before doing too much work, make a proof-of-concept (either code or documentation) and open a [Draft PR](https://github.blog/2019-02-14-introducing-draft-pull-requests/) to discuss the details.


### Creating a pull request

The easiest way to work on Laravel Migrations UI is to tell Composer to install it from source (Git) using the `--prefer-source` flag:

```bash
rm -rf vendor/thatobabusi/laravel-migrations-ui
composer install --prefer-source
```

Then checkout the master branch and create your own local branch to work on:

```bash
cd vendor/thatobabusi/laravel-migrations-ui
git checkout -t origin/master
git checkout -b YOUR_BRANCH
```

Now make your changes, including unit tests and documentation (if appropriate). Run the unit tests to make sure everything is still working:

```bash
scripts/test.sh
```

Then commit the changes. [Fork the repository on GitHub](https://github.com/thatobabusi/laravel-migrations-ui/fork) if you haven't already, and push your changes to it:

```bash
git remote add YOUR_USERNAME git@github.com:YOUR_USERNAME/laravel-migrations-ui.git
git push -u YOUR_USERNAME YOUR_BRANCH
```

Finally, browse to the repository on GitHub and create a pull request.

(Alternatively, there is a [test app](https://github.com/thatobabusi/laravel-packages-test) that you can use.)


### Using your fork in a project

To use your own fork in a project, update the `composer.json` in your main project as follows:

```json5
{
    // ADD THIS:
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/YOUR_USERNAME/laravel-migrations-ui.git"
        }
    ],
    "require": {
        // UPDATE THIS:
        "thatobabusi/laravel-migrations-ui": "dev-YOUR_BRANCH"
    }
}
```

Replace `YOUR_USERNAME` with your GitHub username and `YOUR_BRANCH` with the branch name (e.g. `develop`). This tells Composer to use your repository instead of the default one.


### Unit tests

To run the unit tests:

```bash
scripts/test.sh
```

To check code coverage:

```bash
scripts/test-coverage.sh
```

Then open `test-coverage/index.html` to view the results. Be aware of the [edge cases](https://phpunit.de/manual/current/en/code-coverage-analysis.html#code-coverage-analysis.edge-cases) in PHPUnit that can make it not-quite-accurate.


### New version of Laravel

There is no maximum version specified in [`composer.json`](composer.json), so there is no need for a new version of Laravel Migrations UI to be released every 6 months. However, this file will need to be updated to run tests against the new version:

- [`.travis.yml`](.travis.yml)
    - `matrix` (Laravel versions)
    - `php` (PHP versions)
    - `exclude` (Unsupported combinations)

If changes are required, also update:

- [`README.md`](README.md)
    - [Compatibility Chart](README.md#compatibility-chart)
    - [Changelog](README.md#changelog)

If backwards-incompatible changes cause the **minimum** supported versions of Laravel or PHP to change, update:

- [`composer.json`](composer.json)
    - `php/*`
    - `illuminate/*`

### Releasing a new version

*This section is for maintainers only.*

- Ensure the unit tests are updated and have 100% coverage (for PHP code)
- Build assets in production mode (`yarn build`) and commit if anything has changed
- Update the [test app](https://github.com/thatobabusi/laravel-packages-test), if appropriate, and test it manually
- Ensure the [README](README.md) is up to date, including:
    - Document any new features
    - [Compatibility Chart](README.md#compatibility-chart)
    - [Changelog](README.md#changelog)
- Merge the changes into the `master` branch (if necessary)
- Push the code changes to GitHub (`git push`)
- Make sure [all tests are passing](https://travis-ci.org/thatobabusi/laravel-migrations-ui)
- Tag the release (`git tag 1.2.3`)
- Push the tag (`git push --tag`)


 No Technical Support
--------------------------------------------------------------------------------

Sorry, I don't offer any technical support, and GitHub Issues are disabled. That means I won't figure out why it's not working for you, I won't fix bugs for you, and I won't write new features on request - this is **free** software after all.

**But** the beauty of open source is you can do whatever you want with it! You can fork it, fix it, improve it and extend it. If you don't want to maintain your own fork, and you think other people would benefit from your changes, you can submit a [pull request](https://github.com/thatobabusi/laravel-migrations-ui/pulls) to have your changes included in the next release.

If you get really stuck, I suggest you:

1. Read and re-read both this file and the [Laravel documentation](https://laravel.com/docs) to see if you missed something.
2. Dive into the source code and spend some time figuring out how it's meant to work and what's actually happening.
3. Try to reproduce the problem on a brand new Laravel project, in case it's an incompatibility with another package or your other code.
4. Ask your colleagues to help you debug it, if you work in a team.
5. Pay someone more experienced to help you (or if you work for a company, ask your boss to pay them).
6. Try posting on [Stack Overflow](https://stackoverflow.com/search?q=laravel+route+browser), [Laravel.io Forum](https://laravel.io/forum) or [Laracasts Forum](https://laracasts.com/discuss) (but I can't promise anyone will answer - they don't get paid either).
7. Use a different package instead.
8. Write your own.


 Changelog
--------------------------------------------------------------------------------

*Laravel Migrations UI uses [Semantic Versioning](http://semver.org/).*


### [v1.0.3](https://github.com/thatobabusi/laravel-migrations-ui/tree/1.0.3) (Sat 29 Feb 2020)

- Fix Telescope migrations not being picked up because they're only registered at the console
- Grey out all buttons when any action is running


### [v1.0.2](https://github.com/thatobabusi/laravel-migrations-ui/tree/1.0.2) (Sun 23 Feb 2020)

- Better error handling for various edge cases
- Excluded some unnecessary files from production build


### [v1.0.1](https://github.com/thatobabusi/laravel-migrations-ui/tree/1.0.1) (Sun 23 Feb 2020)

- Bug fix for Laravel 5.6, 5.7 (`Collection` class didn't have a `join()` method)


### [v1.0.0](https://github.com/thatobabusi/laravel-migrations-ui/tree/1.0.0) (Sat 22 Feb 2020)

- First stable release


 License
--------------------------------------------------------------------------------

*[MIT License](https://choosealicense.com/licenses/mit/)*

**Copyright © 2019-2020 Dave James Miller**

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
