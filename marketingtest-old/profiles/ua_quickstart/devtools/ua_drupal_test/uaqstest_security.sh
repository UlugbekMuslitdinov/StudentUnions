#!/bin/bash
#===============================================================================
#
# UA Quickstart distribution security tests.
#
# https://github.com/sensiolabs/security-checker
#
#===============================================================================

EXIT_STATUS=0

if [[ -z ${1} ]]; then
  BASE_DIR='.'
else
  BASE_DIR="${1}"
fi

if [[ -n $(command -v symfony) ]]; then
  echo -e "\nusing symfony\n"
  while read -r lockfile; do
    echo -e "\nchecking ${lockfile}\n"
    if ! symfony security:check --dir="$(dirname "${lockfile}")"; then
      EXIT_STATUS=1
    fi
  done < <(find "${BASE_DIR}" -name composer.lock)
else
  echo -e "\nusing security-checker.phar\n"
  curl -sL https://get.sensiolabs.org/security-checker.phar > /tmp/security-checker.phar
  while read -r lockfile; do
    echo -e "\nchecking ${lockfile}\n"
    if ! php /tmp/security-checker.phar security:check "${lockfile}"; then
      EXIT_STATUS=1
    fi
  done < <(find "${BASE_DIR}" -name composer.lock)
fi

exit ${EXIT_STATUS}
