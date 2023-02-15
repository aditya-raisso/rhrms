<?php
  
namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
   
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
  
    use AuthenticatesUsers;
  
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
   
    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email|exists:users,email|max:100',
            'password' => 'required|string|max:20',
        ]);
   
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])) )
        {
            if (auth()->user()->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }elseif (auth()->user()->role_id == 2) {
                return redirect()->route('employee.dashboard',['emp'=>auth()->user()->emp_id]);
            }else{
                // return redirect()->route('login')
                // ->with('error','You are not authorize .');
                 return redirect()->route('employee.dashboard',['emp'=>auth()->user()->emp_id]);
            }
        }else{
            return redirect()->route('login')
                ->with('error','Your Email and Password did not match.');
        }
          
    }
}