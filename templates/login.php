<?php
list($login) = $args;

$login = ($login === null ? '' : $login);
?>
<form method="post">
    <div>
    <label for="login">Введите логин: </label>
    <input type="text" name="login"
           value="<?php echo $login; ?>"
           placeholder="Введите логин сюда" />
    </div>
    <div>
    <label for="passwd">Введите пароль: </label>
    <input type="password" name="passwd" />
    </div>
    <input type="submit" value="Дави" />
</form>
