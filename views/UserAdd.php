<?php

namespace Mitral2022\DSN2;

// Page object
$UserAdd = &$Page;
?>
<script>
    var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
    ew.deepAssign(ew.vars, {
        tables: {
            user: currentTable
        }
    });
    var currentForm, currentPageID;
    var fuseradd;
    loadjs.ready(["wrapper", "head"], function() {
        var $ = jQuery;
        // Form object
        fuseradd = new ew.Form("fuseradd", "add");
        currentPageID = ew.PAGE_ID = "add";
        currentForm = fuseradd;

        // Add fields
        var fields = currentTable.fields;
        fuseradd.addFields([
            ["nama_user", [fields.nama_user.visible && fields.nama_user.required ? ew.Validators.required(fields.nama_user.caption) : null], fields.nama_user.isInvalid],
            ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid],
            ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
            ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
            ["level", [fields.level.visible && fields.level.required ? ew.Validators.required(fields.level.caption) : null], fields.level.isInvalid],
            ["id_pegawai", [fields.id_pegawai.visible && fields.id_pegawai.required ? ew.Validators.required(fields.id_pegawai.caption) : null, ew.Validators.integer], fields.id_pegawai.isInvalid],
            ["npk", [fields.npk.visible && fields.npk.required ? ew.Validators.required(fields.npk.caption) : null], fields.npk.isInvalid],
            ["dept", [fields.dept.visible && fields.dept.required ? ew.Validators.required(fields.dept.caption) : null], fields.dept.isInvalid],
            ["phone", [fields.phone.visible && fields.phone.required ? ew.Validators.required(fields.phone.caption) : null], fields.phone.isInvalid]
        ]);

        // Form_CustomValidate
        fuseradd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
            // Your custom validation code here, return false if invalid.
            return true;
        }

        // Use JavaScript validation or not
        fuseradd.validateRequired = ew.CLIENT_VALIDATE;

        // Dynamic selection lists
        fuseradd.lists.nama_user = <?= $Page->nama_user->toClientList($Page) ?>;
        fuseradd.lists.level = <?= $Page->level->toClientList($Page) ?>;
        loadjs.done("fuseradd");
    });
</script>
<script>
    loadjs.ready("head", function() {
        // Client script
        // Write your table-specific client script here, no need to add script tags.
        $('#r_nama_user').hide();
        $('#x__username').on('input', function() {
            // do something
            var username = $(this).val();
            var parent_url = ew.PATH_BASE;
            $.get(parent_url + "api/getIDPegawaiByUsername/" + username, function(res) {
                console.log(res);
                if (res && res != null) {
                    var id = res["id"];
                    var email = res["email"];
                    var nik = res["nik"];
                    var dept = res["company_name"];
                    var phone = res["phone1"];
                    if (phone == "-") {
                        phone = res["phone2"];
                    }
                    $('#x_id_pegawai').val(id);
                    $('#x__email').val(email);
                    $('#x_npk').val(nik);
                    $('#x_dept').val(dept);
                    $('#x_phone').val(phone);
                    $('#x_id_pegawai').readonly(true).css({
                        "background-color": "#eeeeee",
                    });
                    $('#x_nama_user').val(id);
                } else {
                    $('#x_id_pegawai').val('');
                    $('#x__email').val('');
                    $('#x_npk').val('');
                    $('#x_dept').val('');
                    $('#x_phone').val('');
                    $('#x_id_pegawai').readonly(false).css({
                        "background-color": "#ffffff",
                    });
                    $('#x_nama_user').val('');
                }
            });
        });
    });
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fuseradd" id="fuseradd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
    <?php if (Config("CHECK_TOKEN")) { ?>
        <input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
        <input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
    <?php } ?>
    <input type="hidden" name="t" value="user">
    <input type="hidden" name="action" id="action" value="insert">
    <input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
    <input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
    <div class="ew-add-div"><!-- page* -->
        <?php if ($Page->nama_user->Visible) { // nama_user 
        ?>
            <div id="r_nama_user" <?= $Page->nama_user->rowAttributes() ?>>
                <label id="elh_user_nama_user" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_user->caption() ?><?= $Page->nama_user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
                <div class="<?= $Page->RightColumnClass ?>">
                    <div<?= $Page->nama_user->cellAttributes() ?>>
                        <span id="el_user_nama_user">
                            <?php
                            $onchange = $Page->nama_user->EditAttrs->prepend("onchange", "");
                            $onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
                            $Page->nama_user->EditAttrs["onchange"] = "";
                            if (IsRTL()) {
                                $Page->nama_user->EditAttrs["dir"] = "rtl";
                            }
                            ?>
                            <span id="as_x_nama_user" class="ew-auto-suggest">
                                <input type="<?= $Page->nama_user->getInputTextType() ?>" class="form-control" name="sv_x_nama_user" id="sv_x_nama_user" value="<?= RemoveHtml($Page->nama_user->EditValue) ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->nama_user->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->nama_user->getPlaceHolder()) ?>" <?= $Page->nama_user->editAttributes() ?> aria-describedby="x_nama_user_help">
                            </span>
                            <selection-list hidden class="form-control" data-table="user" data-field="x_nama_user" data-input="sv_x_nama_user" data-value-separator="<?= $Page->nama_user->displayValueSeparatorAttribute() ?>" name="x_nama_user" id="x_nama_user" value="<?= HtmlEncode($Page->nama_user->CurrentValue) ?>" <?= $onchange ?>></selection-list>
                            <?= $Page->nama_user->getCustomMessage() ?>
                            <div class="invalid-feedback"><?= $Page->nama_user->getErrorMessage() ?></div>
                            <script>
                                loadjs.ready("fuseradd", function() {
                                    fuseradd.createAutoSuggest(Object.assign({
                                        "id": "x_nama_user",
                                        "forceSelect": false
                                    }, ew.vars.tables.user.fields.nama_user.autoSuggestOptions));
                                });
                            </script>
                            <?= $Page->nama_user->Lookup->getParamTag($Page, "p_x_nama_user") ?>
                        </span>
                </div>
            </div>
    </div>
<?php } ?>
<?php if ($Page->_username->Visible) { // username 
?>
    <div id="r__username" <?= $Page->_username->rowAttributes() ?>>
        <label id="elh_user__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->_username->cellAttributes() ?>>
                <span id="el_user__username">
                    <input type="<?= $Page->_username->getInputTextType() ?>" name="x__username" id="x__username" data-table="user" data-field="x__username" value="<?= $Page->_username->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>" <?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
                    <?= $Page->_username->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password 
?>
    <div id="r__password" <?= $Page->_password->rowAttributes() ?>>
        <label id="elh_user__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->_password->cellAttributes() ?>>
                <span id="el_user__password">
                    <input type="<?= $Page->_password->getInputTextType() ?>" name="x__password" id="x__password" data-table="user" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>" <?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
                    <?= $Page->_password->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email 
?>
    <div id="r__email" <?= $Page->_email->rowAttributes() ?>>
        <label id="elh_user__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->_email->cellAttributes() ?>>
                <span id="el_user__email">
                    <input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="user" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="40" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>" <?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
                    <?= $Page->_email->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->level->Visible) { // level 
?>
    <div id="r_level" <?= $Page->level->rowAttributes() ?>>
        <label id="elh_user_level" for="x_level" class="<?= $Page->LeftColumnClass ?>"><?= $Page->level->caption() ?><?= $Page->level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->level->cellAttributes() ?>>
                <?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin 
                ?>
                    <span id="el_user_level">
                        <span class="form-control-plaintext"><?= $Page->level->getDisplayValue($Page->level->EditValue) ?></span>
                    </span>
                <?php } else { ?>
                    <span id="el_user_level">
                        <select id="x_level" name="x_level" class="form-select ew-select<?= $Page->level->isInvalidClass() ?>" data-select2-id="fuseradd_x_level" data-table="user" data-field="x_level" data-value-separator="<?= $Page->level->displayValueSeparatorAttribute() ?>" data-placeholder="<?= HtmlEncode($Page->level->getPlaceHolder()) ?>" <?= $Page->level->editAttributes() ?>>
                            <?= $Page->level->selectOptionListHtml("x_level") ?>
                        </select>
                        <?= $Page->level->getCustomMessage() ?>
                        <div class="invalid-feedback"><?= $Page->level->getErrorMessage() ?></div>
                        <?= $Page->level->Lookup->getParamTag($Page, "p_x_level") ?>
                        <script>
                            loadjs.ready("fuseradd", function() {
                                var options = {
                                        name: "x_level",
                                        selectId: "fuseradd_x_level"
                                    },
                                    el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
                                options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
                                if (fuseradd.lists.level.lookupOptions.length) {
                                    options.data = {
                                        id: "x_level",
                                        form: "fuseradd"
                                    };
                                } else {
                                    options.ajax = {
                                        id: "x_level",
                                        form: "fuseradd",
                                        limit: ew.LOOKUP_PAGE_SIZE
                                    };
                                }
                                options.minimumResultsForSearch = Infinity;
                                options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.user.fields.level.selectOptions);
                                ew.createSelect(options);
                            });
                        </script>
                    </span>
                <?php } ?>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->id_pegawai->Visible) { // id_pegawai 
?>
    <div id="r_id_pegawai" <?= $Page->id_pegawai->rowAttributes() ?>>
        <label id="elh_user_id_pegawai" for="x_id_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_pegawai->caption() ?><?= $Page->id_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->id_pegawai->cellAttributes() ?>>
                <span id="el_user_id_pegawai">
                    <input type="<?= $Page->id_pegawai->getInputTextType() ?>" name="x_id_pegawai" id="x_id_pegawai" data-table="user" data-field="x_id_pegawai" value="<?= $Page->id_pegawai->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->id_pegawai->getPlaceHolder()) ?>" <?= $Page->id_pegawai->editAttributes() ?> aria-describedby="x_id_pegawai_help">
                    <?= $Page->id_pegawai->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->id_pegawai->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->npk->Visible) { // npk 
?>
    <div id="r_npk" <?= $Page->npk->rowAttributes() ?>>
        <label id="elh_user_npk" for="x_npk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->npk->caption() ?><?= $Page->npk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->npk->cellAttributes() ?>>
                <span id="el_user_npk">
                    <input type="<?= $Page->npk->getInputTextType() ?>" name="x_npk" id="x_npk" data-table="user" data-field="x_npk" value="<?= $Page->npk->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->npk->getPlaceHolder()) ?>" <?= $Page->npk->editAttributes() ?> aria-describedby="x_npk_help">
                    <?= $Page->npk->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->npk->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->dept->Visible) { // dept 
?>
    <div id="r_dept" <?= $Page->dept->rowAttributes() ?>>
        <label id="elh_user_dept" for="x_dept" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dept->caption() ?><?= $Page->dept->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->dept->cellAttributes() ?>>
                <span id="el_user_dept">
                    <input type="<?= $Page->dept->getInputTextType() ?>" name="x_dept" id="x_dept" data-table="user" data-field="x_dept" value="<?= $Page->dept->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->dept->getPlaceHolder()) ?>" <?= $Page->dept->editAttributes() ?> aria-describedby="x_dept_help">
                    <?= $Page->dept->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->dept->getErrorMessage() ?></div>
                </span>
        </div>
    </div>
    </div>
<?php } ?>
<?php if ($Page->phone->Visible) { // phone 
?>
    <div id="r_phone" <?= $Page->phone->rowAttributes() ?>>
        <label id="elh_user_phone" for="x_phone" class="<?= $Page->LeftColumnClass ?>"><?= $Page->phone->caption() ?><?= $Page->phone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->phone->cellAttributes() ?>>
                <span id="el_user_phone">
                    <input type="<?= $Page->phone->getInputTextType() ?>" name="x_phone" id="x_phone" data-table="user" data-field="x_phone" value="<?= $Page->phone->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->phone->getPlaceHolder()) ?>" <?= $Page->phone->editAttributes() ?> aria-describedby="x_phone_help">
                    <?= $Page->phone->getCustomMessage() ?>
                    <div class="invalid-feedback"><?= $Page->phone->getErrorMessage() ?></div>
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
        ew.addEventHandlers("user");
    });
</script>
<script>
    loadjs.ready("load", function() {
        // Write your table-specific startup script here, no need to add script tags.
    });
</script>