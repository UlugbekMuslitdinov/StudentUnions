<?php
/**
 * @file
 * Returns the HTML for a uaqs_navigation_select_menu.
 */
?>
<form id="<?php print $select_id; ?>" data-toggle="popover" data-trigger="focus" data-placement="top" data-content="Please make a selection." >
  <div class="input-group">
    <span class="input-group-addon input-group-addon-no-border">
      <div class="select-menu-label"><?php print $preform_text; ?> </div>
    </span>
    <label for="<?php print $select_id; ?>-menu" class="sr-only"><?php print $preform_text_sr_only; ?></label>
    <select id="<?php print $select_id; ?>-menu" class="form-control select-primary" aria-invalid="false">
    <?php foreach ($menu_items as $menu_item): ?>
      <option data-href="<?php print $menu_item['href']; ?>"><?php print $menu_item['title']; ?></option>
    <?php endforeach; ?>
    </select>
    <span class="input-group-btn">
      <button class="btn btn-primary js_select_menu_button disabled" aria-disabled="true" role="button" type="button" tabindex="0" disabled><?php print $button_text; ?><span class="sr-only"><?php print $button_text_sr_only; ?></span></button>
    </span>
  </div>
</form>
