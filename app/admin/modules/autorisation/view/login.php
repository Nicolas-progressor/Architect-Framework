<?php    
?>
<head>
    <title><?php echo LANG_PASSPORT_LOGIN_SIGNIN ?></title>
    <link href="<?php echo $this->resDir . 'css/login.css' ?>" rel="stylesheet">
    <link href="<?php echo $this->resDir . 'css/view.css' ?>" rel="stylesheet">
</head>
<body>
    <div class="container login_center">
        <?php if(isset($state) && $state == 'error'){ ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                Access Error
            </div>
        <?php } ?>
        <form class="form-signin" method="post" action="<?php echo \unit_Html::href('autorisation/login'); ?>">
            <h2 in="form-signin-heading"><?php echo LANG_PASSPORT_LOGIN_SIGNIN ?></h2>
            <label for="inputLogin" class="cols-sm-2 control-label"><?php echo LANG_PASSPORT_LOGIN_LOGIN ?></label>
            <div class="input-group cols-sm-10">       
                <input type="text" id="inputLogin" class="form-control" name="login"  placeholder="<?php echo LANG_PASSPORT_LOGIN_LOGIN ?>" required autofocus />
            </div>
            <label for="inputPassword" class="cols-sm-2 control-label"><?php echo LANG_PASSPORT_LOGIN_PASSWORD ?></label>
            <div class="input-group cols-sm-10">               
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="<?php echo LANG_PASSPORT_LOGIN_PASSWORD ?>" required/>
            </div>
            <input class="btn btn-lg btn-primary btn-block" type="submit"/>
       </form>
    </div>
</body>
