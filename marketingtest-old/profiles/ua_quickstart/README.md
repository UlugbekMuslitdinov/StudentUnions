UA QuickStart Drupal Distribution and Install Profile
=============================================================

Demonstration/starter Drupal distribution and installation profile that packages
various features consistent with community best practices and UA brand strategy.

## A Complete Customized Drupal

UA QuickStart is a complete customized version of the popular Drupal content
management system, not an add-on to an existing Drupal-based web site.
Previously to start a new Drupal site you would prepare a web server and
database, then download the Drupal core software from drupal.org and install it
(following the instructions at https://www.drupal.org/documentation/install).
This would produce a minimally functional web site with no content, which you
could then customize by adding themes and modules to fit it to your needs.
Increasingly, however, you can download Drupal distributions, which not only
contain the core, but also complete sets of additions to make it almost
immediately useful for a particular purpose, such as an online storefront. UA
QuickStart is the distribution that provides many of the features specific to
the University of Arizona, and rather than an empty site, initially shows some
demonstration content (which can nevertheless be turned off instantly).

## Packaged Versions

Complete pre-built versions of the UA QuickStart distribution are in the
[downloads area](https://bitbucket.org/ua_drupal/ua_quickstart/downloads). The
file names give the release version (you will generally want the most recent
release), and the file suffixes give the compression method, `.zip` and
`.tar.gz`. Treat these exactly as you would a manual download of Drupal itself
from drupal.org: prepare a local development or test web server, a MySQL
database, expand the `.zip` or `.tar.gz` file where you would like the site to
appear, and go through the usual steps to bring up a new Drupal site, following
the instructions from the drupal.org
[installation guide](https://www.drupal.org/documentation/install). Pre-packaged
[ua_quickstart-7.x-1.x-dev.tar.gz](https://bitbucket.org/ua_drupal/ua_quickstart/downloads/ua_quickstart-7.x-1.x-dev.tar.gz)
and
[ua_quickstart-7.x-1.x-dev.zip](https://bitbucket.org/ua_drupal/ua_quickstart/downloads/ua_quickstart-7.x-1.x-dev.zip)
files are also available; these will generally contain the latest changes, which
might be unstable experimental features, but might also be fixes for known
problems.

## Specific Hosting Environments

The University of Arizona has made special arrangements with a Drupal hosting
provider, Pantheon, which includes additional support for UA
QuickStart. Contact
[Campus Web Services](https://it.arizona.edu/service/campus-web-services)
for more information.

## Install Profile Features

- Creates default text formats (copied from Drupal Standard install profile, for now).
- Creates default administrator role (copied from Drupal Standard install profile, for now).
- Enables some default blocks.

## Distribution Packaged Features

The University of Arizona customizations are broken up into smaller components:
modules based on Drupal Features, and subthemes. Experienced developers do not
have to use the entire UA QuickStart distribution, but can pick the individual
modules they need. Unlike the full UA QuickStart distribution or contributed
modules on Drupal.org, these are not available as conveniently packaged archive
files, but each module has its own
[public Git repository](https://bitbucket.org/account/user/ua_drupal/projects/UAQS),
allowing the developer to make a copy of either the latest development version,
or of some particular release.

- [UA Zen Theme](https://bitbucket.org/ua_drupal/ua_zen)
- [UA CAS Feature](https://bitbucket.org/ua_drupal/ua_cas)
- [UA Google Tag Feature](https://bitbucket.org/ua_drupal/ua_google_tag)
- [UAQS Core Feature](https://bitbucket.org/ua_drupal/uaqs_core)
- [UAQS Demo Content Feature](https://bitbucket.org/ua_drupal/uaqs_demo)
- [UAQS Event Feature](https://bitbucket.org/ua_drupal/uaqs_event)
- [UA Google Tag](https://bitbucket.org/ua_drupal/ua_google_tag)
- [UAQS Featured Content (Carousel) Feature](https://bitbucket.org/ua_drupal/uaqs_featured_content)
- [UAQS Navigation Feature](https://bitbucket.org/ua_drupal/uaqs_navigation)
- [UAQS News Feature Feature](https://bitbucket.org/ua_drupal/uaqs_news)
- [UAQS Page Feature](https://bitbucket.org/ua_drupal/uaqs_page)
- [UAQS Person Feature](https://bitbucket.org/ua_drupal/uaqs_person)
- [UAQS Program Feature](https://bitbucket.org/ua_drupal/uaqs_program)
- [UAQS Publication Feature](https://bitbucket.org/ua_drupal/uaqs_publication)
- [UAQS Unit Feature](https://bitbucket.org/ua_drupal/uaqs_unit)
- More to come...

## Contributing to the Project

To contribute to the project you will need your own account on the
[Bitbucket](https://bitbucket.org) repository hosting service, as well as a local
development environment (like a laptop or test web server) where you can use the
[Git](http://git-scm.com/) version control system client and the widely used
[Drush](http://docs.drush.org/en/master/) Drupal command-line utility. Your
development environment should include a web server that can support Drupal, for
local testing of your work. You will find it much easier to make changes on
Bitbucket if you set up SSH with public key authentication. All the UA
QuickStart repositories on Bitbucket are public, so everyone is welcome to clone
them and experiment with making changes to the local copy. Authorized developers
can make changes to UA QuickStart itself. However you can still submit changes
if you are not authorized to modify the main `ua_drupal/ua_quickstart` repository:
you will need your own copy (fork) of the ua_quickstart repository on Bitbucket,
and have one of the authorized developers make a branch incorporating the changes
you have made there. All authorized developers should have access to the
UA Digital project on
[JIRA](https://jira.arizona.edu/secure/RapidBoard.jspa?rapidView=90&projectKey=UADIGITAL)
for tracking issues, and the University of Arizona
[Slack team](https://uarizona.slack.com) for discussion and seeing the results
of builds.

When you start working on your contribution to UA QuickStart you should check it
locally, using the web development environment on your own machine, or your own
test web server. When it is working to your satisfaction, you should submit it
for review by some of the other UA QuickStart developers. An automated service,
Probo.ci, will build a complete working copy of the UA QuickStart demonstration
site that incorporates your changes, and the reviewers will be able to refer to
this. If the reviewers approve and someone includes your contribution in UA
QuickStart, there will be a final phase of automated tests, and (if they pass)
it will appear as part of the demonstration web site for the latest UA
QuickStart development version.

### Git Setup

If you have never heard of Git, here is a
[text tutorial](https://www.atlassian.com/git/tutorials/what-is-git) and here is a
[video tutorial](https://www.youtube.com/watch?v=8oRjP8yj2Wo) to help get you
started. There is also a more comprehensive
[online book](https://git-scm.com/book/en/v2), which provides an in-depth guide
on using Git from the command line. The examples given here should work with the
Git Bash command-line option from
[Git for Windows](https://git-for-windows.github.io/Git) and natively with the
standard versions of Git available under MacOS and Linux. Git assumes that your
local development work will take place within folders (directory subtrees) that
it can control (it makes a special `.git` subfolder there for its housekeeping,
and uses several other special files). But Git will also keep some more general
settings in a more general location, like your home directory; these should
include your name and email address (to identify any changes you make),
preferences for the particular code text editor you will be using, and a list of
file patterns that Git should always ignore. This last point is important
because some operating systems will clutter your work with annoying files and
folders that the rest of the world should never see (the `.DS_Store` files of
MacOS are a particularly pervasive nuisance). The `ua_drupal/ua_quickstart` Git
repository has a `.gitignore` file to exclude some annoying files, but you
cannot count on this working in all cases. Make sure you have a global Git
[core.excludesFile](https://git-scm.com/docs/git-config.html#git-config-coreexcludesFile)
setting pointing at the file (like `~/.gitignore_global`) that contains the file
and directory patterns to ignore. Configure Git to play nicely with the
particular code editor you are using. In particular, all the UA QuickStart Git
repositories use the `LF` character to mark line endings, so if you normally use
`CR-LF` as a line ending in your editor, set Git to make the conversion before
doing anything with your changes. Avoid introducing changes that only affect
whitespace characters (such as substituting tabs for spaces), and avoid
inserting extra white space characters immediately before the ends of lines.

### Bitbucket Setup

If you do not already have an account on Bitbucket, there is no charge for
setting one up at the most basic level of service, but note that their
base-level academic subscription is also free and gives you substantially more
resources (currently 5 GB as opposed to 1 GB of file storage, and 500 minutes as
opposed to 50 minutes of time on their Pipelines build system): be sure to use
an email address from a recognized academic institution (such as
email.arizona.edu) when you create the account. Once you have set up the
account, refer to their guide
[Set up SSH for Git](https://confluence.atlassian.com/bitbucket/set-up-ssh-for-git-728138079.html):
this explains how to set up SSH on your own development machines if you haven't
done this already, and how to upload your public key so that you can log onto
Bitbucket to make changes without having to type a password each time. If you do
not set up SSH, only URLs that reference Bitbucket as
`https://bitbucket.org/...` will work, and the references to
`git@bitbucket.org:...` will not. Bitbucket support source control systems such
as Mercurial in addition to Git, and a local code management system called
SourceTree, but the UA QuickStart projects have not used them.

The examples that follow include an arbitrary Bitbucket username `tobiashume`,
but in practice you should of course substitute your actual Bitbucket username.

### 1. Clone UA QuickStart

Clone the official UA QuickStart repository in some location that's easy to work
on.

    cd ~/gitwork
    git clone git@bitbucket.org:tobiashume/ua_quickstart.git

If you need immediate access to a copy without having to set up a Bitbucket
account, a simple

    git clone https://bitbucket.org/ua_drupal/ua_quickstart.git

will work as well.

### 2. Check Out an Issue Branch

Change to the local clone as your working directory, and make a distinct new
branch for the issues you will be working on. If you are authorized to make
changes in the `ua_drupal/ua_quickstart` repository, please make sure an issue
for it exists in
[JIRA](https://jira.arizona.edu/projects/UADIGITAL/summary) first, and make sure
the branch name is the same (it must start with `UADIGITAL-` then the issue
number).

    cd ua_quickstart
    git checkout -b 'UADIGITAL-1140'

If you are not authorized to make direct changes, give the branch some short
descriptive label (something like `'top_level_documentation_fix'`), but someone
will need to make an issue number for it later.

### 3. Work on Your Branch

Edit and add files according to the changes you need to make, committing changes
as you go, for example:

    git commit -a -m 'Fix the URLs.'

### 4. Direct Local Development

#### 4.1. Building UA QuickStart locally

Make sure your are in the top level directory of your ua_quickstart clone (so
the `build-ua_quickstart.make.yml` file *must* be in your current directory),
and you have some writable directory where your local web server will be
expecting to find site document roots (in this example `/web/Sites`). Use the
`drush make` command to build UA QuickStart:

    drush make build-ua_quickstart.make.yml /web/Sites/ua_quickstart

This should build the complete UA QuickStart distribution, with your changes
included, in the destination directory (`/web/Sites/ua_quickstart` in the
example). If something goes wrong you might have to delete this directory and
everything within it, make further changes to your work, and try again. This
drastic approach (ideally also wiping any database associated with the site)
guarantees that no subtle problems linger from one build to another.

If you notice problems in the site you have built, and fix them by editing the
files directly, you will have to copy the modifications back to your local
ua_quickstart clone and commit them to the issue branch there. A quick and dirty
way to avoid this uses a command like

    drush make build-ua_quickstart.make.yml --working-copy /web/Sites/ua_quickstart

but you must then abandon your original clone and perform all the Git operations
within the profiles/ua_quickstart directory of the built site, and cannot delete
it without also losing your changes.

If your web server isn't on the same machine on which you are editing the code
files (even if it is in a container or virtual machine rather than a remote
server) it may make sense to make your own fork of UA QuickStart on Bitbucket
(see section 7.x below) even if you will ultimately push your changes to a
branch in the `ua_drupal/ua_quickstart` repository for review. You can then
push your edits to your forked copy, and have your web server pull them from
the fork, rather than worrying about copying the edited files directly. In any
case, the destination you specify in the `drush make` command must be somewhere
that your web servercan use (you might even need to make sure drush is installed
on the web server and run it there rather than the machine you use for editing).

To facilitate a more streamlined build process during development, a Makefile
has been added to the repository. For this to work, you'll need to have GNU make
installed on your machine. Building a local copy of your code is now as
simple as running `make` from inside your local copy of ua_quickstart.
The resulting build will be located at `~/Sites/UAQS_Builds/<git-branch-name>`.

To specify building the Pantheon version of the codebase, run `make pantheon`.

To delete the build produced by running the `make` command, run `make clean`.

#### 4.2. Bringing up the new Drupal site

Treat the newly built `ua_quickstart` directory as if it was a freshly
downloaded copy of the main Drupal distribution. Make sure the directory will be
treated as a document root in your webserver, make a database ready for it and
tidy up the permissions under the `sites/default/files` subdirectory. If you
normally use a web browser to bring up a new Drupal site it should work as
expected, if you normally use the `drush site-install` command, invoke it from
within the newly created `ua_quickstart` directory, and be sure to explicitly
mention the `ua_quickstart` profile as well:

    cd /web/Sites/ua_quickstart
    drush si ua_quickstart --account-mail=tobiashume@ltrr.arizona.edu --account-name=tuber --db-url=mysqli://uaqsdbadmin:MyOwnPassword@localhost/uaquickstartdb --site-name='UA QuickStart' -y

(substituting your own `--db-url` database details, and `--account-mail`, which
shouldn't matter in a local test in any case).

The scripts initially under devtools/ua_drupal_test can help with repeated site
configuration operations (if you keep having to wipe your built copy and start
from scratch): you can set environment variables to avoid having to re-enter
some of the options.

### 5. Alternative: Local Development with Lando

Some convenient tools can help if you have difficulty configuring a Drupal
development environment to build and test UA QuickStart.
[Lando](https://docs.devwithlando.io/) is one of these, particularly useful for
working under Windows, and for integrating with the Pantheon hosting service.
Internally, it uses Docker containers to build web applications in standardized
environments, and will offer to install Docker by default (so do not select this
option if you are already using Docker). If you have followed the instructions
to
[install Lando](https://docs.devwithlando.io/installation/system-requirements.html)
on your machine, and have already followed the steps 1 through 3 here (working
on an issue branch in your own Git clone of the UA QuickStart repository), you
should be able give the

    lando start

command from the top level directory of your ua_quickstart clone and have it
build a complete working website with your changes included. At the very end of
the installation it should display a message something like

    BOOMSHAKALAKA!!!

    Your app has started up correctly.
    Here are some vitals:

    NAME            ua-quickstart
    LOCATION        /home/tobiashume/ua_quickstart
    SERVICES        appserver, database

    APPSERVER URLS  https://localhost:32779
                 http://localhost:32780
                 http://ua-quickstart.lndo.site:8000
                 https://ua-quickstart.lndo.site

You can copy a URL from the end of this message and paste it into a web browser
to have it display the new site. When you no longer need the local site, the
command

    lando stop

will stop it running, and the command

    lando destroy

will remove it (although you might still need to clean up the `uaqsbuildroot`
directory tree Lando will have built). A small Docker container might keep
running after `lando destroy` has removed the containers that your site was
using, but this is a general utility, not tied to any one site.

You can spin up multiple test sites simply by making multiple clones of the UA
QuickStart repository and using the `lando start` command in each clone, but
it's vitally important to first edit the `.lando.yml` file in each clone,
changing the line near the start from

    name: ua-quickstart

to something different for each different site, like

    name: sarlacc

(there can only be one site for each name). To avoid any confusion with which
changes should go into the upstream repository on Bitbucket, it helps to use the
anonymous version of the `git clone` command to make the extra copies in
differently named directories.

    git clone https://bitbucket.org/ua_drupal/ua_quickstart.git sarlacc

For more information about using Lando with UA QuickStart, see the page on
[Confluence](https://confluence.arizona.edu/pages/viewpage.action?pageId=72224402).

### 6. Check the Changes on the New Site

Use some web browsers to look at the new site in your test environment, checking
that your changes work and have not broken anything else. The UA Demo Content
module should be providing some pre-loaded test content that exercises many of
the features within UA QuickStart. If you have to modify any files, be sure to
copy your edits back to your clone of ua_quickstart and commit the changes.
Since a most of the custom modules use Drupal Features (exporting configuration
from the database to code), one common check is to check that the re-exported
Feature still matches your original code.

If they will run in your local test environment, the built-in tests using Behat
may also be useful. See the directory devtools/ua_drupal_test for more
information.

### 7a. If You Are Authorized to Make Changes: Push The Issue Branch to Bitbucket

Once everything seems to work (which might take a few iterations of further
edits and re-installing your local UA QuickStart distribution), make sure you
are back in the directory holding your clone, make sure all the changes are
committed to the issue branch in Git (use `git status` to check), then push the
issue branch to the `ua_drupal/ua_quickstart` Bitbucket repository. So for the
example issue branch `UADIGITAL-1140` the command would be:

    git push -u origin 'UADIGITAL-1140'

where `origin` is the usual Git shorthand for the remote repository that you
have cloned, and the `-u` option updates the branch configuration for the remote
repository (unnecessary after the first push to the origin).

You might want to reorganize your local Git history to make it more
understandable for reviewers by using the `git rebase -i` or `git reset --soft`
commands to squash your commits (but if your changes do get merged there will be
an option to squash your commits at that stage).

### 7x. If You Are Not Authorized: Fork and Push

If you are not authorized to make changes directly in the
`ua_drupal/ua_quickstart` Bitbucket repository for UA QuickStart, visit its
[web page](https://bitbucket.org/ua_drupal/ua_quickstart). Make sure you are
logged in to your own Bitbucket account, then choose the “Fork” option from the
list of possible actions. This will make a complete copy of the repository
under your account, so if your Bitbucket username is `tobiashume`, this would
put the copy at https://bitbucket.org/tobiashume/ua_quickstart. Make sure your
local working copy (that you cloned from the original repository) is connected
to this forked version as well, using the `git remote add` command. So in the
case of the example this would be

    git remote add myfork git@bitbucket.org:tobiashume/ua_quickstart.git

You can check that this is has been set up correctly with the command

    git remote -v

which lists the remote repositories currently associated with your local copy:
it should show something like

    myfork	git@bitbucket.org:tobiashume/ua_quickstart.git (fetch)
    myfork	git@bitbucket.org:tobiashume/ua_quickstart.git (push)
    origin	git@bitbucket.org:ua_drupal/ua_quickstart.git (fetch)
    origin	git@bitbucket.org:ua_drupal/ua_quickstart.git (push)

The initial clone operation assigned the remote name `origin` by default: you've
added a name meaningful to you (`myfork` in this case) for your own copy up on
Bitbucket. Now push your local branch to your remote, for example

    git push -u myfork 'UADIGITAL-1140'

### 8a. If You Are Authorized to Make Changes: Issue a Pull Request

Your contributions to the project should now be up in Bitbucket. Go to the main
Bitbucket web page for
[UA QuickStart showing branches](https://bitbucket.org/ua_drupal/ua_quickstart/branches/).
Make sure you are logged in and it is showing your issue branch, select your
branch, then select Bitbucket's “Create pull request” option, which should show
it to be merged into the 7.x-1.x branch of the main UA QuickStart repository you
initially forked from.

- In the title of the pull request, repeat any of the issue numbers (in the form UADIGITAL-1140) that your changes address: this helps automated updates of the issues within JIRA.
- Add a brief description of how your changes address the issues.
- In the Reviewers section, enter at least one and preferably two team members to review your request, choosing the people most directly responsible for the parts of UA QuickStart you have changed.
- Check the “Close branch” option on your issue branch, since this isn't something that should have a long-term independent existence.

It should be showing you a summary of your changes in the same diff format the
reviewers will see: after a final check, select the “Create pull request”
button.

### 8x. If You Are Not Authorized: Make a Pull Request on Your Fork

Your contributions to the project should now be up in Bitbucket, but they are
isolated in your own fork of ua_quickstart. Go to the Bitbucket web page for
your repository (it should have your Bitbucket user name in the URL, something
like `https://bitbucket.org/tobiashume/ua_quickstart`). Select “Create pull
request” option on the list of available actions, make sure the source branch
(specified first) is the issue branch that you have just pushed to your fork,
and the destination is not your fork, but the original
`ua_drupal/ua_quickstart` repository. In the Reviewers section, choose someone
who should be authorized to copy your pull request to something using a branch
in the `ua_drupal/ua_quickstart` repository.

### 9a. If You Are Authorized to Make Changes: Inspect the Probo.ci Review Site

Your pull request should trigger Probo.ci to build a review site incorporating
your changes, reporting the progress of the build in the University of Arizona
[Slack team](https://uarizona.slack.com), and updating the status shown on the
Bitbucket
[pull request summary page](https://bitbucket.org/ua_drupal/ua_quickstart/pull-requests/)
for ua_quickstart. The final reported link on Slack, or the link from the status
icon on Bitbucket, should let you log in to Probo.ci's system with your
Bitbucket credentials, and get a button linking to the live review site (or a
report on what caused the build to fail). You might have to copy and paste the
URL for the review site to send it to any reviewers who do not have access to
some of the systems.

If any of the reviewers suggest changes, or you yourself notice something
unexpected on the review site, you can immediately make changes to your working
clone of UA QuickStart and push the changes to the issue branch in the
`ua_drupal/ua_quickstart` repository. So in the example that would be

    ...(edit some files)...
    commit -a -m 'Fix problems identified by reviewer @ewdijkstra'
    git push origin 'UADIGITAL-1140'

Since there is already an active pull request for the issue branch, Probo.ci
will immediately build a completely new version of the review site incorporating
your latest changes, and automatic notifications will go out to the reviewers
(because of all this automation, you might want to check your changes carefully
before pushing them).

### 9x. If You Are Not Authorized: Wait For The Status of Your Request

If you are unable to make your own branches in the
`ua_drupal/ua_quickstart` repository you will have to wait for someone
to transfer your pull request into one that will trigger a Probo.ci
build, and send you a copy of the review site URL. You will be able to
push any corrections to your fork in response to the comments from
reviewers, but will need the cooperation of someone authorized to make
changes for these to appear in the actual issue branch in the main
repository and trigger a new Probo.ci review site build.

### 10. When Your Request Is Merged

If your changes pass review they should be merged, which adds them to the
`ua_drupal/ua_quickstart` UA QuickStart repository, and automatically updates
the freestanding repositories for any of the custom modules or themes you have
changed. As soon as this last change goes through, the Jenkins continuous
integration system will build a fresh UA QuickStart distribution, run some
tests on this, and (if they pass) install it on a generally visible
[demonstration server](http://kitten.ltrr.arizona.edu/).

### 11. Keeping Up With Changes

If your work on an issue lasts more than a day or two, or you want to keep
re-using a local copy of the UA QuickStart repository, there is a risk your copy
will fall behind changes other people have been making. Assuming you are in the
top level of your local cloned copy, the commands

    git checkout 7.x-1.x
    git fetch origin
    git merge --ff-only

will bring the main `7.x-1.x` branch in your copy up to date with the latest
changes, refusing to do anything if there are any unexpectedly complicated
differences (`git pull` is an alternative command for picking up the changes).
If you have a feature branch you were working on before picking up the changes,
you can update it by something like

    git checkout 'UADIGITAL-1140'
    git rebase 7.x-1.x

This may require some manual editing help to deal with any conflicts between
your work and the recent changes: merging the main branch into your work is
another approach, but won't escape the need for manual intervention if there are
any conflicts.

### 12. Working from the Freestanding Repositories

If you do not work with the complete UA QuickStart distribution, but make your
own manual selection from the
[freestanding repositories](https://bitbucket.org/account/user/ua_drupal/projects/UAQS),
nevertheless please submit any pull requests against the complete distribution.
The freestanding repositories are in effect read-only copies of the modules and
themes within UA QuickStart, automatically extracted from places like the
modules/custom directory each time someone merges a change that affects them.
However it may be convenient to work from your own forks of these repositories,
to make it easy for Git to push your edits and pull changes into your normal
working environment. Once your work there is finished, as a final stage you can
copy the changes into an issue branch on a fresh clone of the
`ua_drupal/ua_quickstart` repository, and push that to make your pull request.

## Contributing New Custom Modules and Themes

If you want to contribute a completely new custom module or theme to UA
QuickStart, a little extra setup is needed. Many of the existing customizations
have a matching freestanding repository, and are not arbitrary subdirectories
within the main `ua_drupal/ua_quickstart` repository, but Git Subtrees:
automated software takes care of synchronizing the freestanding repository with
the subtree in the main repository. Some additional automation helps the
process of adding new subtrees, but the initial steps in this process need the
cooperation of someone with administrative rights within the overall UA
QuickStart project.

### 1. Make a New Freestanding Repository

Make a new repository as part of the
[main UA QuickStart project](https://bitbucket.org/account/user/ua_drupal/projects/UAQS),
matching the repository settings to those in the other freestanding custom
modules (most importantly the settings “User and group access” and “Branch
permissions”). The repository name should follow the same pattern as the other
freestanding repositories (so something like `uaqs_admin`).

### 2. Add Some Initial Files to the Repository

Populate the new repository with some initial files. It does not matter too much
if subsequent changes are required before the new module or theme will work
within UA QuickStart, but to avoid breaking other automation there should at
least be an empty CHANGELOG.txt file (and README.md is always good, even if it
is minimal).

### 3. Make a ADDTOMONO_n Branch in a UA QuickStart Clone

In a local clone of the main `ua_drupal/ua_quickstart` repository make a new
branch whose name *must* start with `ADDTOMONO_`, so some command like

    git checkout -b ADDTOMONO_1111

that references a JIRA issue number is good. Be sure not to push this branch
back to the remote repository until the next change is complete.

### 4. Add a Placeholder File to the New Branch

Identify the subdirectory within the `ua_drupal/ua_quickstart` repository where
the new repository should appear as a subtree; for most modules this will be
`modules/custom`. Create a placeholder file there whose name is the freestanding
repository name prefixed with `ADDTOMONO_`. The content of the file does not
matter, so the commands could look like

    touch modules/custom/ADDTOMONO_uaqs_admin
    git add modules/custom/ADDTOMONO_uaqs_admin
    git commit -m 'Insert placeholder file.'

if the freestanding repository being added was `uaqs_admin`.

### 5. Push the Local ADDTOMONO_ Branch to the Main UA QuickStart repository

Assuming the local clone had the `ua_drupal/ua_quickstart` repository as its
origin remote, the example would look like

    git push origin ADDTOMONO_1111

This should immediately trigger the automation needed to graft the freestanding
repository into the `ua_drupal/ua_quickstart` repository at the position
specified by the placeholder file, delete the placeholder, and delete the
specially named temporary branch (`ADDTOMONO_1111` in this case).

### 6. Make Changes and Pull Requests Involving the New subtree

Once these steps are complete, the new subtree is available to feature in
changes and pull requests, just like all the others. Be careful never to push
branches named ADDTOMONO_... to the `ua_drupal/ua_quickstart` repository, or
create files whose names are prefixed with ADDTOMONO_, unless they are for
grafting in subtrees in this way.

## UA Community Module Contribution Guidelines

Although many of the custom modules packaged with UA Quickstart are maintained
as part of UA Quickstart project itself, it is also possible to make custom
modules maintained by others in the UA Drupal community available within UA
Quickstart without shifting the full maintenance responsibility for those
modules to the UA Digital team.

### UA Community Module Requirements

In order for a UA community module to be included with UA Quickstart, the module
should meet the following requirements.

- Module is named with an organization-specific prefix, e.g. `uits_module_name`.
- Module code is hosted in a publicly-accessible git repository (e.g. BitBucket
or GitHub) distinct from any other modules or themes.
- Module code adheres to [Drupal.org coding standards](https://www.drupal.org/docs/develop/standards/coding-standards).
- Module adheres to [Drupal.org branch and release naming conventions](https://www.drupal.org/node/1015226).
- At least one properly-named release tag is available for the module.
- Module provides functionality that is sufficiently generic to be usable by
more than one UA organization.
- Drupal 7.x modules containing features adhere to [best practices for avoiding
conflicts with other modules](https://swsblog.stanford.edu/blog/3-tips-making-your-drupal-features-highly-reusable).
- Module dependencies (e.g. contrib modules, libraries, patches) are explicitly
declared in a drush make file (Drupal 7.x) or composer.json file (Drupal 8.x)
included in the module codebase.

### UA Community Module Contribution Process

UA Drupal community module maintainers interested in proposing the addition a
custom module to be included with UA Quickstart should follow the steps outlined
above for [Contributing to the Project](#markdown-header-contributing-to-the-project)
to create and submit a pull request that adds an entry to the main
`drupal-org.make.yml` file in the UA Quickstart codebase for their custom module
repository similar to the existing `ua_cas` and `ua_google_tag` module entries.

Modules that are added to UA Quickstart in this way will be maintained similar
to the way that contributed modules from Drupal.org are maintained within UA
Quickstart.  When the UA community module maintainers update their module
repository, corresponding changes to the main UA Quickstart
`drupal-org.make.yml` file should be submitted as a pull request in order for
the changes to become available in UA Quickstart.

## Release management

Releases for UA QuickStart and its individual features/components happen at the
same time. When a new version of UA QuickStart is ready to be tagged for
release, all of the individual UA QuickStart component projects repositories
should also be tagged automatically with the same release version, whether
changes to the individual project have occurred or not. Anyone with rights to
push tags to the `ua_drupal/ua_quickstart` UA QuickStart repository _can_ make
a new release, but in practice the process _should_ only happen after an
extended review by the community.

To tag a new release, start from a clone of the `ua_drupal/ua_quickstart`
repository that is up to date with the remote version (assumed to be identified
as `origin` in the example). Use the `git tag -a` command to make a new tag in
the local clone, with a name following the agreed conventions for UA
QuickStart. So for example

     git tag -a 7.x-1.0-alpha7 -m 'Starting to backport UAMS Features.'

then simply push this to the `ua_drupal/ua_quickstart` repository.

    git push origin 7.x-1.0-alpha7

Automation should then take over, replicating the tag across all the
repositories and updating their CHANGELOG.txt files. It is important that all
the repositories, even those newly added, have at least an empty CHANGELOG.txt
file for the process to succeed. Finally, an additional packaging operation
should build the distribution, make the archive files from it, and publish these
on the
[downloads area](https://bitbucket.org/ua_drupal/ua_quickstart/downloads/).

## Testing a pull request against existing sites hosted on Pantheon.

####This process is only recommended for Bitbucket accounts that use two-factor authentication AND follow the instructions on securing your Bitbucket variables.

Sometimes, and especially when database updates are involved, you'll want to
ensure that a pull request be tested against an existing site.  To do this with
Pantheon here are the steps.

   1. Fork the main [UA Quickstart](https://bitbucket.org/ua_drupal/ua_quickstart/src/7.x-1.x/) repository to your
   personal Bitbucket account (that uses your @email.arizona.edu account).
   2. On the Bitbucket Account Settings page, go to the bottom left under Pipelines and add a Secured 
   [variable](https://confluence.atlassian.com/bitbucket/variables-in-pipelines-794502608.html#Variablesinpipelines-User-definedvariables) 
   called TERMINUS_MACHINE_TOKEN that contains a [Pantheon machine token](https://pantheon.io/docs/machine-tokens) with 
   access to the site(s) you wish to test with. NOTE: It is **VERY IMPORTANT** to set this variable to Secured because 
   otherwise it can show up in log files created by pipelines as plaintext.
   3. Then, go to the Branches page of the forked repo and click the ... on the right side next to the
   branch the Pull Request was created on.
   4. Select Run pipeline for branch and custom: test-in-pantheon-multidev
   5. Fill in the required fields of PANTHEON_SITE_NAME (the Pantheon machine name for the site you wish to test the PR
   on) and PANTHEON_ENV (dev/test/live environment you wish to create the multidev from).
   6. Your multidev site will be created and located at az-XXXX.pantheon.arizona.edu where the XXXX of the Jira ticket
   number in the pull request name UADIGITAL-XXXX.
