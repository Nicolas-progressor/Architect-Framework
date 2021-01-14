<?php 
?>
<head>
    <link href="<?php echo $this->resDir . 'css/error.css' ?>" rel="stylesheet">
    <title></title>
</head>
<body>
    <div class="container" >
        <div id='error'>
            <h3><?php echo $title; ?></h3>
            <img src="<?php echo $this->resDir . 'images/warning.png' ?>">       
            <p><?php echo $text; ?></p>               
        </div>
    </div>  
</body>

