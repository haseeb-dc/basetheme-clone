unameOut="$(uname -s)"
case "${unameOut}" in
    Linux*)     echo "You Are Running Linux - " && . $HOME/.nvm/nvm.sh; nvm use ;;
    Darwin*)    echo "You Are Running Mac - "  && . $HOME/.nvm/nvm.sh; nvm use && NODE_ENV="devlopment";;
    CYGWIN*)    echo "You Are Running Window 10 -" && node_version=`cat .nvmrc`;;
    MINGW*)     echo "You Are Running Window 10 -" && node_version=`cat .nvmrc`;;
    *)          echo "UNKNOWN:${unameOut}"
esac
