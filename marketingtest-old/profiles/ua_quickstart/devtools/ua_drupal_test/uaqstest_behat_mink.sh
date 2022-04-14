#!/bin/sh
#------------------------------------------------------------------------------
#
# uaqstest_behat_mink.sh: run the Arizona Quickstart Behat tests.
#
# Required environment variables
# - UAQSTEST_BASEURL the URL for the test site on a local web server.
#------------------------------------------------------------------------------

set -e

#------------------------------------------------------------------------------
# Environment variables and semi-constants.

# Composer executables ditectory
: "${COMPOSER_BIN_DIR:=${PWD}/bin}"

# The Drupal root directory name:
: "${UAQSTEST_DRUPALROOT:=${PWD}/ua_quickstart_test}"

# Whether to hold off running the full set of tests immediately:
: "${UAQSTEST_RUNTESTS:=1}"

#------------------------------------------------------------------------------
# Utility function definitions.

logmessage () {
  echo "$1..." >&2
}
normalexit () {
  echo "$1." >&2
  exit 0
}
errorexit () {
  echo "** $1." >&2
  exit 1
}

#------------------------------------------------------------------------------
# Sanity checks.

[ -n "$UAQSTEST_BASEURL" ] \
  || errorexit 'no local web server URL for the Drupal test site (must set UAQSTEST_BASEURL)'
[ -r composer.lock ] \
  || errorexit "Could not find the composer.lock file in the current directory"
composer -V \
  || errorexit "Could not find a working composer"

#------------------------------------------------------------------------------
# Regenerate the Behat installation.

composer install \
  || errorexit "Failed with the initial composer setup for Behat"
behatbin="${COMPOSER_BIN_DIR}/behat"
[ -x "$behatbin" ] \
  || errorexit "Couldn't find the ${behatbin} executable"

#------------------------------------------------------------------------------
# Export Behat environment specific settings.

export BEHAT_PARAMS='{"extensions": {"Behat\\MinkExtension": {"base_url": "'"$UAQSTEST_BASEURL"'"},"Drupal\\DrupalExtension": {"drupal": {"drupal_root": "'"${UAQSTEST_DRUPALROOT}"'"}, "drush": {"root": "'"${UAQSTEST_DRUPALROOT}"'"}}}}'

#------------------------------------------------------------------------------
# Run the tests.

if [ "$UAQSTEST_RUNTESTS" -eq 0 ]; then
  logmessage "Skipping running the actual tests"
else
  "$behatbin" \
    || errorexit "Some of the Behat + Mink tests failed: error code ${?}"
  logmessage "The Behat + Mink tests passed"
fi

normalexit "Tests completed"
