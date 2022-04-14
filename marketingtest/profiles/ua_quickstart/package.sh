#!/bin/bash
#
# Build & packaging script for Jenkins.
#

distroname='ua_quickstart'
if [ "$GIT_BRANCH" ] ; then
  echo "Working on Git branch ${GIT_BRANCH}..." >&2
else
  echo "** could not determine the Git branch." >&2
  exit 1
fi
branch=`echo "$GIT_BRANCH" | awk -F'/' '{ print $NF; }'`
if [ "$branch" ] ; then
  echo "Using ${branch} as the branch name..." >&2
else
  echo "** could not determine the branch name." >&2
  exit 1
fi
artefact="${distroname}-${branch}-dev"
tarball="${artefact}.tar.gz"
zipfile="${artefact}.zip"
if [ -e "$tarball" ] ; then
  echo "** stale tarball $tarball." >&2
  exit 1
else
  echo "Cleaned the distribution tarball..." >&2
fi
if [ -e "$zipfile" ] ; then
  echo "** stale zipfile $zipfile." >&2
  exit 1
else
  echo "Cleaned the distribution zipfile..." >&2
fi
distrobuilddir="$distroname"
if [ -d "$distrobuilddir" ]; then
  echo "** found a stale $distrobuilddir directory." >&2
  exit 1
else
  echo "Found a clean working directory..." >&2
fi
distromakefile='build-ua_quickstart.make.yml'
if [ -r "$distromakefile" ]; then
  echo "Found the $distromakefile makefile..." >&2
else
  echo "** $distromakefile makefile missing." >&2
  exit 1
fi
if drush make --no-cache "$distromakefile" "$distrobuilddir" ; then
  echo "Made a distribution from the $distromakefile makefile..." >&2
else
  echo "** drush make failed..." >&2
  exit 1
fi
if [ -d "$distrobuilddir" ] && [ -x "$distrobuilddir" ]; then
  echo "Successfully created the $distrobuilddir directory..." >&2
else
  echo "** failed to make the $distrobuilddir directory." >&2
  exit 1
fi
sitesdefault="$distrobuilddir/sites/default"
if [ -r "$sitesdefault" ]; then
  echo "Found the $sitesdefault file in the distribution..." >&2
else
  echo "** the distribution is incomplete: $sitesdefault file missing." >&2
  rm -Rf "$distrobuilddir"
  exit 1
fi
( cd "$WORKSPACE" ; tar --exclude .gitignore --exclude .git -c -z -f - "$distrobuilddir" ) > "$tarball"
if [ -s "$tarball" ] ; then
  echo "Created the distribution tarball..." >&2
else
  echo "** could not create the tarball $tarball." >&2
  rm -Rf "$distrobuilddir"
  exit 1
fi
( cd "$WORKSPACE" ; zip -q -r - "$distrobuilddir" -x\*.git* ) > "$zipfile"
if [ -s "$zipfile" ] ; then
  echo "Created the distribution zipfile..." >&2
else
  echo "** could not create the zipfile $zipfile." >&2
  rm -Rf "$distrobuilddir"
  exit 1
fi
rm -Rf "$distrobuilddir"
exit 0
