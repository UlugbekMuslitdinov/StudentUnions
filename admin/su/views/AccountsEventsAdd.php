<?php

namespace PHPMaker2021\project1;

// Page object
$AccountsEventsAdd = &$Page;
?>
<script>
if (!ew.vars.tables.accounts_events) ew.vars.tables.accounts_events = <?= JsonEncode(GetClientVar("tables", "accounts_events")) ?>;
var currentForm, currentPageID;
var faccounts_eventsadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    faccounts_eventsadd = currentForm = new ew.Form("faccounts_eventsadd", "add");

    // Add fields
    var fields = ew.vars.tables.accounts_events.fields;
    faccounts_eventsadd.addFields([
        ["account_id", [fields.account_id.required ? ew.Validators.required(fields.account_id.caption) : null, ew.Validators.integer], fields.account_id.isInvalid],
        ["event_id", [fields.event_id.required ? ew.Validators.required(fields.event_id.caption) : null, ew.Validators.integer], fields.event_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = faccounts_eventsadd,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    faccounts_eventsadd.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    faccounts_eventsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    faccounts_eventsadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("faccounts_eventsadd");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="faccounts_eventsadd" id="faccounts_eventsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="accounts_events">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->account_id->Visible) { // account_id ?>
    <div id="r_account_id" class="form-group row">
        <label id="elh_accounts_events_account_id" for="x_account_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->account_id->caption() ?><?= $Page->account_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->account_id->cellAttributes() ?>>
<span id="el_accounts_events_account_id">
<input type="<?= $Page->account_id->getInputTextType() ?>" data-table="accounts_events" data-field="x_account_id" name="x_account_id" id="x_account_id" size="30" placeholder="<?= HtmlEncode($Page->account_id->getPlaceHolder()) ?>" value="<?= $Page->account_id->EditValue ?>"<?= $Page->account_id->editAttributes() ?> aria-describedby="x_account_id_help">
<?= $Page->account_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->account_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->event_id->Visible) { // event_id ?>
    <div id="r_event_id" class="form-group row">
        <label id="elh_accounts_events_event_id" for="x_event_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->event_id->caption() ?><?= $Page->event_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->event_id->cellAttributes() ?>>
<span id="el_accounts_events_event_id">
<input type="<?= $Page->event_id->getInputTextType() ?>" data-table="accounts_events" data-field="x_event_id" name="x_event_id" id="x_event_id" size="30" placeholder="<?= HtmlEncode($Page->event_id->getPlaceHolder()) ?>" value="<?= $Page->event_id->EditValue ?>"<?= $Page->event_id->editAttributes() ?> aria-describedby="x_event_id_help">
<?= $Page->event_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->event_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("accounts_events");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
