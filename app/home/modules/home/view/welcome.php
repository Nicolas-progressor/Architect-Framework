<?php 
?>
<head>
     <link href="<?php echo $this->resDir . 'css/welcome.css' ?>" rel="stylesheet">
     <title>Architect Framework</title>
</head>
<body>
    <div class="row">
       <?php foreach ($rows as $row){ ?>
        <div class="col-lg-4">
            <h2>
                <?php echo $row['header']; ?>
            </h2>
            <p>
                <?php echo $row['text']; ?>               
            </p>
            <?php if (isset($row['url'])){ ?>
            <p>
                <a class="btn btn-secondary" href="<?php echo unit_Html::href($row['url']); ?>"  role="button"><?php echo LANG_APP_HOME_DETAILS; ?> »</a>
            </p>
            <?php } ?>
        </div>
       <?php } ?>
    </div>      
</body>

