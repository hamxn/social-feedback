<?php
/**
 * RegisterController
 *
 * PHP version 7
 *
 * @category Controller
 * @package  RegisterController
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
namespace App\Http\Controllers\Auth;

use App\Models\Administrator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

/**
 * Class RegisterController
 *
 * PHP version 7
 *
 * @category Controller
 * @package  RegisterController
 * @author   XuanDD <xuandd@lifull-tech.vn>
 * @link     https://bitbucket.org/dinhdiemxuan/reportchain
 */
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data data to validate
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admin_users',
                'password' => 'required|string|min:6|confirmed',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data to create
     *
     * @return \App\Models\Administrator
     */
    protected function create(array $data)
    {
        $user = Administrator::create(
            [
                'username' => $data['username'],
                'email'    => $data['email'],
                'password' => bcrypt($data['password']),
                'name'     => $data['username'],
            ]
        );
        \DB::table('admin_role_users')->insert(
            [
                [
                    'role_id' => config('myconfig.roles.text.USER'),
                    'user_id' => $user->id,
                ],
            ]
        );
        return $user;
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
