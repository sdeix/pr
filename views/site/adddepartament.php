<div>
    <form style="background-color: lightgray;" method="post">
        <H3>Добавление новых Кафедр</H3>
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div style="margin-left: 62px;">
            <li style="list-style-type: none"><input name="departament_name" type="text" placeholder="Название кафедры" class="form_input"></li>
        <div style="margin-left: 62px;">
    </form></background-color: white;>
    <button class="form_button">Создать</button>
    <?php
    echo $message??''
    ?>
    </form>
</div>