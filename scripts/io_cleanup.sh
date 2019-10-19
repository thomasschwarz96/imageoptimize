#!/bin/bash
# ====================================================================
# _____ _                      ___     _                       ___  __
#|_   _| |_  ___ _ __  __ _ __/ __| __| |___ __ ____ _ _ _ ___/ _ \/ /
# | | | ' \/ _ \ '  \/ _` (_-<__ \/ _| ' \ V  V / _` | '_|_ /\_, / _ \
# |_| |_||_\___/_|_|_\__,_/__/___/\__|_||_\_/\_/\__,_|_| /__| /_/\___/
# ====================================================================

COLOR="\033[0;33m"
NOCOLOR="\033[0m"

printf "${COLOR}===========================${NOCOLOR}\n"
printf "${COLOR}IO Cleanup is preparing...${NOCOLOR}\n"

printf "Creating variables..."
uploadPath="../uploads/"
cleanupExclude="index.html"
printf "\n\n"

printf "${COLOR}===========================${NOCOLOR}\n"
printf "${COLOR}IO Cleanup is starting...${NOCOLOR}\n"

printf "Changing directory to: "
cd $uploadPath
pwd

printf "Cleanup...\n"
find . ! -name "$cleanupExclude" -type f -exec rm -f -v {} +
printf "\n"

printf "${COLOR}===========================${NOCOLOR}\n"
printf "${COLOR}IO Cleanup is finished.${NOCOLOR}\n"
