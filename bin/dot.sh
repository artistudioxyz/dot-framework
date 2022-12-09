#!/bin/bash

##############
# LOGO
##############
cat << "EOF"
༼ つ ◕_◕ ༽つ DOT Framework
a Simple WordPress Utility Library for building better Plugins and Themes.
Learn More: https://github.com/artistudioxyz/dot-framework
EOF

##############
# HELP
##############
function Help(){
   # Display Help
   echo
   echo "Options:"
   echo "--help          Print this Help."
   echo "--replace       Replace mode"
   echo " -d             Set directory to be replaced"
   echo " --namespace    Replace namespace only (TODO: haven't implemented yet)"
   echo " --file         Replace filename only (TODO: haven't implemented yet)"
   echo
}