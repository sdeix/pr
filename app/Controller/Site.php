<?php

namespace Controller;


use Src\View;
use Src\Validator\Validator;
use Src\Request;
use Model\User;
use Model\Discipline;
use Model\Department;
use Model\Disciplinesemployees;
use Src\Auth\Auth;




class Site
{

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }
    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if ($validator->fails()) {
                return new View(
                    'site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]
                );
            }

            if (User::create($request->all())) {
                app()->route->redirect('/login');
            }
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function job_tabel(): string
    {
        return new View('site.job_tabel');
    }

    public function employees(Request $request): string
    {
        $users = User::all();
        if ($request->method === "POST") {
            if ($request->name) {
                $users = User::where('name', $request->name)->get();
            }
        }


        return new View('site.employees', ['users' => $users]);
    }
    public function addemployee(Request $request): string
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                if ($request->method === "POST") {
                    $validator = new Validator($request->all(), [
                        'name' => ['required'],
                        'surname' => ['required'],
                        'patronymic' => ['required'],
                        'date' => ['required'],
                        'login' => ['required', 'unique:employees,login'],
                        'password' => ['required']
                    ], [
                        'required' => 'Поле :field пусто',
                        'unique' => 'Поле :field должно быть уникально'
                    ]);

                    if ($validator->fails()) {
                        return new View(
                            'site.addemployee',
                            ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]
                        );
                    }
                    $img = $request->photo['size'];
                    if ($request->photo['size'] > 0) {
                        $uploaddir = '../public/images/';
                        $uploadfile = '$uploaddir' . basename($request->photo['name']);
                        if (move_uploaded_file($request->photo['tmp_name'], $uploadfile)) {
                            $img = '/images/' . basename($request->photo['name']);
                        }

                    }
                    User::create(['name' => $request->name, 'surname' => $request->surname, 'patronymic' => $request->patronymic, 'address' => $request->address, 'photo' => $img, 'gender' => $request->gender, 'login' => $request->login, 'password' => $request->password, 'departament_id' => $request->departament_id]);
                    app()->route->redirect('/hello');
                    return "";
                }
                $departaments = Department::all();
                return new View('site.addemployee', ['departaments' => $departaments]);
            }
            app()->route->redirect('/employees');

        }
        app()->route->redirect('/employees');
    }
    public function adddepartament(Request $request): string
    {
        if ($request->method === "POST") {
            $validator = new Validator($request->all(), [
                'departament_name' => ['required', 'unique:departaments,departament_name'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if ($validator->fails()) {
                return new View(
                    'site.adddepartament',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]
                );
            }
            Department::create($request->all());
            app()->route->redirect('/employees');
            return "";
        }
        return new View('site.adddepartament');
    }
    public function adddiscipline(Request $request): string
    {
        if ($request->method === "POST") {
            $validator = new Validator($request->all(), [
                'discipline_name' => ['required', 'unique:disciplines,discipline_name'],
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if ($validator->fails()) {
                return new View(
                    'site.adddiscipline',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]
                );
            }
            Discipline::create($request->all());
            app()->route->redirect('/employees');
            return "";
        }
        return new View('site.adddiscipline');
    }
    public function disciplineemployees(Request $request): string
    {
        if ($request->method === "POST") {
            Disciplinesemployees::create($request->all());
            app()->route->redirect('/employees');
            return "";
        }
        $users = User::all();
        $disciplines = Discipline::all();
        return new View('site.disciplineemployees', ['disciplines' => $disciplines, 'users' => $users]);
    }
}
