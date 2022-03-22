<?php

namespace PHPMaker2021\project4;

// Page object
$WebSupportView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fweb_supportview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fweb_supportview = currentForm = new ew.Form("fweb_supportview", "view");
    loadjs.done("fweb_supportview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.web_support) ew.vars.tables.web_support = <?= JsonEncode(GetClientVar("tables", "web_support")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fweb_supportview" id="fweb_supportview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="web_support">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_web_support_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name_first->Visible) { // name_first ?>
    <tr id="r_name_first">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_name_first"><?= $Page->name_first->caption() ?></span></td>
        <td data-name="name_first" <?= $Page->name_first->cellAttributes() ?>>
<span id="el_web_support_name_first">
<span<?= $Page->name_first->viewAttributes() ?>>
<?= $Page->name_first->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name_last->Visible) { // name_last ?>
    <tr id="r_name_last">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_name_last"><?= $Page->name_last->caption() ?></span></td>
        <td data-name="name_last" <?= $Page->name_last->cellAttributes() ?>>
<span id="el_web_support_name_last">
<span<?= $Page->name_last->viewAttributes() ?>>
<?= $Page->name_last->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email" <?= $Page->_email->cellAttributes() ?>>
<span id="el_web_support__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone ?>
    <tr id="r_phone">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_phone"><?= $Page->phone->caption() ?></span></td>
        <td data-name="phone" <?= $Page->phone->cellAttributes() ?>>
<span id="el_web_support_phone">
<span<?= $Page->phone->viewAttributes() ?>>
<?= $Page->phone->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->url->Visible) { // url ?>
    <tr id="r_url">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_url"><?= $Page->url->caption() ?></span></td>
        <td data-name="url" <?= $Page->url->cellAttributes() ?>>
<span id="el_web_support_url">
<span<?= $Page->url->viewAttributes() ?>>
<?= $Page->url->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->web_support->Visible) { // web_support ?>
    <tr id="r_web_support">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_web_support"><?= $Page->web_support->caption() ?></span></td>
        <td data-name="web_support" <?= $Page->web_support->cellAttributes() ?>>
<span id="el_web_support_web_support">
<span<?= $Page->web_support->viewAttributes() ?>>
<?= $Page->web_support->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->web_support_title->Visible) { // web_support_title ?>
    <tr id="r_web_support_title">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_web_support_title"><?= $Page->web_support_title->caption() ?></span></td>
        <td data-name="web_support_title" <?= $Page->web_support_title->cellAttributes() ?>>
<span id="el_web_support_web_support_title">
<span<?= $Page->web_support_title->viewAttributes() ?>>
<?= $Page->web_support_title->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->urgent->Visible) { // urgent ?>
    <tr id="r_urgent">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_urgent"><?= $Page->urgent->caption() ?></span></td>
        <td data-name="urgent" <?= $Page->urgent->cellAttributes() ?>>
<span id="el_web_support_urgent">
<span<?= $Page->urgent->viewAttributes() ?>>
<?= $Page->urgent->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_web_support_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_web_support_timestamp">
<span<?= $Page->timestamp->viewAttributes() ?>>
<?= $Page->timestamp->getViewValue() ?></span>
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
