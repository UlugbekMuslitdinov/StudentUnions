#!/bin/sh
#------------------------------------------------------------------------------
#
# uaqstest_drupal_cleanup.sh: restore the pre-test state of a Drupal site.
#
# Required environment variables
# - UAQSTEST_SCRATCHDIR The path to a directory from which to restore the state.
#------------------------------------------------------------------------------

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

for prog in composer drush tar ; do
  command -v "$prog" > /dev/null \
    || errorexit "Can't find the ${prog} command"
done
[ -d "$UAQSTEST_SCRATCHDIR" ] \
  || errorexit "Could not find the ${UAQSTEST_SCRATCHDIR} temporary work directory"
[ -d "$UAQSTEST_DRUPALROOT" ] \
  || errorexit "Could not find the ${UAQSTEST_DRUPALROOT} top-level Drupal directory"
[ -d "$filespath" ] \
  || errorexit "Could not find the ${filespath} Drupal files subdirectory"

#------------------------------------------------------------------------------
# Composer cleanup (its main changes are in the ephemeral $UAQSTEST_SCRATCHDIR).

composer clear-cache \
  || errorexit "Failed to clear the composer cache"

#------------------------------------------------------------------------------
# Trash the modified database and files, restore the saved copies.

drush sql-drop --root="$UAQSTEST_DRUPALROOT" -y \
  || errorexit "Failed to wipe the modified database"
drush sql-query --root="$UAQSTEST_DRUPALROOT" --file="${UAQSTEST_SCRATCHDIR}/${UAQSTEST_DB_DUMP}" \
  || errorexit "Failed to restore the initial database state from the ${UAQSTEST_DB_DUMP} file"
rm -Rf "$filespath" \
  || errorexit "Failed to delete the modified ${filespath} Drupal files subdirectory"
cd "$sitepath" \
  || errorexit "Couldn't change to the ${sitepath} Drupal site subdirectory"
tar xf "${UAQSTEST_SCRATCHDIR}/${UAQSTEST_FILES_ARCHIVE}" \
  || errorexit "Failed to restore the ${UAQSTEST_FILES_ARCHIVE} archive of the ${filespath} directory tree"

#------------------------------------------------------------------------------
# Clear all the drush caches.

drush cc all \
  || errorexit "Normal drush cache-clear failed"
drush cc drush \
  || errorexit "Clearing drush's own cache failed"

exit 0
