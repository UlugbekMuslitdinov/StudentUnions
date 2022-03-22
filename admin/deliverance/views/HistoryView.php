<?php

namespace PHPMaker2021\project3;

// Page object
$HistoryView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fhistoryview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fhistoryview = currentForm = new ew.Form("fhistoryview", "view");
    loadjs.done("fhistoryview");
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
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fhistoryview" id="fhistoryview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="history">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_history_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_history_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->netID->Visible) { // netID ?>
    <tr id="r_netID">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_history_netID"><?= $Page->netID->caption() ?></span></td>
        <td data-name="netID" <?= $Page->netID->cellAttributes() ?>>
<span id="el_history_netID">
<span<?= $Page->netID->viewAttributes() ?>>
<?= $Page->netID->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_action->Visible) { // action ?>
    <tr id="r__action">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_history__action"><?= $Page->_action->caption() ?></span></td>
        <td data-name="_action" <?= $Page->_action->cellAttributes() ?>>
<span id="el_history__action">
<span<?= $Page->_action->viewAttributes() ?>>
<?= $Page->_action->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->server->Visible) { // server ?>
    <tr id="r_server">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_history_server"><?= $Page->server->caption() ?></span></td>
        <td data-name="server" <?= $Page->server->cellAttributes() ?>>
<span id="el_history_server">
<span<?= $Page->server->viewAttributes() ?>>
<?= $Page->server->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_page->Visible) { // page ?>
    <tr id="r__page">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_history__page"><?= $Page->_page->caption() ?></span></td>
        <td data-name="_page" <?= $Page->_page->cellAttributes() ?>>
<span id="el_history__page">
<span<?= $Page->_page->viewAttributes() ?>>
<?= $Page->_page->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->resourceName->Visible) { // resourceName ?>
    <tr id="r_resourceName">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_history_resourceName"><?= $Page->resourceName->caption() ?></span></td>
        <td data-name="resourceName" <?= $Page->resourceName->cellAttributes() ?>>
<span id="el_history_resourceName">
<span<?= $Page->resourceName->viewAttributes() ?>>
<?= $Page->resourceName->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->filePath->Visible) { // filePath ?>
    <tr id="r_filePath">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_history_filePath"><?= $Page->filePath->caption() ?></span></td>
        <td data-name="filePath" <?= $Page->filePath->cellAttributes() ?>>
<span id="el_history_filePath">
<span<?= $Page->filePath->viewAttributes() ?>>
<?= $Page->filePath->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->site->Visible) { // site ?>
    <tr id="r_site">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_history_site"><?= $Page->site->caption() ?></span></td>
        <td data-name="site" <?= $Page->site->cellAttributes() ?>>
<span id="el_history_site">
<span<?= $Page->site->viewAttributes() ?>>
<?= $Page->site->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->timestamp->Visible) { // timestamp ?>
    <tr id="r_timestamp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_history_timestamp"><?= $Page->timestamp->caption() ?></span></td>
        <td data-name="timestamp" <?= $Page->timestamp->cellAttributes() ?>>
<span id="el_history_timestamp">
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
