# brew

The missing package manager for macOS

---

References

- `man brew`

## Quickstart

```bash
# Common
brew search git     # Search a package
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

## Link ( also for switching version )
brew unlink git # Unlink …
brew link git   # Link …
brew ln git

## Lock version
brew pin git    # Stop from being upgraded
brew unpin git  # Allow to upgrade again

## Clean old versions
brew cleanup git    # Clean old verions of a package
brew cleanup        # Clean up everything
brew cleanup -n     # See what would be cleaned up

# Cask (Apps)
brew tap caskroom/versions  # Tap a formula repo
brew cask install java8     # Install macOS apps
brew cask uninstall java8   # Uninstall …

# Others
brew doctor     # Check potential problems
brew outdated   # What's due for upgrades?
brew home git   # Open homepage
```
