Full documentation on the Zen theme can be found in Drupal's Handbook:
  http://drupal.org/node/193318


Installation:

  1. Download Zen from http://drupal.org/project/zen

  2. Unpack the downloaded file and place the zen folder in your Drupal
     installation under one of the following locations:
       sites/all/themes
         making it available to all Drupal sites in a mult-site configuration
       sites/default/themes
         making it available to only the default Drupal site
       sites/example.com/themes
         making it available to only the example.com site if there is a
         sites/example.com/settings.php configuration file

  3. Log in as an administrator on your Drupal site and go to Administer > Site
     building > Themes (admin/build/themes) and make Zen or one of its
     sub-themes the default theme.

  Optional:

  4. Install the Theme Settings API module. Available from:
     http://drupal.org/project/themesettingsapi

     This module is built-in to Drupal 6, so why not add it to your Drupal 5
     installation?

  5. From the Theme settings page (admin/build/themes) configure the Zen theme
     or a sub-theme and note the additional settings that are now available
     under the "Theme-specific settings" heading.

Build your own sub-theme:

  The base Zen theme is designed to be easily extended by its sub-themes. You
  shouldn't modify any of the CSS or PHP files in the root zen/ folder; but
  instead you should create a sub-theme of zen which is located in a sub-folder
  of the root zen/ folder.  For example, the zen_classic sub-folder contains the
  files for the Zen Classic sub-theme.

  1. Copy the STARTERKIT folder and rename it to be your new sub-theme.
     IMPORTANT: Only lowercase letters and underscores should be used.

     For example, copy the zen/STARTERKIT folder and rename it as zen/foo.

  2. If you want a liquid layout for your theme, copy the layout-liquid.css from
     the zen folder and place it in your sub-theme's folder. If you want a
     fixed-width layout for your theme, copy the layout-fixed.css from the zen
     folder and place it in your sub-theme's folder. Rename the layout
     stylesheet to "layout.css".

     For example, copy zen/layout-fixed.css and rename it as zen/foo/layout.css.

  3. Copy the print stylesheet from the zen folder and place it in your
     sub-theme's folder.

     For example, copy zen/print.css to zen/foo/print.css.

  4. Copy the zen stylesheet from the zen folder and place it in your
     sub-theme's folder. Rename it to be the name of your sub-theme.

     For example, copy zen/zen.css and rename it as zen/foo/foo.css.

  5. Edit the template.php and theme-settings.php files in your sub-theme's
     folder; replace ALL occurances of "STARTERKIT" with the name of your
     sub-theme.

     For example, edit zen/foo/template.php and zen/foo/theme-settings.php and
     replace "STARTERKIT" with "foo".

  6. Log in as an administrator on your Drupal site and go to Administer > Site
     building > Themes (admin/build/themes) and enable your new sub-theme.

  Optional:

  7. MODIFYING ZEN CORE STYLESHEETS:
     If you decide you want to modify any of the other stylesheets in the zen
     folder, copy them to your sub-theme's folder before making any changes.
     Also, be sure to edit the drupal_add_css() calls near the beginning of your
     sub-theme's template.php file.

     For example, copy zen/html-elements.css and rename it as
     zen/foo/html-elements.css. Then edit zen/foo/template.php and change:
       drupal_add_css(path_to_theme() .'/html-elements.css', 'theme', 'all');
     to:
       drupal_add_css(path_to_subtheme() .'/html-elements.css', 'theme', 'all');

  8. MODIFYING ZEN CORE TEMPLATE FILES:
     If you decide you want to modify any of the .tpl.php template files in the
     zen folder, copy them to your sub-theme's folder before making any changes.

     For example, copy zen/page.tpl.php to zen/foo/page.tpl.php.

  9. THEMEING DRUPAL'S SEARCH FORM:
     Copy the search-theme-form.tpl.php template file from the zen folder and
     place it in your sub-theme's folder. In your sub-theme's template.php file,
     un-comment the phptemplate_search_theme_form() function.

  10. FURTHER EXTENSIONS OF YOUR SUB-THEME:
     Discover further ways to extend your sub-theme by reading Zen's
     documentation online at:
       http://drupal.org/node/193318
     and Drupal's Theme Developer's Guide online at:
       http://drupal.org/handbooks
