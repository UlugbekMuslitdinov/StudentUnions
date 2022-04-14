#! /bin/sh
#------------------------------------------------------------------------------
# package-release.sh: build and package a tagged release using Jenkins.
#------------------------------------------------------------------------------

set -e

# Should already be a cloned Git repository directory on Jenkins.
: "${WORKSPACE:=$PWD}"

# Utility functions
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

[ -n "$GIT_BRANCH" ] \
  || errorexit "Could not determine the Git branch or tag."
logmessage "Working on Git branch or tag ${GIT_BRANCH}"
tag=$(echo "$GIT_BRANCH" | awk -F'/' '{ print $NF; }') \
  || errorexit "Failed while parsing the branch or tag"
[ -n "$tag" ] \
  || errorexit "Could not determine the Git tag"
logmessage "Using tag ${tag}"

distroname='ua_quickstart'
artefact="${distroname}-${tag}"
tarball="${artefact}.tar.gz"
zipfile="${artefact}.zip"

[ ! -e "$tarball" ] \
  || errorexit "Stale tarball ${tarball}"
[ ! -e "$zipfile" ] \
  || errorexit "Stale zipfile ${zipfile}"
logmessage "Using ${tarball} and ${zipfile} as the archive files"

scratchdir=$(mktemp -d -t "${distroname}_XXXXXX") \
  || errorexit "Could not create a scratch directory"
trap 'rm -Rf "${scratchdir}"; exit "$?"' EXIT TERM INT QUIT
logmessage "Building in ${scratchdir}"

distrobuilddir="${scratchdir}/${distroname}"
distromakefile='build-ua_quickstart.make.yml'
[ -r "$distromakefile" ] \
  || errorexit "${distromakefile} makefile missing"
drush make --no-cache "$distromakefile" "$distrobuilddir" \
  || errorexit "Crashed while building ${distrobuilddir} from ${distromakefile}"
[ -d "$distrobuilddir" ] \
  || errorexit "The build did not create the expected directory ${distrobuilddir}"
sitesdefault="$distrobuilddir/sites/default"
[ -r "$sitesdefault" ] \
  || errorexit "Tested for a complete distribution by looking for ${sitesdefault}, but did not find it"
logmessage "Built the distribution in ${distrobuilddir}"

( cd "$scratchdir" ; tar --exclude .gitignore --exclude .git -c -z -f "${WORKSPACE}/${tarball}" "$distroname" ) \
  || errorexit "Could not create the tarball ${tarball}"
( cd "$scratchdir" ; zip -q -r "${WORKSPACE}/${zipfile}" "$distroname" -x'*.git*' ) \
  || errorexit "Could not create the zipfile ${zipfile}"
logmessage "Made the archive files ${tarball} and ${zipfile}"

uploader='devtools/ua_drupal_test/uaqstest_bb_upload.sh'
[ -x "$uploader" ] \
  || errorexit "Did not find the ${uploader} archive file uploader script"
"$uploader" "${tarball}" "${zipfile}"

normalexit "Finished packaging the ${tag} release for ${distroname}"
