#!/usr/bin/env bash

# Add some color bling
GREEN='\033[0;32m'
RESET='\033[0m'

# Initialized main parameters
ITERATIONS=''
REVOLUTIONS=''
FILESIZE=1

while getopts "i:r:s:" opt; do
  case $opt in
    i)
      ITERATIONS="--iterations $OPTARG"
      echo "${GREEN}Set $OPTARG Iterations\n ${RESET}" >&2
      ;;
    r)
      REVOLUTIONS="--revs $OPTARG"
      echo "${GREEN}Set $OPTARG Revolutions\n ${RESET}" >&2
      ;;
    s)
      FILESIZE=$OPTARG
      INMB=$((OPTARG * 1000))
      echo "${GREEN}Set $INMB KB as File Size to Process\n ${RESET}" >&2
      ;;
  esac
done

export FILESIZE

phpbench run ../code/JsonYaml.php --progress=histogram --report=aggregate $ITERATIONS $REVOLUTIONS