# brew

> The missing package manager for macOS

Usage

```bash
# Common
brew search git     # Search for a package
brew install git    # Install …
brew uninstall git  # Uninstall …
brew remove git
brew rm git
brew upgrade git    # Upgrade …
brew upgrade        # Upgrade all
brew update         # Update brew & cask (itself)
brew list           # List installed
brew ls

# Versions
brew list --versions git    # See what versions you have
brew switch git 2.5.0       # Change version
# ( Link is also for switching version. )
brew unlink git             # Unlink …
brew link git               # Link …
brew ln git

# Cask (Apps)
brew tap caskroom/versions  # Tap a formula repository
brew cask install java      # Install macOS apps
brew cask uninstall java    # Uninstall …

# Others
brew doctor     # Check potential problems
brew outdated   # What's due for upgrades?
brew home git   # Open homepage
```
