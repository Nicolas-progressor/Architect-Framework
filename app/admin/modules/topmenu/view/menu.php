<?php 
    $messengerReady = false;
?>
<link href="<?php echo $this->resDir . 'css/menu.css' ?>" rel="stylesheet">
<div class="main-navbar sticky-top bg-white">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark shadow-sm m-menu-bg align-items-stretch p-0 right-space">
        <ul class="navbar-nav main_navbar ml-auto flex-row">
                <nav id="sidebarBut" class="navbar navbar-expand-sm position-absolute d-md-none">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                    </button>
                </nav>
                <?php if($messengerReady){ ?>
                <li class="nav-item dropdown">                    
                    <a href="#" class="nav-link nav-link-icon text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-message mdi-inverse"></i>
                        <span class="badge badge-pill badge-danger">2</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right notice_menu" id="messages_menu" aria-labelledby="navbarDropdown">
                        <h6 class="dropdown-header">Messages</h6>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <?php } ?>
                <?php if(\unit_redAuth::getInstance()->islogin()){ ?>
                <li class="nav-item dropdown px-3">
                    <a href="#" class="nav-link dropdown-toggle text-nowrap text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                       
                        <span class="text-white"><?php echo $passport['login']; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right notice_menu" id="passport_menu" aria-labelledby="navbarDropdown">
                        <div class="navbar-login">
                            <div class="row" id="passport_menu_t">
                                <div class="col-lg-4">
                                    <p class="text-center">
                                        
                                    </p>
                                </div>
                                <div class="col-lg-8">
                                    <p class="text-left">
                                        <strong><?php echo $passport['login']; ?></strong>
                                    </p>
                                    <p class="text-left small"><?php echo $passport['mail']; ?></p>
                                    <p class="text-left">
                                        <a href="#" class="btn btn-primary btn-block btn-sm"><?php echo LANG_MENU_PROFILE; ?></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo \unit_Html::href('passport/view'); ?>">                        
                            <?php echo LANG_MENU_MYSETTINGS; ?>                        
                        </a>
                        <a class="dropdown-item" href="<?php echo ROOT_URL . 'passport/logout'; ?>">
                            <?php echo LANG_MENU_LOGOUT; ?>                        
                        </a>
                        </div>
                        </li>
                <?php } else { ?>
                        <li>
                            <a href="<?php echo \unit_Html::href('passport/login'); ?>"><span class="glyphicon glyphicon-user" style="font-size: 1.4em; margin-right: 15px;"></span><?php echo LANG_MENU_LOGIN ?></a>
                        </li>
                <?php } ?>
        </ul>
    </nav>
</div>