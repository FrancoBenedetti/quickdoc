<?php
$docroot = $_SERVER['DOCUMENT_ROOT'];
include "$docroot/bapi/files/config.php";
?>
<html>
<head>
    <title><?php echo $tab; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="/<?php echo explode('/',$pagePath)[1]; ?>/quickdoc.css">
</head>
<body>
    <h1><?php echo $mainTitle;?></h1>
    <p class="breadcrumbs"><?php echo $breadcrumbs;?></p>
    <div class="row">
        <div class="content">
            <h3><?php echo $parentTitle;?></h3>
            <div class="nav section">
                <?php 
                if ($previousSection) {?>
                 <a class="left" href="<?php echo $previousSection['url']; ?>">🠈 Prev: <?php echo $previousSection['title']; ?></a> 
                <?php 
                }
                if ($nextSection) { ?>
                <a class="right" href="<?php echo $nextSection['url']; ?>">Next: <?php echo $nextSection['title']; ?> 🠊</a>
                <?php 
                }?>
            </div>
            <h2><?php echo $pageTitle;?></h2>
            <div class="nav page">
                <?php 
                if ( $previousPage) { ?>
                <a class="button page left" href="<?php echo $previousPage['url']; ?>">🠈 Prev: <?php echo $previousPage['title']; ?></a>
                <?php 
                }
                if ($nextPage) { ?>
                <a class="button page right" href="<?php echo $nextPage['url']; ?>">Next: <?php echo $nextPage['title']; ?> 🠊</a>
                <?php
                }?>
            </div>
            <div class="embed">
                <iframe class="googledocs" src="<?php echo $pageElement['googleDoc']; ?>"></iframe>    
            </div>
        </div>
        <div class="outline">
            <a href="//<?php echo BV_DOMAIN;?>" target="_blank"><h2><?php echo $subTitle;?></h2></a>
            <?php echo html_menu($path); ?>
            <div class="links">
                <?php
                    foreach($outline['links'] as $link)
                    {
                        ?>
                        <a class="section" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                        <?php
                    }
                ?>
            </div>
            <div class="extras">
                <a class="editlink" href="<?php echo $editLink;?>">EDIT</a>
            </div>
        </div>
    </div>
</body>
</html>