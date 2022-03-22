<div id="search" class="container-inline">
  <div class="form-item">
    <input type="text" maxlength="128" name="search_theme_form_keys" id="edit-search-theme-form-keys" size="15" value="" title="<?php print t('Enter the terms you wish to search for.'); ?>" class="form-text" />
  </div>
  <input type="submit" name="op" id="edit-submit" value="<?php print t('Search'); ?>" class="form-submit" />
  <input type="hidden" name="form_token" id="edit-search-theme-form-form-token" value="<?php print drupal_get_token('search_theme_form'); ?>" />
  <input type="hidden" name="form_id" id="edit-search-theme-form" value="search_theme_form" />
</div>
