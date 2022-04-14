#!/bin/bash
#
# UA Quickstart distribution Drupal download script.
#
# Assumes that a built and packaged archive of the UA Quickstart distribution
# is available at a public URL, and there is Internet access.

# Environment variables that we might write to...

# The Drupal root directory name:
if [ x"$UAQSTEST_DRUPALROOT" = x ]; then
  export UAQSTEST_DRUPALROOT="${PWD}/ua_quickstart_test"
fi

# Environment variables to read but not write...

# The command which fetches a remote URL onto standard output:
if [ x"$UAQSTEST_FETCH" = x ]; then
  curl -V > /dev/null
  if [ "$?" -eq 0 ]; then
    UAQSTEST_FETCH='curl -sS'
  else
    wget -V > /dev/null
    if [ "$?" -eq 0 ]; then
      UAQSTEST_FETCH='wget -O -'
    else
      echo "** could not find a command to download files from URLs." >&2
      exit 1
    fi
  fi
fi

# URL for a location containing the UA Quickstart pre-built packaged archive:
: ${UAQSTEST_URLSTEM:='http://jenkins.ltrr.arizona.edu/job/ua_quickstart/lastSuccessfulBuild/artifact/'}

# The specific file name for the archive:
: ${UAQSTEST_ARCHIVE:='ua_quickstart-7.x-1.x-dev.tar.gz'}

# The trailing part of the URL, giving the file to download:
: ${UAQSTEST_URLARCHIVE:=$UAQSTEST_ARCHIVE}

# The name of the directory produced by extracting the UA Quickstart archive:
: ${UAQSTEST_EXTRACTDIR:='ua_quickstart'}

# A directory to hold temporary downloaded files:
: ${UAQSTEST_DOWNLOADS:="$PWD"}

# Download the pre-built packaged UA Quickstart distribution...

local_archive_path="${UAQSTEST_DOWNLOADS}/${UAQSTEST_ARCHIVE}"
$UAQSTEST_FETCH "${UAQSTEST_URLSTEM}${UAQSTEST_URLARCHIVE}" > "$local_archive_path"
err="$?"
if [ "$err" -ne 0 ]; then
  echo "** could not download the packaged UA Quickstart distribution: error code ${err}." >&2
  exit 1
else
  echo "Downloaded a copy of the packaged UA Quickstart distribution..." >&2
fi
if [ -s "$local_archive_path" ] ; then
  echo "Found the distribution archive..." >&2
else
  echo "** could not find a non-empty distribution archive at ${local_archive_path}." >&2
  exit 1
fi

# Remove any previous extracted distribution in the download directory...

local_extract_path="${UAQSTEST_DOWNLOADS}/${UAQSTEST_EXTRACTDIR}"
if [ -e "$local_extract_path" ]; then
  echo "-- removing a previously extracted distribution at ${local_extract_path}." >&2
  rm -Rf "$local_extract_path"
  err="$?"
  if [ "$err" -ne 0 ]; then
    echo "** could not remove the previously extracted distribution: error code ${err}." >&2
    exit 1
  else
    echo "Removed the old extracted distribution..." >&2
  fi
fi

# Extract the UA Quickstart distribution within the download directory...

echo "$UAQSTEST_ARCHIVE" | grep -i -q '\.zip$'
nonzip="$?"
if [ "$nonzip" -eq 1 ]; then
  tar xzf $local_archive_path -C $UAQSTEST_DOWNLOADS
  err="$?"
else
  unzip -d $UAQSTEST_DOWNLOADS $local_archive_path
  err="$?"
fi
if [ "$err" -ne 0 ]; then
  echo "** could not extract the ${local_archive_path} packaged distribution: error code ${err}." >&2
  exit 1
else
  echo "Extracted the packaged distribution..." >&2
fi
if [ -d "$local_extract_path" ]; then
  echo "Found the extracted directory tree..."
else
  echo "** could not find the directory ${local_extract_path} containing the extracted distribution: error code ${err}." >&2
  exit 1
fi

# Move the extracted distribution to its final destination...

mv "$local_extract_path" "$UAQSTEST_DRUPALROOT"
err="$?"
if [ "$err" -ne 0 ]; then
  echo "** could not move the extracted UA Quickstart distribution from ${local_extract_path} to ${UAQSTEST_DRUPALROOT}: error code ${err}." >&2
  exit 1
else
  echo "Moved the UA Quickstart distribution to a location known to a local web server..." >&2
fi

# Set up for default (not named site) Drupal installation...

sitesdefault="${UAQSTEST_DRUPALROOT}/sites/default/"
if [ -r "$sitesdefault" ]; then
  echo "Found the ${sitesdefault} directory in the distribution..." >&2
else
  echo "** the distribution is incomplete: ${sitesdefault} directory missing." >&2
  exit 1
fi
defaultsettings='default.settings.php'
if [ -r "${sitesdefault}${defaultsettings}" ]; then
  echo "Found the ${defaultsettings} file in the distribution..." >&2
else
  echo "** the distribution is incomplete: ${defaultsettings} file missing." >&2
  exit 1
fi
mkdir "${sitesdefault}files"
if chmod 775 "${sitesdefault}files"; then
  echo "Made a group-writable files directory..." >&2
else
  echo "** could not make a group-writable files directory." >&2
  exit 1
fi

exit 0