<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Pop it MVC</title>
</head>

<body style=" background-color: gray; margin: 0">

    <header>
        <nav>
            <?php

            if (app()->auth::check() && app()->auth::user()->role == "admin"):
                ?>
                <a href="<?= app()->route->getUrl('/addemployee') ?>">Добавить сотрудника</a>
                <?php
            elseif (app()->auth::check()):
                ?>
                <a href="<?= app()->route->getUrl('/employees') ?>">Сотрудники</a>

                <a href="<?= app()->route->getUrl('/adddepartament') ?>">Добавить кафедру</a>
                <a href="<?= app()->route->getUrl('/adddiscipline') ?>">Добавить дисциплину</a>
                <a href="<?= app()->route->getUrl('/disciplineemployees') ?>">Прикрепить дисциплину к сотруднику</a>
                <?php
            endif;


            if (!app()->auth::check()):
                ?>
                <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
                <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
                <?php
            else:
                ?>
                <a href="<?= app()->route->getUrl('/logout') ?>">Выход (
                    <?= app()->auth::user()->name ?>)
                </a>
                <?php
            endif;
            ?>
        </nav>
    </header>
    <main>
        <?= $content ?? '' ?>
    </main>

</body>

</html>