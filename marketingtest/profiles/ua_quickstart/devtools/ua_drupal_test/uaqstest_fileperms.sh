#!/bin/sh
#------------------------------------------------------------------------------
#
# uaqstest_fileperms.sh: fix permissions on the Drupal files directory subtree.
#
# Parameters:
# $1 - web root directory (string).
# $2 - group to be assigned full rights in the files directory subtree (string).
# Returns:
#   0 on success, 1 on any error.
#
#------------------------------------------------------------------------------

set -e

#------------------------------------------------------------------------------
# Utility functions definitions.

errorexit () {
  echo "** $1." >&2
  exit 1
}

#------------------------------------------------------------------------------
# Command-line arguments override any environment variables.

[ -n "$1" ] && \
  webroot="$1"
: "${webroot:=$UAQSTEST_DRUPALROOT}"

[ -n "$2" ] && \
  webgroup="$2"
: "${webgroup:=$UAQSTEST_WEBGROUP}"

filespath="${webroot}/sites/default/files"

#------------------------------------------------------------------------------
# Final parameter checks.

[ -d "$filespath" ] \
  || errorexit "The Drupal site files directory ${filespath} is missing"
[ -n "$webgroup" ] \
  || errorexit "No group specified to allow the web server to modify files"

#------------------------------------------------------------------------------
# Process the directory subtree.

find "$filespath" ! -name '\\.*' -exec chgrp "$webgroup" {} \; \
  || errorexit "Could not set ${webgroup} group ownership in ${filespath}"
find "$filespath" -type d -exec chmod 2775 {} \; \
  || errorexit "Could not set ${filespath} directory permissions"
find "$filespath" ! -name '\\.*' -a -type f -exec chmod 664 {} \; \
    || errorexit "Could not set ${filespath} file permissions"

exit 0
