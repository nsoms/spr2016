<?php
list( $x, $y ) = $args;

?>
<table width="100%">
    <?php
    for ($j = 1; $j <= $y; $j++) {
        echo "<tr>\n";
        for ($i = 1; $i <= $x; $i++)
            echo "<td>" . $i * $j . "</td>\n";
        echo "</tr>\n";
    }
    ?>
</table>