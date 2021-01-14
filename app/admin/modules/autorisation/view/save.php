<?php
if($state == 'OK'){$message = LANG_PASSPORT_SAVE_MESSAGE_OK; $alert = 'alert-success';} 
elseif ($state == 'ERR') {$message = LANG_PASSPORT_SAVE_MESSAGE_ERROR; $alert = 'alert-danger';}
?>

<head>
    <link href="<?php echo $this->resDir . 'css/save.css' ?>" rel="stylesheet">
</head>
<body>
    <div class="alert <?php echo $alert; ?>" role="alert"><?php echo $message; 
    if(isset($errors)){ foreach ($errors as $error){
     echo $error . ' ';
    }};
    if(isset($PassChange) && $PassChange){
        echo ' ' . LANG_PASSPORT_SAVE_SET_PASSWORD_OK;
    }
    ?></div>
    
</body>