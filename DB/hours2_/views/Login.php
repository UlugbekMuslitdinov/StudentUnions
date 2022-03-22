<?php namespace PHPMaker2022\project1; ?>
<?php

namespace PHPMaker2022\project1;

// Page object
$Login = &$Page;
?>
<script>
loadjs.ready("head", function () {
    // Write your client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<div class="ew-login-box">
    <div class="login-logo"></div>
    <div class="card ew-login-card">
        <div class="card-body">
<script>
// Script inside .card-body
var flogin;
loadjs.ready(["wrapper", "head"], function() {
    var $ = jQuery;
    flogin = new ew.Form("flogin");

    // Add fields
    flogin.addFields([
        ["username", ew.Validators.required(ew.language.phrase("UserName")), <?= $Page->Username->IsInvalid ? "true" : "false" ?>],
        ["password", ew.Validators.required(ew.language.phrase("Password")), <?= $Page->Password->IsInvalid ? "true" : "false" ?>]
    ]);

    // Captcha
    <?= Captcha()->getScript("flogin") ?>

    // Validate
    flogin.validate = function() {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm();

        // Validate fields
        if (!this.validateFields())
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    flogin.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation
    flogin.validateRequired = ew.CLIENT_VALIDATE;
    loadjs.done("flogin");
});
</script>
<form name="flogin" id="flogin" class="ew-form ew-login-form" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
    <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
    <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <p class="login-box-msg"><?= $Language->phrase("LoginMsg") ?></p>
    <div class="row gx-0">
        <input type="text" name="<?= $Page->Username->FieldVar ?>" id="<?= $Page->Username->FieldVar ?>" autocomplete="username" value="<?= HtmlEncode($Page->Username->CurrentValue) ?>" placeholder="<?= HtmlEncode($Language->phrase("Username")) ?>"<?= $Page->Username->editAttributes() ?>>
        <div class="invalid-feedback"><?= $Page->Username->getErrorMessage() ?></div>
    </div>
    <div class="row gx-0">
        <div class="input-group px-0">
            <input type="password" name="<?= $Page->Password->FieldVar ?>" id="<?= $Page->Password->FieldVar ?>" autocomplete="current-password" placeholder="<?= HtmlEncode($Language->phrase("Password")) ?>"<?= $Page->Password->editAttributes() ?>>
            <button type="button" class="btn btn-default ew-toggle-password rounded-end" data-ew-action="password"><i class="fas fa-eye"></i></button>
        </div>
        <div class="invalid-feedback"><?= $Page->Password->getErrorMessage() ?></div>
    </div>
    <div class="d-grid">
        <button class="btn btn-primary ew-btn" name="btn-submit" id="btn-submit" type="submit" formaction="<?= CurrentPageUrl(false) ?>"><?= $Language->phrase("Login", true) ?></button>
    </div>
<?php
// OAuth login
$providers = Config("AUTH_CONFIG.providers");
$cntProviders = 0;
foreach ($providers as $id => $provider) {
    if ($provider["enabled"]) {
        $cntProviders++;
    }
}
if ($cntProviders > 0) {
?>
    <div class="social-auth-links text-center mt-3 d-grid gap-2">
        <p><?= $Language->phrase("LoginOr") ?></p>
<?php
        foreach ($providers as $id => $provider) {
            if ($provider["enabled"]) {
?>
            <a href="<?= CurrentPageUrl(false) ?>?provider=<?= $id ?>" class="btn btn-<?= strtolower($provider["color"]) ?>"><i class="fab fa-<?= strtolower($id) ?> me-2"></i><?= $Language->phrase("Login" . $id) ?></a>
<?php
            }
        }
?>
    </div>
<?php
}
?>
</form>
        </div><!-- ./card-body -->
    </div><!-- ./card -->
</div><!-- ./ew-login-box -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your startup script here, no need to add script tags.
});
</script>
