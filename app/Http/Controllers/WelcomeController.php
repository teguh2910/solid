<?php namespace App\Http\Controllers;
use App\User;
class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

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
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}

	public function user_create()
	{
		return view('user.create');
	}

	public function save_create()
	{
		$input = \Input::all();
		$user = new User;

		$pwd1 = $input['password'];
		$pwd2 = $input['password1'];
		if ($pwd1 == $pwd2) {
        $name = $input['name'];
        $user->password = bcrypt($input['password']);
        $user->email = $input['email'];
        $user->name = $input['name'];
        $user->role = $input['role'];
        $user->dept_code = $input['dept_code'];
        $user->save();
        \Session::flash('flash_type','alert-success');
        \Session::flash('flash_message','User was successfully created');
        return redirect('home');
		} else {
			return redirect('user/crate');
		}
		
	}


}
