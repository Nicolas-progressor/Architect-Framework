<?php 
    $reg = \unit_redAuth::getInstance();    
?>

<!doctype html>
<head>
<!--    <meta charset="utf-8">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link href="<?php echo ASSETS_URL; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo TEMP_URL; ?>css/style.css" rel="stylesheet">
            
        <link href="<?php echo ASSETS_URL; ?>css/bootstrap-select.min.css" rel="stylesheet">
        <link href="<?php echo ASSETS_URL; ?>css/material-icons.css" rel="stylesheet">
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet"/>
        
            <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
    <script src="<?php echo ASSETS_URL; ?>scripts/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>scripts/js/popper.js"></script>
    <title><?php echo unit_Title::getInstance()->Get(); ?></title>
</head>

<body class="h-100">
    <div class="wrapper">           
        <header>
            <nav class="navbar navbar-dark bg-dark">
                <span class="navbar-brand mb-0 h1">Admin CP</span>
            </nav>
        </header>
        <div>                
            <div class='master'><?php $this->getContent() ?></div>            
        </div>
        
    </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ASSETS_URL; ?>scripts/js/bootstrap.min.js"></script>    
    <script src="<?php echo ASSETS_URL; ?>scripts/js/bootstrap-select.min.js"></script>
</body>