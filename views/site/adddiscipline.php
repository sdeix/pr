<div>
    <form style="background-color: lightgray;" method="post">
        <H3>Добавление новых дисциплин</H3>
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div style="margin-left: 62px;">
            <li style="list-style-type: none"><input name="discipline_name" type="text" placeholder="Название дисциплины" class="form_input"></li>
        <div style="margin-left: 62px;">
    </form></background-color: white;>
    <button class="form_button">Создать</button>

    </form>
</div>