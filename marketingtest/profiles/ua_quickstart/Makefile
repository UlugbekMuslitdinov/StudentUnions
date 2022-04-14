#------------------------------------------------------------------------------
#
# Build UA QuickStart (regular or Pantheon flavors).
#
# Useful targets
# - quickstart: (default) Build regular UA QuickStart
# - pantheon: Build the Pantheon variant of UA QuickStart
# - quickstart-clean: Remove any regular build
# - pantheon-clean: Remove any Pantheon variant build
# - clean: Remove any builds
#
# Optional environment variables
# - UAQSTEST_DRUPALROOT Path to a site-specific build directory
#
# The targets that build UA QuickStart use the drush make utility to put the
# resulting Drupal site in a newly-created site-specific subdirectory of
# a workspace directory. The default behavior uses the currently checked out
# Git branch name for the stem of the site-specific directory name, but the
# directory specified in the environment always overrides this. Builds of
# the Pantheon UA QuickStart variant always append the text '-pantheon' to the
# site-specific directory name. The workspace directory gets constructed if
# it does not exist; the various clean targets remove the site-specific
# subdirectories but leave the workspace directory.
#
#------------------------------------------------------------------------------

# None of the built-in suffix processing rules apply.
.SUFFIXES:

# The useful targets aren't actual files.
.PHONY: clean quickstart quickstart-clean pantheon pantheon-clean

ifeq ($(origin UAQSTEST_DRUPALROOT), undefined)
  # No build directory from the environment, so set defaults.
  SITE_DIR := $(or $(shell git branch | sed -n -e 's/^\* \(.*\)/\1/p'), ua_quickstart_test)
  BUILDS := $(HOME)/Sites/UAQS_Builds
  UAQSTEST_DRUPALROOT := $(BUILDS)/$(SITE_DIR)
else
  # Decompose the environment's build directory into workspace & site parts.
  SITE_DIR := $(notdir $(UAQSTEST_DRUPALROOT))
  BUILDS := $(dir $(UAQSTEST_DRUPALROOT))
endif

# Pantheon variant site-specific directories always get the suffix.
DRUPALROOT_PANTHEON := $(UAQSTEST_DRUPALROOT)-pantheon

# The file within the build directory that will always get a new timestamp.
lastupdatefile := uaqs_make_lastupdate
build_marker := profiles/ua_quickstart/$(lastupdatefile)

# The targets must specify the unique file paths, not directories, that will
# always get a revised timestamp after a build.
quickstart-target := $(UAQSTEST_DRUPALROOT)/$(build_marker)
pantheon-target := $(DRUPALROOT_PANTHEON)/$(build_marker)

# Use the standard system find utility to locate all possible source files
# in the current directory and its subdirectories, excluding the '.' files
# and top-level '.' directories such as '.git'.
sourcefiles := $(shell find * -type f ! -name '^\.')

quickstart: $(quickstart-target)

$(quickstart-target): $(sourcefiles) | $(BUILDS)
	-rm -rf $(UAQSTEST_DRUPALROOT)
	touch $(lastupdatefile)
	drush make build-ua_quickstart.make.yml $(UAQSTEST_DRUPALROOT)
	rm $(lastupdatefile)

pantheon: $(pantheon-target)

$(pantheon-target): $(sourcefiles) | $(BUILDS)
	-rm -rf $(DRUPALROOT_PANTHEON)
	touch $(lastupdatefile)
	drush make build-ua_quickstart-pantheon.make.yml $(DRUPALROOT_PANTHEON)
	rm $(lastupdatefile)

clean: quickstart-clean pantheon-clean

quickstart-clean:
	-rm -rf $(UAQSTEST_DRUPALROOT)

pantheon-clean:
	-rm -rf $(DRUPALROOT_PANTHEON)

$(BUILDS):
	mkdir -p $(BUILDS)
