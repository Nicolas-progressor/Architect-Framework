<?php 
?>

<!doctype html>
<head>
<!--    <meta charset="utf-8">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="<?php echo ASSETS_URL; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo TEMP_URL; ?>css/style.css" rel="stylesheet">
    
    <link href="<?php echo ASSETS_URL; ?>css/material-icons.css" rel="stylesheet">
    <script src="https://unpkg.com/ionicons@4.2.2/dist/ionicons.js"></script>
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet"/>
    
        <!-- Bootstrap CSS -->
        <link href="<?php echo ASSETS_URL; ?>css/bootstrap-select.min.css" rel="stylesheet">
    
    <script src="<?php echo ASSETS_URL; ?>scripts/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>scripts/js/popper.js"></script>
    
</head>

<body>
    <header>
        <?php $this->element('element-1') ?>
    </header>   
        <div class="pre_content">
            <?php $this->element('element-3') ?>
        </div>
        <div class="container-fluid" id="contentRow">
            <div class="row">
                <div class="col-md-2">
                    <?php $this->element('element-5') ?>
                </div>
                <div class="col content">
                    <div class="master-head">
                        <?php $this->element('element-7') ?>    
                    </div>
                    <?php $this->element('element-4') ?>        
                    <div class='master'>
                        <?php $this->getContent() ?>
                    </div> 
                    <div class='master-foot'>
                        <?php $this->element('element-8') ?>  
                    </div> 
                </div>
                <div class="col-sm-2">
                    <?php $this->element('element-6') ?>
                </div>
            </div>            
        </div>
    <footer>
         <?php $this->element('element-2') ?>
    </footer>
    

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ASSETS_URL; ?>scripts/js/bootstrap.min.js"></script>    
    <script src="<?php echo ASSETS_URL; ?>scripts/js/bootstrap-select.min.js"></script>
</body>