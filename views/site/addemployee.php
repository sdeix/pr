<div>
    <form enctype="multipart/form-data" style="background-color: lightgray;" method="post">
        <H3>Добавление новых сотрудников деканата</H3>
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <div style="margin-left: 62px;">
            <li style="list-style-type: none"><input name="name" type="text" placeholder="Имя" class="form_input"></li>
            <li style="list-style-type: none"><input name="surname" type="text" placeholder="Фамилия" class="form_input"></li>
            <li style="list-style-type: none"><input name="patronymic" type="text" placeholder="Отчество" class="form_input"></li>
            <li style="list-style-type: none"><input name="address" type="text" placeholder="Адрес проживания" class="form_input"></li>
        </div>
        <label for="">Кафедра</label>
        <select size="1" name="departament_id">
            <?php
            foreach ($departaments as $departament) {
                echo '<option value="' . $departament->id . '">' . $departament->departament_name . '</option>';
            }
            ?>
        </select>
        <p> Пол<select size="1" name="gender">
 <option value="М">М</option>
 <option value="Ж">Ж</option>
        </select></p>
        <p>Фото сотрудника <input type="file" name="photo"></p>
        <p>Дата рождения <input type="date" name="date" id=""></p>
        <div style="margin-left: 62px;">
            <li style="list-style-type: none"><input type="text" name="login" placeholder="login" class="form_input"></li>
            <li style="list-style-type: none"><input type="text" name="password" placeholder="password" class="form_input"></li>
    </form></background-color: white;>
    <button class="form_button">Создать</button>

    </form>
</div>