#!/bin/bash

#------------------------------------------------------------------------------
#
# generate-ca-bundle.sh: generates a certificate authority bundle file
#
#------------------------------------------------------------------------------

OUTFILE='bundle.pem'

if [[ -f "${OUTFILE}" ]]; then
  echo "${OUTFILE} already exists"
  exit 1
fi

for NUM in 1 2 3 4; do
  curl -s "https://www.amazontrust.com/repository/AmazonRootCA${NUM}.pem" >> ${OUTFILE}
done

curl -s "https://www.amazontrust.com/repository/SFSRootCAG2.pem" >> ${OUTFILE}

curl -s 'https://www.incommon.org/custom/certificates/repository/sha384%20Intermediate%20cert.txt' >> ${OUTFILE}
