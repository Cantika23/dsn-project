<?php

namespace Mitral2022\DSN2;

// Page object
$LogCourierAdd = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            log_courier: currentTable
        }
    });
    var currentForm, currentPageID;
    var flog_courieradd;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        flog_courieradd = new ew.Form("flog_courieradd", "add");
        currentPageID = ew.PAGE_ID = "add";
        currentForm = flog_courieradd;

        // Add fields
        var fields = currentTable.fields;
        flog_courieradd.addFields([
            ["awb", [fields.awb.visible && fields.awb.required ? ew.Validators.required(fields.awb.caption) : null], fields.awb.isInvalid],
            ["kurir", [fields.kurir.visible && fields.kurir.required ? ew.Validators.required(fields.kurir.caption) : null], fields.kurir.isInvalid],
            ["req_type", [fields.req_type.visible && fields.req_type.required ? ew.Validators.required(fields.req_type.caption) : null], fields.req_type.isInvalid],
            ["datetime", [fields.datetime.visible && fields.datetime.required ? ew.Validators.required(fields.datetime.caption) : null, ew.Validators.datetime(fields.datetime.clientFormatPattern)], fields.datetime.isInvalid],
            ["parameter", [fields.parameter.visible && fields.parameter.required ? ew.Validators.required(fields.parameter.caption) : null], fields.parameter.isInvalid],
            ["_response", [fields._response.visible && fields._response.required ? ew.Validators.required(fields._response.caption) : null], fields._response.isInvalid],
            ["_content", [fields._content.visible && fields._content.required ? ew.Validators.required(fields._content.caption) : null], fields._content.isInvalid],
            ["text_query", [fields.text_query.visible && fields.text_query.required ? ew.Validators.required(fields.text_query.caption) : null], fields.text_query.isInvalid]
        ]);

        // Form_CustomValidate
        flog_courieradd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        flog_courieradd.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        loadjs.done("flog_courieradd");
    });
</script>
<script>
    loadjs.ready("head", function() {
        // Write your table-specific client script here, no need to add script tags.
    });
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="flog_courieradd" id="flog_courieradd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="log_courier">
    <input type="hidden" name="action" id="action" value="insert">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-add-div"><!-- page* -->
        <?php if ($Page->awb->Visible) { // awb 
        ?>
            <div id="r_awb" <?= $Page->awb->rowAttributes() ?>>
                <label id="elh_log_courier_awb" for="x_awb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->awb->caption() ?><?= $Page->awb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->awb->cellAttributes() ?>>
                        <span id="el_log_courier_awb">
                            <input type="<?= $Page->awb->getInputTextType() ?>" name="x_awb" id="x_awb" data-table="log_courier" data-field="x_awb" value="<?= $Page->awb->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->awb->getPlaceHolder()) ?>" <?= $Page->awb->editAttributes() ?> aria-describedby="x_awb_help">
                            <?= $Page->awb->getCustomMessage() ?>
                            <div class="invalid-feedback"><?= $Page->awb->getErrorMessage() ?></div>
                        </span>
                </div>
            </div>
    </div>
<?php } ?>
<?php if ($Page->kurir->Visible) { // kurir 
?>
    <div id="r_kurir" <?= $Page->kurir->rowAttributes() ?>>
        <label id="elh_log_courier_kurir" for="x_kurir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kurir->caption() ?><?= $Page->kurir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->kurir->cellAttributes() ?>>
                <span id="el_log_courier_kurir">
                    <input type="<?= $Page->kurir->getInputTextType() ?>" name="x_kurir" id="x_kurir" data-table="log_courier" data-field="x_kurir" value="<?= $Page->kurir->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->kurir->getPlaceHolder()) ?>" <?= $Page->kurir->editAttributes() ?> aria-describedby="x_kurir_help">
                    <?= $Page->kurir->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->kurir->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->req_type->Visible) { // req_type 
?>
    <div id="r_req_type" <?= $Page->req_type->rowAttributes() ?>>
        <label id="elh_log_courier_req_type" for="x_req_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->req_type->caption() ?><?= $Page->req_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->req_type->cellAttributes() ?>>
                <span id="el_log_courier_req_type">
                    <input type="<?= $Page->req_type->getInputTextType() ?>" name="x_req_type" id="x_req_type" data-table="log_courier" data-field="x_req_type" value="<?= $Page->req_type->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->req_type->getPlaceHolder()) ?>" <?= $Page->req_type->editAttributes() ?> aria-describedby="x_req_type_help">
                    <?= $Page->req_type->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->req_type->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->datetime->Visible) { // datetime 
?>
    <div id="r_datetime" <?= $Page->datetime->rowAttributes() ?>>
        <label id="elh_log_courier_datetime" for="x_datetime" class="<?= $Page->LeftColumnClass ?>"><?= $Page->datetime->caption() ?><?= $Page->datetime->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->datetime->cellAttributes() ?>>
                <span id="el_log_courier_datetime">
                    <input type="<?= $Page->datetime->getInputTextType() ?>" name="x_datetime" id="x_datetime" data-table="log_courier" data-field="x_datetime" value="<?= $Page->datetime->EditValue ?>" placeholder="<?= HtmlEncode($Page->datetime->getPlaceHolder()) ?>" <?= $Page->datetime->editAttributes() ?> aria-describedby="x_datetime_help">
                    <?= $Page->datetime->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->datetime->getErrorMessage() ?></div>
                    <?php if (!$Page->datetime->ReadOnly && !$Page->datetime->Disabled && !isset($Page->datetime->EditAttrs["readonly"]) && !isset($Page->datetime->EditAttrs["disabled"])) { ?>
                        <script>
                            loadjs.ready(["flog_courieradd", "datetimepicker"], function() {
                                let format = "<?= DateFormat(0) ?>",
                                    options = {
                                        localization: {
                                            locale: ew.LANGUAGE_ID,
                                            numberingSystem: ew.getNumberingSystem()
                                        },
                                        display: {
                                            format,
                                            components: {
                                                hours: !!format.match(/h/i),
                                                minutes: !!format.match(/m/),
                                                seconds: !!format.match(/s/i)
                                            },
                                            icons: {
                                                previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                                                next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                                            }
                                        }
                                    };
                                ew.createDateTimePicker("flog_courieradd", "x_datetime", jQuery.extend(true, {
                                    "useCurrent": false
                                }, options));
                            });
                        </script>
                    <?php } ?>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->parameter->Visible) { // parameter 
?>
    <div id="r_parameter" <?= $Page->parameter->rowAttributes() ?>>
        <label id="elh_log_courier_parameter" for="x_parameter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->parameter->caption() ?><?= $Page->parameter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->parameter->cellAttributes() ?>>
                <span id="el_log_courier_parameter">
                    <textarea data-table="log_courier" data-field="x_parameter" name="x_parameter" id="x_parameter" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->parameter->getPlaceHolder()) ?>" <?= $Page->parameter->editAttributes() ?> aria-describedby="x_parameter_help"><?= $Page->parameter->EditValue ?></textarea>
                    <?= $Page->parameter->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->parameter->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->_response->Visible) { // response 
?>
    <div id="r__response" <?= $Page->_response->rowAttributes() ?>>
        <label id="elh_log_courier__response" for="x__response" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_response->caption() ?><?= $Page->_response->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->_response->cellAttributes() ?>>
                <span id="el_log_courier__response">
                    <input type="<?= $Page->_response->getInputTextType() ?>" name="x__response" id="x__response" data-table="log_courier" data-field="x__response" value="<?= $Page->_response->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->_response->getPlaceHolder()) ?>" <?= $Page->_response->editAttributes() ?> aria-describedby="x__response_help">
                    <?= $Page->_response->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->_response->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->_content->Visible) { // content 
?>
    <div id="r__content" <?= $Page->_content->rowAttributes() ?>>
        <label id="elh_log_courier__content" for="x__content" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_content->caption() ?><?= $Page->_content->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->_content->cellAttributes() ?>>
                <span id="el_log_courier__content">
                    <textarea data-table="log_courier" data-field="x__content" name="x__content" id="x__content" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->_content->getPlaceHolder()) ?>" <?= $Page->_content->editAttributes() ?> aria-describedby="x__content_help"><?= $Page->_content->EditValue ?></textarea>
                    <?= $Page->_content->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->_content->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->text_query->Visible) { // text_query 
?>
    <div id="r_text_query" <?= $Page->text_query->rowAttributes() ?>>
        <label id="elh_log_courier_text_query" for="x_text_query" class="<?= $Page->LeftColumnClass ?>"><?= $Page->text_query->caption() ?><?= $Page->text_query->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->text_query->cellAttributes() ?>>
                <span id="el_log_courier_text_query">
                    <textarea data-table="log_courier" data-field="x_text_query" name="x_text_query" id="x_text_query" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->text_query->getPlaceHolder()) ?>" <?= $Page->text_query->editAttributes() ?> aria-describedby="x_text_query_help"><?= $Page->text_query->EditValue ?></textarea>
                    <?= $Page->text_query->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->text_query->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
    <div class="row"><!-- buttons .row -->
        <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
            <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
            <button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
        </div><!-- /buttons offset -->
    </div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
    // Field event handlers
    loadjs.ready("head", function() {
        ew.addEventHandlers("log_courier");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>