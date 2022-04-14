# UA Drupal Test

## Background ##

This configures automated tests of a custom Drupal distribution built by [UA Quickstart](https://bitbucket.org/ua_drupal/ua_quickstart) as one of the [University of Arizona Drupal](https://bitbucket.org/ua_drupal) projects.
It uses descriptions of how a web site based on UA Quickstart should behave that are simple enough that they read like plain English, but are not merely additional documentation.
They are written using the popular [Gherkin](http://docs.behat.org/en/v2.5/guides/1.gherkin.html) syntax, which automated testing software can process.
It supports at least two contrasting styles of test.

- _User Stories:_ The UX and development teams should collaborate on the tests for new features added to UA Quickstart to be sure that they work as expected (the methodology known as behavior-driven development).
These very high-level tests are the main justification for the friendly natural language syntax.
- _Integration Tests:_ Developers working on UA Quickstart can nevertheless couch their tests in the same style, but refer to the low-level behavior of pieces of code and fragments of web pages.
These are particularly important for regression testing (checking that additions and bug fixes do not break existing code).

[Behat](https://github.com/Behat/Behat) processes the tests; it is a general behavior-driven development tool for PHP, augmented in this case by [Mink](http://mink.behat.org/en/latest/index.html), an adapter library that provides a unified PHP interface to several different web browsers (allowing Behat tests to refer to web sites), and by additional extensions giving immediate access to the Drupal installation running a web site, [The Drupal Extension to Behat and Mink](https://github.com/jhedstrom/drupalextension).
A different software tool, Cucumber, originally introduced the Gherkin syntax, so this is widely used and documented.

## Quick Start ##

If you just want to get started quickly, follow these steps.
If something isn't working, look at the instructions below this section for more detailed information.
Of course, you can also read it all to just understand how it works better.

* Make sure you can run a Drupal site (MySQL, PHP, Apache/nginx) and have composer installed.
* Copy the `environment.example` file to `environment`: `cp environment{.example,}`
* Edit the variables in the new `environment` file to match your environment.
* Source the file: `source environment`.
* Run the setup scripts:

        ./uaqstest_drupal_download.sh # Downloads the distribution for you
        ./uaqstest_drupal_install.sh  # Installs the distribution for you
        ./uaqstest_behat_mink.sh      # Configures Behat variables and runs the tests.

* The `./uaqstest_behat_mink.sh` script runs the tests, so you only have to run that script again to run the tests again.

## Requirements ##

The tests are supposed to run in a local development environment (for example, on a developer's own machine, or on a continuous integration server like Jenkins), and use an ephemeral web site installation, which should not be exposed on the public Internet.
The web server configuration and system configuration files such as `/etc/hosts` might need edits to give names to purely local address such as `127.0.0.1`.
The environment should have all the requirements necessary for a working Drupal web site: a MySQL database server pre-configured with a user who has all rights on a specific database, a web server able to accept connections on a pre-defined local port (using some known local directory as the Drupal root), and of course PHP itself.
The initial Drupal setup here requires the [drush](https://github.com/drush-ops/drush) command-line utility, and although the test setup can install the [Composer](http://getcomposer.org) dependency management tool, it should ideally be pre-installed in the environment.
The .sh shell script files here document the steps required at the command line to perform various operations, but ideally the Bash shell should be available to run them directly.
Environment variables, all with names prefixed `UAQSTEST_` set up the configuration for the script, getting default values in most cases, but some must be set and exported, for example

    export UAQSTEST_BASEURL='http://uaquickstarttest.arizona.edu:9081'

to set the local URL at which Behat can find the test web site.
Ideally you should never have to edit the .sh files to set new values, but simply set environment variables to substitute the value you want for the pre-define default.
If you are unfamiliar with setting environment variables from the shell command prompt, remember that there are no spaces around the `=` sign, and that it is always a good idea to put quotes around the values you are assigning (they are unnecessary in many cases, but harmless if included, and required in some cases).
You can also pre-define the variables in your shell's startup files, or put a collection of commonly used settings in one file and use the `source` command to read this.
Bash or the sh shell should be present in most Unix-like systems, including OSX and Linux; for Windows see the notes later in this section.

## Setup ##

The tests in this repository should work if it is cloned at any convenient location within the local test environment.

### UA Quickstart Drupal Distribution ###

The tests need a fully built copy of the UA Quickstart distribution.
A developer contributing to the project will generally have built their own version (under the control of Git), with some of the features coming from local variants that are still being edited; the section “Contributing to the Project” in the README.md from the main [UA Quickstart repository](https://bitbucket.org/ua_drupal/ua_quickstart) gives general advice on setting this up.

#### Downloading ####

Someone testing the distribution as a whole will generally start from the same pre-packaged archive files that are available as for everyone to download; a script here, `uaqstest_drupal_download.sh`, helps document or automate this process.
It downloads the archive file from somewhere specified by a URL, extracts the archive into a directory subtree in a staging area, and finally moves this to a location that the local web server will use as the Drupal root directory.
The environment variable `UAQSTEST_DRUPALROOT` is important for setting this, as the default value will almost never be correct.

#### Installing ####

Once a copy of UA Quickstart is sitting in a directory known to the local web server, the usual configuration for a new Drupal site should work.
A script here, `uaqstest_drupal_install.sh`, automates the process by invoking the `drush site-install` command.
Of particular note (potentially breaking under some circumstances) it assumes that both the current user and the web server belong to a common group (often `www-data` under Linux or `www` under Mac OSX) set in `UAQSTEST_WEBGROUP`, and that the correct permissions on some directories and files makes them group-writeable.
There are no default settings for the Drupal User1 and database user passwords, which must be in

- `UAQSTEST_DBPASS` password used to access the local MySQL server as a user with full access to the database Drupal will use.
- `UAQSTEST_USER1PASS` Drupal administrative user (User1) password for the local test site.

### Behat, Mink and the Drupal Extension ###

The Composer PHP dependency management tool should install Behat, the Mink library and the Drupal extensions, using the `composer.lock` file for almost all the configuration, requiring only the location of the Drupal root directory, and the URL at which the local web server will have brought up the site under test.
As a convenience, the shell script `uaqstest_behat_mink.sh` here invokes `composer install`, and automates the process of configuring Behat without needing any extra .yml configuration files, setting an environment variable `BEHAT_PARAMS`, which in turn comes from the `UAQSTEST_DRUPALROOT` environment variable mentioned previously, and the `UAQSTEST_BASEURL` local URL for the web site.

## Testing

By default the `uaqstest_behat_mink.sh` script will run the full set of tests immediately, but optionally it will set up everything required for running tests manually (without running any itself).
The various `*.feature` files in the `features/` subdirectory in a clone of this repository should contain test definitions.
If the `composer install` command has succeeded (either from the script or manually), Behat should exist in the `bin/` subdirectory as `bin/behat`.

### Making New Tests

UX people as well as developers should be involved in making new tests based on User Stories, and this will involve much work and consultation.
Developers alone, however, should be able to make new low-level tests falling into the Integration category, and between Behat, Mink and the Drupal extension there are already many pre-defined test steps available.
From the command line in a clone of this repository

    bin/behat --definitions l

lists comprehensive information all the test steps, while

    bin/behat --definitions i

gives shorter summaries.

When adding a new test, whether based largely on existing steps or not, developers should use consistent tags to help everyone find particular types of test.

- `@story` marks high-level tests conforming to the _User Story_ pattern.
- `@regression` marks _Integration_ tests developers create to document bugs; the tests should be failing when the bug is present, passing when the bug is fixed, and continue passing so long as no subsequent changes re-introduce the bug.

## Deployment

Although all the tests should be using a local environment invisible to the wider Internet, in some cases the test site should be copied to somewhere more public.
The `uaqstest_drupal_deploy.sh` script shows one way to do this, assuming a public site already exists, and the various Drush commands for synchronizing sites can overwrite it with copy of the test site (`drush rsync`, `drush sql-sync` and so on).
This needs some additional pre-configuration: the remote site must trust an SSH public key coming from the testing environment, and the current user in the test environment must already have Drush aliases defined for the source (local) and target (remote) sites.

## Notes for MS Windows

Behat should on any system with reasonably good support for PHP, including Microsoft Windows.
The scripts included here do need an installation of Bash or an equivalent shell, and some of the supporting Unix-style utilities, since neither the old Windows `cmd` command prompt, nor the newer PowerShell can process them.
However some commonly used tools do include it, notably [Git for Windows](https://git-for-windows.github.io/) and [Acquia Dev Desktop 2](https://docs.acquia.com/dev-desktop2).
The command-line shell in Git for Windows can handle almost all the operations connected with cloning the various UA Quickstart repositories, checking out branches and pushing changes back to the remotes, but knows nothing about the local PHP, database, or web server configuration.
Acquia Dev Desktop 2 can handle the details of running local development web sites, but knows nothing about Git.
One compromise known to work is to clone and use UA Drupal Test from the shell provided by Git for Windows, but inform it of the additional facilities Acquia Dev Desktop 2 is providing.
Assuming this is in `C:\Program Files (x86)\DevDesktop`, setting

    export PATH="${PATH}:/c/Program Files (x86)/DevDesktop/mysql/bin:/c/Program Files (x86)/DevDesktop/php5_5"

makes the `mysql` command and a specific version of PHP (5.5) available, then (assuming ~/bin is on the PATH), add a `~/bin/drush` file containing

    #!/bin/bash

    # DevDesktop's .BAT file records the PHP version this way:
    : ${PHP_ID:='php5_5'}

    PATH="/c/Program Files (x86)/DevDesktop/${PHP_ID}:${PATH}"

    php.exe "/c/Program Files (x86)/DevDesktop/drush/vendor/drush/drush/drush.php" --php="php.exe" "$@"

and a `~/bin/composer` file containing

    #!/bin/bash

    : ${PHP_ID:='php5_5'}

    PATH="/c/Program Files (x86)/DevDesktop/${PHP_ID}:${PATH}"

    php.exe "/c/Program Files (x86)/DevDesktop/drush/composer.phar" "$@"

to make DevDesktop versions of _drush_ and _composer_ available to the shell.
On Windows, the Drupal root directory specified in the `BEHAT_PARAMS` environment variable has to be a Windows-style directory path like `C:\web\Sites\ua_quickstart_test`, but in this case the `\` backslash characters must be escaped with further backslashes, giving `\\`.

## Summary of Environment Variables in Shell Scripts

- `BEHAT_PARAMS` one-line JSON configuration definition used by Behat itself.
- `UAQSTEST_ARCHIVE` name of a .zip or .tar.gz file containing a pre-built packaged UA Quickstart distribution.
- `UAQSTEST_BASEURL` URL (without a trailing slash) where Behat can find the local web site for testing.
- `UAQSTEST_BBUSER` BitBucket account user name to use when uploading UA QuickStart packages to BitBucket.
- `UAQSTEST_BBPASS` BitBucket account password to use when uploading UA QuickStart packages to BitBucket.
- `UAQSTEST_DBNAME` MySQL database name for the local test web site.
- `UAQSTEST_DBHOST` name or address for the MySQL server (including optional port, as 127.0.0.1:33067).
- `UAQSTEST_DBPASS` password used to access the local MySQL server as a user with full access.
- `UAQSTEST_DBTYPE` generally either _mysqli_ or _mysql_.
- `UAQSTEST_DBUSER` name of a user with full rights (including _create_ and _drop_) on the local MySQL database.
- `UAQSTEST_DOWNLOADS` path to a directory for holding temporary downloaded files.
- `UAQSTEST_DRUPALROOT` path to the Drupal installation root directory.
- `UAQSTEST_DUMPDIR` path to a directory for staging database dumps.
- `UAQSTEST_EXTRACTDIR` path to a directory in which to extract the distribution archive.
- `UAQSTEST_FETCH` command (with flags) needed to fetch a remote URL to standard input.
- `UAQSTEST_FLAGS` profile-specific flags to include on the `drush site-install` command line.
- `UAQSTEST_PROFILE` name of the profile to use for the Drupal installation.
- `UAQSTEST_RUNTESTS` whether or not to hold off running the full set of tests immediately.
- `UAQSTEST_SITEEMAIL` contact email address to build in to the Drupal installation.
- `UAQSTEST_SITENAME` title of the Drupal site.
- `UAQSTEST_SOURCE` Drush alias referring to the local test web site.
- `UAQSTEST_TARGET` Drush alias referring to a remote demonstration web site to be updated.
- `UAQSTEST_URLARCHIVE` trailing part of the URL for the packaged UA Quickstart distribution, giving the file to download.
- `UAQSTEST_URLSTEM` URL for a location containing the UA Quickstart pre-built packaged archive.
- `UAQSTEST_USER1NAME` Drupal administrative user (User1) name for the local test site.
- `UAQSTEST_USER1PASS` Drupal administrative user (User1) password for the local test site.
- `UAQSTEST_WEBGROUP` group to which both the local web server and the current testing user belong.
