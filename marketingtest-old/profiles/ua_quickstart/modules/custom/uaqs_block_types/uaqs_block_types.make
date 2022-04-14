; ------------------------------------------------------------------------------
; UAQS Block Types Makefile
;
; Downloads the Bean module dependencies for UAQS Block Types components.
; Although the UI might not be necessary for users, it is required for some
; of the Bean pre-configuration.
; ------------------------------------------------------------------------------

core = 7.x
api = 2

; Set default contrib destination
defaults[projects][subdir] = contrib

; ------------------------------------------------------------------------------
; Contrib modules
; ------------------------------------------------------------------------------

projects[bean][version] = 1.11