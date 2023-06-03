<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	//
	// Аутентификация зарегистрированного пользователя
	//
    public function login(Request $request)
    {
//		Валидация
        $request->validate([
            'login' => 'required|exists:users|alpha_dash',
            'password' => 'required|min:6'
        ]);
//		Узнаем пользователя по логину
        $user = User::where('login', $request->login)->first();
//		Проверяем хеш из базы данных и введенный пароль
        if (!Hash::check($request->password, $user->password)) return response()->json([
            'errors' => [
                'password' => ['Неверный логин или пароль']
            ]
        ], 422);

        Auth::login($user, true);

        return $user;
    }

	//
	// Регистрация нового пользователя
	//
    public function register(Request $request)
    {
//		Валидируем поля необходимые для регистрации
        $request->validate([
            'name' => 'required|alpha_dash',
            'surname' => 'required|alpha_dash',
            'patronymic' => 'nullable|alpha_dash',
            'login' => 'required|unique:users|alpha_dash',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
            'password_repeat' => 'required|same:password',
            'rules' => 'accepted',
        ]);

        $userDto = $request->except('password_repeat', 'rules');
        $user = new User($userDto);
//		хешируем пароль в bcrypt (10 итераций)
		$user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user, true);

        return $user;
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
