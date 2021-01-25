<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/manage/user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // mod by nagahara@opensource-workshop.jp
        // $this->middleware('guest');
        // $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validate_rule = [
            'name'     => 'required|string|max:255',
            'userid'   => 'required|max:255|unique:users',
            'email'    => 'nullable|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'status'   => 'required',
        ];

        // ユーザ自動登録の場合（認証されていない）は、メールアドレスと個人情報保護方針への同意も必須にする。
        if (!Auth::user()) {
            $validate_rule['email'] = 'required|string|email|max:255|unique:users';
            $validate_rule['user_register_requre_privacy'] = 'required';
        }

        // 入力値チェック
        $validator = Validator::make($data, $validate_rule);

        // 項目名
        $validator->setAttributeNames([
            'name'                         => 'ユーザ名',
            'userid'                       => 'ログインID',
            'email'                        => 'eメールアドレス',
            'password'                     => 'パスワード',
            'user_register_requre_privacy' => '個人情報保護方針への同意',
        ]);

        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // ユーザ自動登録の場合（認証されていない）は、トップページに遷移する。
        if (!Auth::user()) {
            $this->redirectTo = '/';
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'userid' => $data['userid'],
            'password' => bcrypt($data['password']),
            'status' => $data['status'],
        ]);
    }
}
