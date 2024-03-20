<h2>Регистрация нового пользователя</h2>
<pre><?= $message ?? ''; ?></pre>
<form method="post">
   <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
   <label>Имя <input type="text" name="name"></label>
   <select name="Пол" id="">
   <option value="" disabled>Выберете ваш пол</option>
   <option value="М">Мужской</option>
  <option value="Ж">Женский</option></select>
   <label>Логин <input type="text" name="login"></label>
   <label>Дата рождения<input type="date" name="Дата рождения" id=""></label>
 <label>Прописка <input type="text" name="Адрес прописки"></label>
   <label>Пароль <input type="password" name="password"></label>
   <button>Зарегистрироваться</button>
</form>