<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationRoomEdit = &$Page;
?>
<script>
if (!ew.vars.tables.room_reservation_room) ew.vars.tables.room_reservation_room = <?= JsonEncode(GetClientVar("tables", "room_reservation_room")) ?>;
var currentForm, currentPageID;
var froom_reservation_roomedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    froom_reservation_roomedit = currentForm = new ew.Form("froom_reservation_roomedit", "edit");

    // Add fields
    var fields = ew.vars.tables.room_reservation_room.fields;
    froom_reservation_roomedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["room_reservation_id", [fields.room_reservation_id.required ? ew.Validators.required(fields.room_reservation_id.caption) : null, ew.Validators.integer], fields.room_reservation_id.isInvalid],
        ["room_id", [fields.room_id.required ? ew.Validators.required(fields.room_id.caption) : null, ew.Validators.integer], fields.room_id.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = froom_reservation_roomedit,
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
    froom_reservation_roomedit.validate = function () {
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
    froom_reservation_roomedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    froom_reservation_roomedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("froom_reservation_roomedit");
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
<form name="froom_reservation_roomedit" id="froom_reservation_roomedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation_room">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_room_reservation_room_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_room_reservation_room_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="room_reservation_room" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->room_reservation_id->Visible) { // room_reservation_id ?>
    <div id="r_room_reservation_id" class="form-group row">
        <label id="elh_room_reservation_room_room_reservation_id" for="x_room_reservation_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->room_reservation_id->caption() ?><?= $Page->room_reservation_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->room_reservation_id->cellAttributes() ?>>
<span id="el_room_reservation_room_room_reservation_id">
<input type="<?= $Page->room_reservation_id->getInputTextType() ?>" data-table="room_reservation_room" data-field="x_room_reservation_id" name="x_room_reservation_id" id="x_room_reservation_id" size="30" placeholder="<?= HtmlEncode($Page->room_reservation_id->getPlaceHolder()) ?>" value="<?= $Page->room_reservation_id->EditValue ?>"<?= $Page->room_reservation_id->editAttributes() ?> aria-describedby="x_room_reservation_id_help">
<?= $Page->room_reservation_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->room_reservation_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->room_id->Visible) { // room_id ?>
    <div id="r_room_id" class="form-group row">
        <label id="elh_room_reservation_room_room_id" for="x_room_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->room_id->caption() ?><?= $Page->room_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->room_id->cellAttributes() ?>>
<span id="el_room_reservation_room_room_id">
<input type="<?= $Page->room_id->getInputTextType() ?>" data-table="room_reservation_room" data-field="x_room_id" name="x_room_id" id="x_room_id" size="30" placeholder="<?= HtmlEncode($Page->room_id->getPlaceHolder()) ?>" value="<?= $Page->room_id->EditValue ?>"<?= $Page->room_id->editAttributes() ?> aria-describedby="x_room_id_help">
<?= $Page->room_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->room_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
    ew.addEventHandlers("room_reservation_room");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
