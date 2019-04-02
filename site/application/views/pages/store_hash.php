<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
            <?php
                echo $title;
            ?>
        </title>
        <style>
            input {
                visibility: hidden;
            }
        </style>
    </head>
    <body>
        <input readonly="readonly" type="number" id="level-id" value="<?php echo $user['level_id']; ?>" /><!--
        --><input readonly="readonly" type="text" id="username" value="<?php echo $user['username']; ?>" /><!--
        --><input readonly="readonly" type="text" id="e-mail" value="<?php echo $user['e_mail']; ?>" /><!--
        --><input readonly="readonly" type="text" id="password" value="<?php echo $user['password']; ?>" /><!--
        --><script>
            const USER = {
                    levelId: document.getElementById('level-id').value,
                    username: document.getElementById('username').value,
                    eMail: document.getElementById('e-mail').value,
                    password: document.getElementById('password').value
                }

            localStorage.setItem('user', JSON.stringify(USER))
            console.log(localStorage.getItem('user'))
        </script>
    </body>
</html>
