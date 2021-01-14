<?php    
    $statusName = array('0' => 'Active', '1' => 'Blocked');
    $timezone_identifiers = DateTimeZone::listIdentifiers();
?>
<head>
    <title><?php echo LANG_PASSPORT_SET_CLASSNAME; ?></title>
    <link href="<?php echo $this->resDir . 'css/login.css' ?>" rel="stylesheet">
    <script type="text/javascript">
            function AjaxFormRequest(result_id,form_id,url) {
                jQuery.ajax({
                    url:     url, 
                    type:     "POST", 
                    dataType: "html", 
                    data: jQuery("#"+form_id).serialize(), 
                    success: function(response) {
                    document.getElementById(result_id).innerHTML = response;
                },
                error: function(response) {
                document.getElementById(result_id).innerHTML = "Ошибка при отправке формы";
                }
             });
        }
   </script>
</head>
<body>
    <div class="container" id="passport_view">
        <h3> <?php echo LANG_PASSPORT_SET_CLASSNAME; ?> </h3>
        <div id="ajax_result"></div>
        <div>       
            <form class="form-signin" id="form_passport_set">
            <label for="login" class="cols-sm-2 control-label"><?php echo LANG_PASSPORT_SET_LOGIN ?></label>
            <input id="login" name="login" readonly class="form-control" type="text" value="<?php echo $passport['login'];?>" required></p>

            <label for="email" class="cols-sm-2 control-label"><?php echo LANG_PASSPORT_SET_EMAIL ?></label>
            <input id="email" name="email" class="form-control" type="text" value="<?php echo $passport['mail'];?>" required></p>

            <b><?php echo LANG_PASSPORT_SET_TIMEZONE; ?>:</b><br>
            <select id="timezone" name="timezone" class="custom-select">
                <?php if(!empty($timezone_identifiers)){ 
                foreach ($timezone_identifiers as $key => $value) {
                    $sel = '';
                    if($value == $passport['timezone']) {$sel = 'selected';}
                    echo '<option '. $sel .'>'. $value .'</option>';
                }} ?>            
            </select>

            <hr>
                    <label for="password" class="control-label"><?php echo LANG_PASSPORT_SET_PASSWORD ?></label>
                    <input id="password" name="password" class="form-control" type="password" placeholder="<?php echo LANG_PASSPORT_SET_PASSWORD ?>" required></p>
            
            <hr>
                  
            <div class="row">
                <div class="col">       
                        <label for="password_new" class="control-label"><?php echo LANG_PASSPORT_SET_NEW_PASSWORD ?></label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input name="PasswordSetCheck" value="Yes" type="checkbox" aria-label="<?php echo LANG_PASSPORT_SET_SETPASS ?>">&nbsp;<?php echo LANG_PASSPORT_SET_SETPASS ?>
                            </span>
                            <input id="password_new" name="password_new" class="form-control" type="password" placeholder="<?php echo LANG_PASSPORT_SET_NEW_PASSWORD ?>"></p>
                        </div>                        
                </div>
                <div class="col">
                    <label for="ReEnterPassword" class="control-label"><?php echo LANG_PASSPORT_SET_NEW_PASSWORD_RE ?></label>
                    <input id="ReEnterPassword" name="ReEnterPassword" class="form-control" type="password" placeholder="<?php echo LANG_PASSPORT_SET_NEW_PASSWORD_RE ?>"></p>
                </div>
            </div>    
            <small id="SetPassHelp" class="form-text text-muted">Если желаете сменить пароль, отметте флажок "Сменить пароль", и заполните поля "новый пароль" и "повторить новый пароль"</small>
            
            <hr>
            <p><?php echo LANG_PASSPORT_SET_REGDATE; ?>: <?php echo $passport['date_reg']; ?></p>
            <p><?php echo LANG_PASSPORT_SET_STATUS; ?>: <?php echo$statusName[$passport['status']]; ?></p>

            <p><input type="button" class="btn btn-lg btn-primary" type="submit" value="<?php echo LANG_PASSPORT_SET_SAVE; ?>" onclick="AjaxFormRequest('ajax_result', 'form_passport_set', '<?php echo \unit_Html::href($this->module . '/save'); ?>')"></p>

            </form>
        </div>
    </div>
</body>
