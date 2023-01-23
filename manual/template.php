<html>
<head>
    <title><?php echo $tab; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="/<?php echo explode('/',$pagePath)[1]; ?>/quickdoc.css">
</head>
<body>
    <h1 class="qd"><?php echo $mainTitle;?></h1>
    <p class="qd breadcrumbs"><?php echo $breadcrumbs;?></p>
    <div class="row">
        <div class="qd content">
            <h3 class="qd"><?php echo $parentTitle;?></h3>
            <div class="nav section">
                <?php 
                if ($previousSection) {?>
                 <a class="qd left" href="<?php echo $previousSection['url']; ?>">🠈 Prev: <?php echo $previousSection['title']; ?></a> 
                <?php 
                }
                if ($nextSection) { ?>
                <a class="qd right" href="<?php echo $nextSection['url']; ?>">Next: <?php echo $nextSection['title']; ?> 🠊</a>
                <?php 
                }?>
            </div>
            <h2 class="qd page-title" title="Click to edit this page in Google Docs if you have been allocated editing rights"><?php echo "<a class=\"qd\" href=\"$editLink\" target=\"_blank\">$pageTitle</a>";?></h2>
            <div class="nav page">
                <?php 
                if ( $previousPage) { ?>
                <a class="qd button page left" href="<?php echo $previousPage['url']; ?>">🠈 Prev: <?php echo $previousPage['title']; ?></a>
                <?php 
                }
                if ($nextPage) { ?>
                <a class="qd button page right" href="<?php echo $nextPage['url']; ?>">Next: <?php echo $nextPage['title']; ?> 🠊</a>
                <?php
                }?>
            </div>
            <div class="embed">
                <?php 
                    echo getDisplayPage($pageElement);
                ?>
            </div>
        </div>
        <div class="qd outline">
            <a class="qd" href="//<?php echo $server;?>" target="_blank"><h2><?php echo $subTitle;?></h2></a>
            <?php echo html_menu($path); ?>
            <div class="links">
                <?php
                    foreach($outline['links'] as $link)
                    {
                        ?>
                        <a class="qd section" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                        <?php
                    }
                ?>
            </div>
            <div class="extras">
                <a hidden class="qd editlink" href="<?php echo $editLink;?>">EDIT</a>
            </div>
        </div>
    </div>
</body>
</html>