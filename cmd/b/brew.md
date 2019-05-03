# brew

> The missing package manager for macOS

Usage

```bash
# COMMON #

# Search for a package
brew search git
# Install …
brew install git
# Uninstall …
brew uninstall git
brew remove git
brew rm git
# Upgrade …
brew upgrade git
# Upgrade all
brew upgrade
# Update brew & cask (itself)
brew update
# List installed
brew list
brew ls

# VERSIONS #

# See what versions you have
brew list --versions git
# Change version
brew switch git 2.5.0
# ( Link is also for switching version. )
# Unlink …
brew unlink git
# Link …
brew link git
brew ln git

# CASK (APPS) #

# Tap a formula repository
brew tap caskroom/versions
# Install macOS apps
brew cask install java
# Uninstall …
brew cask uninstall java

# OTHERS #

# Check potential problems
brew doctor
# What's due for upgrades?
brew outdated
# Open homepage
brew home git
```
