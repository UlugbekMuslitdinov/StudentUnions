<?php

namespace PHPMaker2022\project3;

// Page object
$LocationView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { location: currentTable } });
var currentForm, currentPageID;
var flocationview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    flocationview = new ew.Form("flocationview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = flocationview;
    loadjs.done("flocationview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="flocationview" id="flocationview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="location">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->location_id->Visible) { // location_id ?>
    <tr id="r_location_id"<?= $Page->location_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_location_id"><?= $Page->location_id->caption() ?></span></td>
        <td data-name="location_id"<?= $Page->location_id->cellAttributes() ?>>
<span id="el_location_location_id">
<span<?= $Page->location_id->viewAttributes() ?>>
<?= $Page->location_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location_name->Visible) { // location_name ?>
    <tr id="r_location_name"<?= $Page->location_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_location_name"><?= $Page->location_name->caption() ?></span></td>
        <td data-name="location_name"<?= $Page->location_name->cellAttributes() ?>>
<span id="el_location_location_name">
<span<?= $Page->location_name->viewAttributes() ?>>
<?= $Page->location_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->location_url->Visible) { // location_url ?>
    <tr id="r_location_url"<?= $Page->location_url->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_location_url"><?= $Page->location_url->caption() ?></span></td>
        <td data-name="location_url"<?= $Page->location_url->cellAttributes() ?>>
<span id="el_location_location_url">
<span<?= $Page->location_url->viewAttributes() ?>>
<?= $Page->location_url->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->group_id->Visible) { // group_id ?>
    <tr id="r_group_id"<?= $Page->group_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_group_id"><?= $Page->group_id->caption() ?></span></td>
        <td data-name="group_id"<?= $Page->group_id->cellAttributes() ?>>
<span id="el_location_group_id">
<span<?= $Page->group_id->viewAttributes() ?>>
<?= $Page->group_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->active->Visible) { // active ?>
    <tr id="r_active"<?= $Page->active->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_active"><?= $Page->active->caption() ?></span></td>
        <td data-name="active"<?= $Page->active->cellAttributes() ?>>
<span id="el_location_active">
<span<?= $Page->active->viewAttributes() ?>>
<?= $Page->active->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->group_hours->Visible) { // group_hours ?>
    <tr id="r_group_hours"<?= $Page->group_hours->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_group_hours"><?= $Page->group_hours->caption() ?></span></td>
        <td data-name="group_hours"<?= $Page->group_hours->cellAttributes() ?>>
<span id="el_location_group_hours">
<span<?= $Page->group_hours->viewAttributes() ?>>
<?= $Page->group_hours->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <tr id="r_phone"<?= $Page->phone->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_phone"><?= $Page->phone->caption() ?></span></td>
        <td data-name="phone"<?= $Page->phone->cellAttributes() ?>>
<span id="el_location_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subgroup->Visible) { // subgroup ?>
    <tr id="r_subgroup"<?= $Page->subgroup->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_subgroup"><?= $Page->subgroup->caption() ?></span></td>
        <td data-name="subgroup"<?= $Page->subgroup->cellAttributes() ?>>
<span id="el_location_subgroup">
<span<?= $Page->subgroup->viewAttributes() ?>>
<?= $Page->subgroup->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->old_id->Visible) { // old_id ?>
    <tr id="r_old_id"<?= $Page->old_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_old_id"><?= $Page->old_id->caption() ?></span></td>
        <td data-name="old_id"<?= $Page->old_id->cellAttributes() ?>>
<span id="el_location_old_id">
<span<?= $Page->old_id->viewAttributes() ?>>
<?= $Page->old_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->short_name->Visible) { // short_name ?>
    <tr id="r_short_name"<?= $Page->short_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_short_name"><?= $Page->short_name->caption() ?></span></td>
        <td data-name="short_name"<?= $Page->short_name->cellAttributes() ?>>
<span id="el_location_short_name">
<span<?= $Page->short_name->viewAttributes() ?>>
<?= $Page->short_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->accept_plus_discount->Visible) { // accept_plus_discount ?>
    <tr id="r_accept_plus_discount"<?= $Page->accept_plus_discount->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_accept_plus_discount"><?= $Page->accept_plus_discount->caption() ?></span></td>
        <td data-name="accept_plus_discount"<?= $Page->accept_plus_discount->cellAttributes() ?>>
<span id="el_location_accept_plus_discount">
<span<?= $Page->accept_plus_discount->viewAttributes() ?>>
<?= $Page->accept_plus_discount->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lat->Visible) { // lat ?>
    <tr id="r_lat"<?= $Page->lat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_lat"><?= $Page->lat->caption() ?></span></td>
        <td data-name="lat"<?= $Page->lat->cellAttributes() ?>>
<span id="el_location_lat">
<span<?= $Page->lat->viewAttributes() ?>>
<?= $Page->lat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->long->Visible) { // long ?>
    <tr id="r_long"<?= $Page->long->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_long"><?= $Page->long->caption() ?></span></td>
        <td data-name="long"<?= $Page->long->cellAttributes() ?>>
<span id="el_location_long">
<span<?= $Page->long->viewAttributes() ?>>
<?= $Page->long->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ua_mobile_categories->Visible) { // ua_mobile_categories ?>
    <tr id="r_ua_mobile_categories"<?= $Page->ua_mobile_categories->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_ua_mobile_categories"><?= $Page->ua_mobile_categories->caption() ?></span></td>
        <td data-name="ua_mobile_categories"<?= $Page->ua_mobile_categories->cellAttributes() ?>>
<span id="el_location_ua_mobile_categories">
<span<?= $Page->ua_mobile_categories->viewAttributes() ?>>
<?= $Page->ua_mobile_categories->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->breakfast->Visible) { // breakfast ?>
    <tr id="r_breakfast"<?= $Page->breakfast->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_breakfast"><?= $Page->breakfast->caption() ?></span></td>
        <td data-name="breakfast"<?= $Page->breakfast->cellAttributes() ?>>
<span id="el_location_breakfast">
<span<?= $Page->breakfast->viewAttributes() ?>>
<?= $Page->breakfast->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lunch->Visible) { // lunch ?>
    <tr id="r_lunch"<?= $Page->lunch->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_lunch"><?= $Page->lunch->caption() ?></span></td>
        <td data-name="lunch"<?= $Page->lunch->cellAttributes() ?>>
<span id="el_location_lunch">
<span<?= $Page->lunch->viewAttributes() ?>>
<?= $Page->lunch->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dinner->Visible) { // dinner ?>
    <tr id="r_dinner"<?= $Page->dinner->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_dinner"><?= $Page->dinner->caption() ?></span></td>
        <td data-name="dinner"<?= $Page->dinner->cellAttributes() ?>>
<span id="el_location_dinner">
<span<?= $Page->dinner->viewAttributes() ?>>
<?= $Page->dinner->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->continuous->Visible) { // continuous ?>
    <tr id="r_continuous"<?= $Page->continuous->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_continuous"><?= $Page->continuous->caption() ?></span></td>
        <td data-name="continuous"<?= $Page->continuous->cellAttributes() ?>>
<span id="el_location_continuous">
<span<?= $Page->continuous->viewAttributes() ?>>
<?= $Page->continuous->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hours_message->Visible) { // hours_message ?>
    <tr id="r_hours_message"<?= $Page->hours_message->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_location_hours_message"><?= $Page->hours_message->caption() ?></span></td>
        <td data-name="hours_message"<?= $Page->hours_message->cellAttributes() ?>>
<span id="el_location_hours_message">
<span<?= $Page->hours_message->viewAttributes() ?>>
<?= $Page->hours_message->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
