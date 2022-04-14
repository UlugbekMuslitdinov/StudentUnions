; ------------------------------------------------------------------------------
; UAQS Featured Content Makefile
;
; Downloads contrib module and library dependencies for UAQS Featured Content
; component.
; ------------------------------------------------------------------------------

core = 7.x
api = 2

; Set default contrib destination
defaults[projects][subdir] = contrib

; ------------------------------------------------------------------------------
; Contrib modules
; ------------------------------------------------------------------------------

projects[flexslider][version] = 2.0-rc1
projects[flag][version] = 3.9

; ------------------------------------------------------------------------------
; Libraries
; ------------------------------------------------------------------------------

libraries[flexslider][download][type] = get
libraries[flexslider][download][url] = https://github.com/woothemes/FlexSlider/archive/version/2.4.0.tar.gz
libraries[flexslider][directory_name] = flexslider
