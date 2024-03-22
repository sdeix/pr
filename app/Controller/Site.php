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
        return new View('site.employees', ['users' => $users]);
    }
    public function addemployee(Request $request): string
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                if($request->method==="POST"){
                    User::create($request->all());
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
        if($request->method==="POST"){
            Department::create($request->all());
            app()->route->redirect('/employees');
            return "";
        }
        return new View('site.adddepartament');
    }
    public function adddiscipline(Request $request): string
    {
        if($request->method==="POST"){
            Discipline::create($request->all());
            app()->route->redirect('/employees');
            return "";
        }
        return new View('site.adddiscipline');
    }
    public function disciplineemployees(Request $request): string
    {
        if($request->method==="POST"){
            Disciplinesemployees::create($request->all());
            app()->route->redirect('/employees');
            return "";
        }
        $users = User::all();
        $disciplines = Discipline::all();
        return new View('site.disciplineemployees', ['disciplines' => $disciplines,'users'=>$users]);
    }
}
