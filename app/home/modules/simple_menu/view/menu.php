<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php echo unit_Html::href('index');?>">
            <img src="<?php echo $this->resDir . 'images/architect.png' ?>" width="30" height="30" class="d-inline-block align-top" alt="">
            <?php echo $site_name ?>
        </a> 

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTop">    
            <ul class="navbar-nav">
                <?php foreach ($menu as $melem){ ?>                
                    <li class="nav-item  <?php echo unit_Html::active($melem['url']); ?>">                    
                        <a class="nav-link" href="<?php echo unit_Html::href($melem['url']); ?>"><?php echo $melem['name'] ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
</nav>