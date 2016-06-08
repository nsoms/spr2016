<?php
list( $title ) = $args;
?><html>
<head>
    <meta charset="utf-8" />
    <title><?php
        echo $title;
        ?></title>
    <?php
    HTML::put_js();
    ?>
</head>
<body>