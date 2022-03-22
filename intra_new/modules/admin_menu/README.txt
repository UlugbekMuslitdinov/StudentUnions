/* $Id: README.txt,v 1.2.4.5 2007/11/03 18:01:54 sun Exp $ */

Drupal Administration Menu is re-building and automagically slicing the whole
menu tree below /admin including all invisible local tasks into the Drupal
Administration Menu. So administrators need less time to access pages which
are only visible after one or two clicks normally.

-- INSTALLATION --

* Copy admin_menu module to your modules directory and enable it on the admin
  modules page.

* If "Admin Menu Block" is not automatically activated after module
  installation, make sure you visit the block configuration page
  (admin/build/block/ in Drupal 5 or admin/block in Drupal 4.7) for each theme
  you want to have admin_menu activated for.

* If you are using a separate admin theme, make sure the block is activated
  for this theme, too.


-- TROUBLESHOOTING --

* If Drupal Administration Menu is activated after installation but is not
  displayed and you are missing your 'administer' menu, then visit the block
  configuration page (admin/build/block/ in Drupal 5 or admin/block in Drupal
  4.7), ensure that "Admin Menu Block" is placed in front of any other menu
  block and save your block configuration.

* If your theme uses absolute or fixed positioned elements and the default
  margin-top for <BODY> is not sufficient, you can simply place a stylesheet
  file with the name 'admin_menu.css' in your theme to override or extend the
  CSS of your site when Drupal Administration Menu is enabled.

* If Drupal Administration Menu is not using all available width, not displayed
  correctly or if admin menu items have an additional border upon hover, you
  need to create a new region that solely outputs Drupal Administration Menu
  at the very beginning of a page. You may find these steps helpful:

  1) Open page.tpl.php and add the following line immediately after the opening
     BODY tag:

     <?php if ($admin_menu) echo $admin_menu; ?>

  2) Open template.php and add the following line to the array of the function
     <themename>_regions():

     'admin_menu' => t('Admin Menu'),

  3) Go to admin/build/block, assign Admin Menu Block to the new region
     'Admin Menu' and save the blocks.


-- FAQ --

Q: I enabled "Aggregate and compress CSS files", but I found admin_menu.css is
   still there, is it normal?

A: Yes, this is the intended behavior. Since admin_menu is only visible for
   logged-on administrative users, it would not make sense to load its
   stylesheet for all, including anonymous users.


-- CUSTOMIZATION --

* You have two options to override the admin menu icon:
  
  1) Disable it via CSS in your theme:

     body #admin_menu_icon { display: none; }

  2) Alter the image by overriding the theme function:

     Copy the whole function theme_admin_menu_icon() into your template.php,
     rename it to f.e. phptemplate_admin_menu_icon() and customize the output.


-- THEME-SPECIFIC TROUBLESHOOTING --

* Chameleon:
  Bug: Admin Menu does not use all available width.
  Fix: You need to create a new region that outputs Admin Menu above the
       main table#content. Ensure that Admin Menu block is assigned to this
       region.

* Marvin:
  Bug: Admin Menu does not use all available width.
  Fix: Ensure that Admin Menu block is assigned to the header region.


-- AUTHORS --

Daniel F. Kudwien, dev@unleashedmind.com
Stefan M. Kudwien, dev@unleashedmind.com

