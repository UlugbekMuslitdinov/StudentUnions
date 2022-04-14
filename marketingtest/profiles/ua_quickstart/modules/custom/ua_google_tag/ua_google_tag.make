; ------------------------------------------------------------------------------
; UA Google Tag Makefile
;
; Downloads contrib module and library dependencies for UA Google Tag
; component.
; ------------------------------------------------------------------------------

core = 7.x
api = 2

; Set default contrib destination
defaults[projects][subdir] = contrib

; ------------------------------------------------------------------------------
; Contrib modules
; ------------------------------------------------------------------------------

projects[google_tag][version] = 1.6
