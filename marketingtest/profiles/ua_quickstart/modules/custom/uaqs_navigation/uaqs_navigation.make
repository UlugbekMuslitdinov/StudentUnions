; ------------------------------------------------------------------------------
; UAQS Navigation Makefile
;
; Downloads module and library dependencies for UAQS Navigation components.
; ------------------------------------------------------------------------------

core = 7.x
api = 2

; Set default contrib destination
defaults[projects][subdir] = contrib

; ------------------------------------------------------------------------------
; Contrib modules
; ------------------------------------------------------------------------------

projects[menu_bean][version] = 1.0-beta2
projects[menu_bean][download][type] = git
projects[menu_bean][download][tag] = 7.x-1.0-beta2
projects[menu_bean][patch][2714007] = http://drupal.org/files/issues/bean_plugin_class_not-2714007-2_0.patch

projects[menu_block][version] = 2.7
projects[xautoload][version] = 5.7
projects[superfish][version] = 2.0
