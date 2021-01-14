<?php
?>
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
<link href="<?php echo $this->resDir . 'css/menu.css' ?>" rel="stylesheet">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0 left-menu-flow" href="#">
                <nav id="sidebarBut" class="navbar navbar-expand-sm d-md-none">
                    <button type="button" id="sidebarCollapse_m" class="btn">
                        <i class="fas fa-align-left"></i>
                    </button>
                </nav>
                <div class="d-table m-auto">
                    <img src="<?php echo TEMP_URL . 'images/admin_logo.png' ?>" width="35" height="35" class="d-inline-block align-top" alt="">
                    <span class="d-none d-md-inline ml-1">Dashboard</span>
                </div>
            </a>
        </nav>
        <nav id="navigation">
            <ul>
                <?php 
                    if(!empty($source)){ 
                        foreach ($source as $m_key => $m_value){   
                ?>
                        <li <?php if($m_value['type'] == 'dropdown'){ ?> class="dropdown" rel="2" <?php } ?> >
                            <a href="<?php echo $m_value['href']; ?>">
                                <?php if(isset($m_value['ionic_icon'])){ ?>  <i class="<?php echo $m_value['ionic_icon']; ?>"></i> <?php } ?>          
                                <span><?php echo $m_value['m_text']; ?></span>
                                <?php if(isset($m_value['dropdown'])){ ?>
                                    <ul class="dropdown-2">
                                    <?php foreach ($m_value['dropdown'] as $d_key => $d_val){ ?>
                                        <li>
                                            <a href="<?php $d_val['href']; ?>">
                                                <?php if(isset($d_val['ionic_icon'])){ ?>  <i class="<?php echo $d_val['ionic_icon']; ?>"></i> <?php } ?>
                                                <span><?php echo $d_val['m_text']; ?></span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                <?php } ?>
                            </a>
                        </li>                        
                <?php 
                        }
                    } 
                ?>
            </ul>
        </nav>
    </div>
</aside>

<script>
    $(document).ready(function () {

  /**
   * Sidebar toggles
   */
  $('#sidebarCollapse').click(function (e) {
    $('.main-sidebar').toggleClass('open');
  });
  
  $('#sidebarCollapse_m').click(function (e) {
    $('.main-sidebar').toggleClass('open');
  });
});
</script>