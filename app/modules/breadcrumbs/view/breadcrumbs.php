<?php 
?>
<head>
</head>
<body>
    <?php if($crumbs != NULL){ ?>
    <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
            <?php foreach ($crumbs as $crumb){ ?>
            <li class="breadcrumb-item <?php if(isset($crumb['active'])){ ?> active <?php } ?>">
                <?php if(isset($crumb['href'])){ ?><a href="<?php echo $crumb['href']; ?>"><?php echo $crumb['text']; ?></a>
                <?php } else { echo $crumb['text']; } ?>
            </li>
            <?php } ?>
        </ol>     
    </nav>
    <?php } ?>
</body>
