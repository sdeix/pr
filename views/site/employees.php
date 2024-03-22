<h1>Список Сотрудников</h1>
<form action="" method="post">
<p><input type="text" name="name" placeholder="Имя"></p>
<input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <p><input type="submit" value="Отправить"></p>
  </form>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Фамилия</th>
      <th>Имя</th>
      <th>Отчество</th>
      <th>Дата рождения</th>
      <th>Пол</th>
      <th>Кафедра</th>
      <th>Дисциплины</th>
      <th>Адрес проживания</th>
      <th>Фото сотрудника</th>
    </tr>
  </thead>
  <tbody>
    <?php

    use Model\Department;
    use Model\Discipline;
    use Model\Disciplinesemployees;

    foreach ($users as $user) {
      echo '  <tr>';
      echo '<th>' . $user->surname . '</th>';
      echo '<th>' . $user->name . '</th>';
      echo '<th>' . $user->patronymic . '</th>';
      echo '<th>' . $user->date . '</th>';
      echo '<th>' . $user->gender . '</th>';
      $departaments = Department::where('id', $user->departament_id)->get();
      echo '<th>';
      foreach ($departaments as $departament) {
        echo $departament->departament_name . ' ';
      }
      echo '</th>';
      echo '<th>';
      $disciplineid = Disciplinesemployees::where('employee_id', $user->id)->get();

      foreach ($disciplineid as $discipline) {

        $disciplines = Discipline::where('id', $discipline->discipline_id)->get();

        if(count($disciplines)!=0){
          echo $disciplines[0]->discipline_name . ' ';
        }

      }
      echo '</th>';
      echo '<th>' . $user->address . '</th>';
      echo '<th class=""><img class="img "src="' . $user->photo . '"></th>';
    }
    ?>
  </tbody>
</table>

