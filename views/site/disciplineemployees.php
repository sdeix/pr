<div>
    <form style="background-color: lightgray;" method="post">
        <H3>Прикрепление дисциплины к сотруднику</H3>
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
     <p>Сотрудник:</p>  
      <select size="1" name="employee_id">
            <?php
            foreach ($users as $user) {
                echo '<option value="' . $user->id . '">' . $user->name." " .$user->surname. '</option>';
            }
            ?>
        </select>
        <p>Дисциплина:</p>  
        <select size="1" name="discipline_id">
            <?php
            foreach ($disciplines as $discipline) {
                echo '<option value="' . $discipline->id . '">' . $discipline->discipline_name. '</option>';
            }
            ?>
        </select>
        <button class="form_button">Прикрепить</button>
    </form></background-color: white;>


    </form>
</div>