<?php

namespace PHPMaker2021\project1;

// Page object
$RoomReservationRoomOptionsEdit = &$Page;
?>
<script>
if (!ew.vars.tables.room_reservation_room_options) ew.vars.tables.room_reservation_room_options = <?= JsonEncode(GetClientVar("tables", "room_reservation_room_options")) ?>;
var currentForm, currentPageID;
var froom_reservation_room_optionsedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    froom_reservation_room_optionsedit = currentForm = new ew.Form("froom_reservation_room_optionsedit", "edit");

    // Add fields
    var fields = ew.vars.tables.room_reservation_room_options.fields;
    froom_reservation_room_optionsedit.addFields([
        ["id", [fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["room", [fields.room.required ? ew.Validators.required(fields.room.caption) : null], fields.room.isInvalid],
        ["floor", [fields.floor.required ? ew.Validators.required(fields.floor.caption) : null, ew.Validators.integer], fields.floor.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = froom_reservation_room_optionsedit,
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
    froom_reservation_room_optionsedit.validate = function () {
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
    froom_reservation_room_optionsedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    froom_reservation_room_optionsedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("froom_reservation_room_optionsedit");
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
<form name="froom_reservation_room_optionsedit" id="froom_reservation_room_optionsedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl() ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="room_reservation_room_options">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_room_reservation_room_options_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_room_reservation_room_options_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="room_reservation_room_options" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->room->Visible) { // room ?>
    <div id="r_room" class="form-group row">
        <label id="elh_room_reservation_room_options_room" for="x_room" class="<?= $Page->LeftColumnClass ?>"><?= $Page->room->caption() ?><?= $Page->room->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->room->cellAttributes() ?>>
<span id="el_room_reservation_room_options_room">
<input type="<?= $Page->room->getInputTextType() ?>" data-table="room_reservation_room_options" data-field="x_room" name="x_room" id="x_room" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->room->getPlaceHolder()) ?>" value="<?= $Page->room->EditValue ?>"<?= $Page->room->editAttributes() ?> aria-describedby="x_room_help">
<?= $Page->room->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->room->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->floor->Visible) { // floor ?>
    <div id="r_floor" class="form-group row">
        <label id="elh_room_reservation_room_options_floor" for="x_floor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->floor->caption() ?><?= $Page->floor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->floor->cellAttributes() ?>>
<span id="el_room_reservation_room_options_floor">
<input type="<?= $Page->floor->getInputTextType() ?>" data-table="room_reservation_room_options" data-field="x_floor" name="x_floor" id="x_floor" size="30" placeholder="<?= HtmlEncode($Page->floor->getPlaceHolder()) ?>" value="<?= $Page->floor->EditValue ?>"<?= $Page->floor->editAttributes() ?> aria-describedby="x_floor_help">
<?= $Page->floor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->floor->getErrorMessage() ?></div>
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
    ew.addEventHandlers("room_reservation_room_options");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
