#!/bin/bash
#
# UA Quickstart distribution Drupal installation script.
#
# Required environment variables...

# The password for the user with all necessary rights on the database:
if [ x"$UAQSTEST_DBPASS" = x ]; then
  echo "** no password for the database user (must set UAQSTEST_DBPASS)." >&2
  exit 1
fi

# The password for the Drupal administrative user (User1):
if [ x"$UAQSTEST_USER1PASS" = x ]; then
  echo "** no password for the Drupal administrative user (must set UAQSTEST_USER1PASS)." >&2
  exit 1
fi

# Environment variables that we might write to...

# The path to the Drupal root directory:
if [ x"$UAQSTEST_DRUPALROOT" = x ]; then
  export UAQSTEST_DRUPALROOT="${PWD}/ua_quickstart_test"
fi

# Environment variables to optionally read but not write...

# MySQL user (with all necessary rights on the database):
: ${UAQSTEST_DBUSER:='uaqstestdbadmin'}

# MySQL database name:
: ${UAQSTEST_DBNAME:='uaqstestdb'}

# MySQL database type:
: ${UAQSTEST_DBTYPE:='mysql'}

# MySQL database host (as name or address:port):
: ${UAQSTEST_DBHOST:='localhost'}

# Profile-specific flag settings (in the format form.field=value):
: ${UAQSTEST_FLAGS:='ua_quickstart_install_options_form.uaqs_verbosity=1'}

# Drupal administrative user (User1) name:
: ${UAQSTEST_USER1NAME:='userone'}

# Drupal site email address:
: ${UAQSTEST_SITEEMAIL:='webmaster@uaquickstart.arizona.edu'}

# Drupal site name:
: ${UAQSTEST_SITENAME:='UA Quickstart'}

# Drupal installation profile:
: ${UAQSTEST_PROFILE:='ua_quickstart'}

# Group to which the local web server and current user both belong:
: ${UAQSTEST_WEBGROUP:='www-data'}

# Test that the specified database user can connect...

if mysql -u "$UAQSTEST_DBUSER" -p"$UAQSTEST_DBPASS" -e 'exit'; then
  echo "Can communicate with the database server..." >&2
else
  echo "** database server not available to the user ${UAQSTEST_DBUSER}." >&2
  exit 1
fi

# Delete any existing database...

if mysql -u "$UAQSTEST_DBUSER" -p"$UAQSTEST_DBPASS" -e "DROP DATABASE IF EXISTS ${UAQSTEST_DBNAME}"; then
  echo "Deleted any existing database..." >&2
else
  echo "** could not drop and re-create the database ${UAQSTEST_DBNAME} when connecting as the user ${UAQSTEST_DBUSER}." >&2
  exit 1
fi

# Start afresh with a new database...

if mysql -u "$UAQSTEST_DBUSER" -p"$UAQSTEST_DBPASS" -e "CREATE DATABASE ${UAQSTEST_DBNAME}"; then
  echo "Created a new database ${UAQSTEST_DBNAME}..." >&2
else
  echo "** could not create the database ${UAQSTEST_DBNAME} when connecting as the user ${UAQSTEST_DBUSER}." >&2
  exit 1
fi

# Site install; this should generate the working Drupal site for testing...

initial_path="$PWD"
cd "$UAQSTEST_DRUPALROOT"
if drush site-install "$UAQSTEST_PROFILE" "$UAQSTEST_FLAGS" --account-mail="$UAQSTEST_SITEEMAIL" --account-name="$UAQSTEST_USER1NAME" --db-url="$UAQSTEST_DBTYPE"://"$UAQSTEST_DBUSER":"$UAQSTEST_DBPASS"@"$UAQSTEST_DBHOST"/"$UAQSTEST_DBNAME" --site-name="$UAQSTEST_SITENAME" -y; then
  echo "Successfully installed the site with demonstration content..." >&2
else
  echo "** the Drupal site install failed (before any actual testing)." >&2
  exit 1
fi
if drush user-password "$UAQSTEST_USER1NAME" --password="$UAQSTEST_USER1PASS"; then
  echo "Re-set the Drupal User1 (${UAQSTEST_USER1NAME}) password..." >&2
else
  echo "** failed to set the pre-defined Drupal User1 (${UAQSTEST_USER1NAME}) administrator password." >&2
  exit 1
fi

# Fix up the files directory subtree group ownership and permissions...

filessubtree="${UAQSTEST_DRUPALROOT}/sites/default/files"
find "$filessubtree" ! -name '\.*' -exec chgrp "$UAQSTEST_WEBGROUP" {} \;
err="$?"
if [ "$err" -ne 0 ]; then
  echo "** could not assign the ${filessubtree} directory subtree to the ${UAQSTEST_WEBGROUP} group: error code ${err}." >&2
  exit 1
else
  echo "Set the group ${UAQSTEST_WEBGROUP} on the ${filessubtree} directory subtree..." >&2
fi
find "$filessubtree" -type d -exec chmod 2775 {} \;
err="$?"
if [ "$err" -ne 0 ]; then
  echo "** could not make the ${filessubtree} directories group-writeable: error code ${err}." >&2
  exit 1
else
  echo "Made the ${filessubtree} directories group-writeable..." >&2
fi
find "$filessubtree" ! -name '\.*' -a -type f -exec chmod 664 {} \;
err="$?"
if [ "$err" -ne 0 ]; then
  echo "** could not make the ${filessubtree} files group-writeable: error code ${err}." >&2
  exit 1
else
  echo "Made the ${filessubtree} files group-writeable..." >&2
fi

cd "$initial_path"
exit 0