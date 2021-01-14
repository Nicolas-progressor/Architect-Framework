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
        <script src="https://unpkg.com/ionicons@4.2.2/dist/ionicons.js"></script>
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet"/>
        
            <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
    <script src="<?php echo ASSETS_URL; ?>scripts/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>scripts/js/popper.js"></script>
    
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <title><?php echo unit_Title::getInstance()->Get(); ?></title>
</head>

<body class="h-100">
    <div class="wrapper">
            <?php $this->element('element-3') ?>
        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">        
            <header>
                <?php $this->element('element-1') ?>
            </header>
            <div>                
                    <div>                
                        <?php $this->element('element-4') ?>        
                        <div class='master' id="contentRow"><?php $this->getContent() ?></div>            
                    </div>
            </div>
            <footer>
                 <?php $this->element('element-2') ?>
            </footer>
        </main>
    </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ASSETS_URL; ?>scripts/js/bootstrap.min.js"></script>    
    <script src="<?php echo ASSETS_URL; ?>scripts/js/bootstrap-select.min.js"></script>
</body>