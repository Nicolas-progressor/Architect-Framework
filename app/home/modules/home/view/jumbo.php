<?php 
?>
<head>
     <link href="<?php echo $this->resDir . 'css/jumbo.css' ?>" rel="stylesheet">
     <title>Architect Framework</title>
</head>
<body>
        <div class="jumbotron">
            <div class="container index_page">
                <div class="index_text">
                    <h1 class="display-4"><?php echo LANG_APP_HOME_WELCOME; ?></h1>
                    <p><?php echo $index_text; ?></p>
                    <hr class="my-4">
                    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                    <p><a class="btn btn-primary" href="<?php unit_Html::href("about") ?>"><?php echo LANG_APP_HOME_LEARNMORE;?> »</a></p>
                </div>                          
            </div>   
        </div>
</body>