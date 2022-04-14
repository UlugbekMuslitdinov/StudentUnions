#!/bin/sh
#------------------------------------------------------------------------------
#
# uaqstest_drupal_save.sh: save the current state of a Drupal site.
#
# Required environment variables
# - UAQSTEST_SCRATCHDIR The path to the directory in which to save the state.
##------------------------------------------------------------------------------

set -e

#------------------------------------------------------------------------------
# Optional environment variables with simple defaults.

# The database dump file name
: "${UAQSTEST_DB_DUMP:=db_pre_tests.sql}"

# The top-level Drupal directory
: "${UAQSTEST_DRUPALROOT:=/var/www/html}"

# The files directory subtree tar archive filename
: "${UAQSTEST_FILES_ARCHIVE:=files_pre_tests.tar}"

# Relative path to the site parent directory of the files subtree
: "${UAQSTEST_SITE_DIR:=sites/default}"

sitepath="${UAQSTEST_DRUPALROOT}/${UAQSTEST_SITE_DIR}"
filespath="${sitepath}/files"

#------------------------------------------------------------------------------
# Utility function definitions.

errorexit () {
  echo "** $1." >&2
  exit 1
}

#------------------------------------------------------------------------------
# Initial setup checks.

command -v drush > /dev/null \
  || errorexit "Couldn't find the drush command"
command -v tar > /dev/null \
  || errorexit "Couldn't find the tar command"
[ -d "$UAQSTEST_SCRATCHDIR" ] \
  || errorexit "Could not find the ${UAQSTEST_SCRATCHDIR} temporary work directory"
[ -d "$UAQSTEST_DRUPALROOT" ] \
  || errorexit "Could not find the ${UAQSTEST_DRUPALROOT} top-level Drupal directory"
[ -d "$filespath" ] \
  || errorexit "Could not find the ${filespath} Drupal files subdirectory"

#------------------------------------------------------------------------------
# Save files.

drush sql-dump --root="$UAQSTEST_DRUPALROOT" --result-file="${UAQSTEST_SCRATCHDIR}/${UAQSTEST_DB_DUMP}" \
  || errorexit "Failed to dump the ${UAQSTEST_DB_DUMP} file from the initial database state"
cd "$sitepath" \
  || errorexit "Couldn't change to the ${sitepath} Drupal site subdirectory"
tar cf "${UAQSTEST_SCRATCHDIR}/${UAQSTEST_FILES_ARCHIVE}" files \
  || errorexit "Failed to save the ${UAQSTEST_FILES_ARCHIVE} archive of the ${filespath} directory tree"
