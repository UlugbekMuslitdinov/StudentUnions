#!/bin/bash
#
# UA Quickstart distribution deploy script.
#
# Copies the local test installation to a remote web server.
# For this to work, Drush aliases must exist for both the local source and
# remote target web sites, and the current user must have an SSH public key
# login to the remote server.

# Environment variables...

# The directory for staging database dumps:
: ${UAQSTEST_DUMPDIR:='dumps'}

# The Drush alias for the source (local) web site:
: ${UAQSTEST_SOURCE:='@uaquickstarttest'}

# The Drush alias for the target (remote) web site:
: ${UAQSTEST_TARGET:='@kitten'}

# Check the staging directory for database dumps...

if [ -d "$UAQSTEST_DUMPDIR" ]; then
  echo "Found the database dump staging directory ${UAQSTEST_DUMPDIR}..." >&2
else
  mkdir "$UAQSTEST_DUMPDIR"
  err="$?"
  if [ "$err" -ne 0 ]; then
    echo "** could not make the database dump staging directory ${UAQSTEST_DUMPDIR}: error code ${err}." >&2
    exit 1
  else
    echo "Made the database dump staging directory..." >&2
  fi
  if chmod 1777 "$UAQSTEST_DUMPDIR"; then
    echo "Gave the dump directory the same permissions as /tmp..." >&2
  else
    echo "** failed to set permissions on the database dump staging directory ${UAQSTEST_DUMPDIR}." >&2
    exit 1
  fi
fi

# Try synchronizing with a remote copy that everyone can see...

# Replace the remote database with a copy of the local one:
drush -y sql-sync "$UAQSTEST_SOURCE" "$UAQSTEST_TARGET"
err="$?"
if [ "$err" -ne 0 ]; then
  echo "** could not update the target (remote) database." >&2
  exit 1
else
  echo "Replaced the target database..." >&2
fi
# Remove the temporary files produced for image styles:
drush -y "$UAQSTEST_TARGET" image-flush --all
err="$?"
if [ "$err" -ne 0 ]; then
  echo "** could not clean out the image styles temporary files on the target site." >&2
  exit 1
else
  echo "Cleaned the target site image style files..." >&2
fi
# Copy local files to the remote site, deleting unmatched remote files:
drush -y rsync "$UAQSTEST_SOURCE" "$UAQSTEST_TARGET" --delete
if [ "$err" -ne 0 ]; then
  echo "** could not update the target (remote) site files." >&2
  exit 1
else
  echo "Replaced the target site files..." >&2
fi
# Clear cache on the remote site:
drush -y "$UAQSTEST_TARGET" cc all

exit 0
