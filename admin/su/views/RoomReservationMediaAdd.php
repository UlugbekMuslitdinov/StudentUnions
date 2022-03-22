<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationMediaAdd = &$Page;
?>
<script>
if (!ew.vars.tables.room_reservation_media) ew.vars.tables.room_reservation_media = <?= JsonEncode(GetClientVar("tables", "room_reservation_media")) ?>;
var currentForm, currentPageID;
var froom_reservation_mediaadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    froom_reservation_mediaadd = currentForm = new ew.Form("froom_reservation_mediaadd", "add");

    // Add fields
    var fields = ew.vars.tables.room_reservation_media.fields;
    froom_reservation_mediaadd.addFields([
        ["room_reservation_id", [fields.room_reservation_id.required ? ew.Validators.required(fields.room_reservation_id.caption) : null, ew.Validators.integer], fields.room_reservation_id.isInvalid],
        ["media_id", [fields.media_id.required ? ew.Validators.required(fields.media_id.caption) : null, ew.Validators.integer], fields.media_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = froom_reservation_mediaadd,
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
    froom_reservation_mediaadd.validate = function () {
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
    froom_reservation_mediaadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    froom_reservation_mediaadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("froom_reservation_mediaadd");
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
<form name="froom_reservation_mediaadd" id="froom_reservation_mediaadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation_media">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->room_reservation_id->Visible) { // room_reservation_id ?>
    <div id="r_room_reservation_id" class="form-group row">
        <label id="elh_room_reservation_media_room_reservation_id" for="x_room_reservation_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->room_reservation_id->caption() ?><?= $Page->room_reservation_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->room_reservation_id->cellAttributes() ?>>
<span id="el_room_reservation_media_room_reservation_id">
<input type="<?= $Page->room_reservation_id->getInputTextType() ?>" data-table="room_reservation_media" data-field="x_room_reservation_id" name="x_room_reservation_id" id="x_room_reservation_id" size="30" placeholder="<?= HtmlEncode($Page->room_reservation_id->getPlaceHolder()) ?>" value="<?= $Page->room_reservation_id->EditValue ?>"<?= $Page->room_reservation_id->editAttributes() ?> aria-describedby="x_room_reservation_id_help">
<?= $Page->room_reservation_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->room_reservation_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->media_id->Visible) { // media_id ?>
    <div id="r_media_id" class="form-group row">
        <label id="elh_room_reservation_media_media_id" for="x_media_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->media_id->caption() ?><?= $Page->media_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->media_id->cellAttributes() ?>>
<span id="el_room_reservation_media_media_id">
<input type="<?= $Page->media_id->getInputTextType() ?>" data-table="room_reservation_media" data-field="x_media_id" name="x_media_id" id="x_media_id" size="30" placeholder="<?= HtmlEncode($Page->media_id->getPlaceHolder()) ?>" value="<?= $Page->media_id->EditValue ?>"<?= $Page->media_id->editAttributes() ?> aria-describedby="x_media_id_help">
<?= $Page->media_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->media_id->getErrorMessage() ?></div>
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
    ew.addEventHandlers("room_reservation_media");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
