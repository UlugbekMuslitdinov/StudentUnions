#!/bin/sh
#------------------------------------------------------------------------------
#
# uaqstest_bb_upload.sh: upload build artefacts to Bitbucket download areas.
#
# Parameters:
#   List of file paths to upload.
# Returns:
#   0 on success, 1 on any error.
#
# This uses the curl utility and the mechanism described at
# https://developer.atlassian.com/bitbucket/api/2/reference/resource/repositories/%7Busername%7D/%7Brepo_slug%7D/downloads#post
# See also:
# https://confluence.atlassian.com/bitbucket/deploy-build-artifacts-to-bitbucket-downloads-872124574.html
# but although the environment variables for direct Bitbucket Pipelines support
# are included, this has only been tested with Jenkins so far.
#
# OAuth authentication is needed, and must follow the Client Credentials Grant
# flow from RFC-6749 section 4.4 https://tools.ietf.org/html/rfc6749#section-4.4
# See also:
# https://developer.atlassian.com/bitbucket/api/2/reference/meta/authentication
# It does not use the Authorization Code Grant and Implicit Grant flows
# documented at
# https://confluence.atlassian.com/bitbucket/oauth-on-bitbucket-cloud-238027431.html
# which require an additional approval step that would be pointless to automate.
# The Bitbucket Cloud build status notifier plugin for Jenkins
# https://github.com/jenkinsci/bitbucket-build-status-notifier-plugin
# uses the same Client Credentials Grant flow.
# Note that we assume the uploads complete within the lifetime of the OAuth
# access token, but if this is ever a problem (the current lifetime is one hour)
# the refresh token is available to renew it (in the initial response string).
#
# There was originally no documented mechanism for uploading files to Bitbucket
# repository Downloads areas, so many people requested this feature
# https://bitbucket.org/site/master/issues/3251/add-custom-file-uploads-to-rest-api-bb
# and early versions were based on a script that initially emulated manual
# browser uploads instead of using the API,
# https://bitbucket.org/Swyter/bitbucket-curl-upload-to-repo-downloads
#------------------------------------------------------------------------------

#------------------------------------------------------------------------------
# Environment variables and semi-constants.

# Repository owner: internal Bitbucket settings override anything else.
[ -n "$BITBUCKET_REPO_OWNER" ] && \
  UAQSTEST_REPO_OWNER="$BITBUCKET_REPO_OWNER"
: "${UAQSTEST_REPO_OWNER:=ua_drupal}"

# Repository machine name: internal Bitbucket settings override anything else.
[ -n "$BITBUCKET_REPO_SLUG" ] && \
  UAQSTEST_REPO_SLUG="$BITBUCKET_REPO_SLUG"
: "${UAQSTEST_REPO_SLUG:=ua_quickstart}"

#------------------------------------------------------------------------------
# Utility function definitions.

errorexit () {
  echo "** $1." >&2
  exit 1
}

# Show progress on STDERR, unless explicitly quiet.
if [ -z "$UAQSTEST_QUIET" ]; then
  logmessage () {
    echo "$1..." >&2
  }
  normalexit () {
    echo "$1." >&2
    exit 0
  }
else
  logmessage () {
    return
  }
  normalexit () {
    exit 0
  }
fi

#------------------------------------------------------------------------------
# Initial run-time error checking.

# The Bitbucket OAuth consumer credentials:
[ -n "$UAQSTEST_BBOAUTHCREDS" ] || \
  errorexit "No Bitbucket OAuth consumer credentials"

[ "$#" -gt 0 ] || \
  errorexit "No files specified for upload"

#------------------------------------------------------------------------------
# Request an access token. See: https://tools.ietf.org/html/rfc6749#section-4.4

token_endpoint='https://bitbucket.org/site/oauth2/access_token'
tokenfail='Could not obtain an OAuth access token'
tokenname='"access_token":'
resp=$(curl -s -S -X POST --user "$UAQSTEST_BBOAUTHCREDS" "$token_endpoint" --data grant_type=client_credentials)
err="$?"
[ "$err" -eq 0 ] || \
  errorexit "${tokenfail}, curl returned '${err}'"
[ -n "$resp" ] || \
  errorexit "${tokenfail}, empty response from ${token_endpoint}"
echo "$resp" | grep -v -q 'error'
err="$?"
[ "$err" -eq 0 ] || \
  errorexit "${tokenfail}, ${token_endpoint} responded ${resp}"
echo "$resp" | grep -q "$tokenname"
err="$?"
[ "$err" -eq 0 ] || \
  errorexit "${tokenfail}, ${token_endpoint} did not include ${tokenname} in ${resp}"
access_token=$(echo "$resp" | sed -e 's/^.*'"$tokenname"'[ \t\n\r]*"\([^"]*\)".*$/\1/')
[ -n "$access_token" ] || \
  errorexit "${tokenfail}, ${token_endpoint} sent an empty ${tokenname} in ${resp}"
logmessage "Obtained an access token from ${token_endpoint}"

#------------------------------------------------------------------------------
# Actual upload operation.

apiurl="https://api.bitbucket.org/2.0/repositories/${UAQSTEST_REPO_OWNER}/${UAQSTEST_REPO_SLUG}/downloads"

for af in "$@" ; do
  logmessage "Uploading the artefact file ${af} to ${apiurl}"
  [ -e "$af" ] || \
    errorexit "Could not find the upload file"
  mess=$(curl -s -S -X POST -H "Authorization: Bearer ${access_token}" "$apiurl" --form files=@"$af")
  err="$?"
  [ "$err" -eq 0 ] || \
    errorexit "Could not upload, curl returned '${err}'"
  [ -z "$mess" ] || \
    logmessage "Warning: received a possible error message '${mess}'"
  logmessage "Upload finished"
done
normalexit "All uploads complete"
