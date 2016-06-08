<?php
list( $x, $y ) = $args;

?>
    <form>
        <label for="x">Введите x:</label>
        <input name="x" value="<?php echo $x; ?>" />
        <label for="y">Введите y:</label>
        <input name="y" value="<?php echo $y; ?>" />

        <input type="submit" value="Посчитать" />
    </form>
