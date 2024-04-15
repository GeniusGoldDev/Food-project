<?php

namespace App\Http\Controllers;

use App\Page;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function indexPage()
    {
        return redirect()->route('get.login');
    }

    public function loginPage()
    {
        if (Auth::user()) {
            if (Auth::user()->hasRole('Admin')) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->hasRole('Store Owner')) {
                return redirect()->route('restaurant.dashboard');
            } elseif (Auth::user()->hasPermissionTo('dashboard_view')) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('admin.manager');
            }
        }

        return view('auth.login');
    }

    public function storeRegistration()
    {
        if (Auth::user()) {
            if (Auth::user()->hasRole('Admin')) {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->hasRole('Store Owner')) {
                return redirect()->route('restaurant.dashboard');
            }
        }
        return view('auth.storeRegistration');
    }

    public function deliveryRegistration()
    {
        if (Auth::user()) {
            if (Auth::user()->hasRole('Admin')) {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->hasRole('Store Owner')) {
                return redirect()->route('restaurant.dashboard');
            }
        }
        return view('auth.deliveryRegistration');
    }

    public function getPages()
    {
        $pages = Page::all();
        return response()->json($pages);
    }

    /**
     * @param Request $request
     */
    public function getSinglePage(Request $request)
    {
        $page = Page::where('slug', $request->slug)->first();

        if ($page) {
            // sleep(5);
            return response()->json($page);
        } else {
            $page = null;
            return response()->json($page);
        }
    }

    public function forgotPassword()
    {
        if (config('appSettings.enPassResetEmail') == 'false') {
            abort(404);
        }
        if (Auth::user()) {
            if (Auth::user()->hasRole('Admin')) {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->hasRole('Store Owner')) {
                return redirect()->route('restaurant.dashboard');
            }
        }
        return view('auth.forgotPassword');
    }

    /**
     * @param Request $request
     */
    public function forgotPasswordSendEmail(Request $request)
    {
        if (config('appSettings.enPassResetEmail') == 'false') {
            abort(404);
        }

        $validator = $request->validate([
            'captcha' => ['required', 'captcha'],
            'email' => ['required', 'string', 'email'],
        ],
            [
                'captcha.required' => 'Captcha is a required field.',
                'captcha.captcha' => 'Invalid Captcha',

                'email.required' => 'Email is a required field.',
                'email.string' => 'Email is invalid.',
                'email.email' => 'Email is invalid.',
            ]);

        $user = User::where('email', $request->email)->first();
        //if not user, send message, but dont redirect
        if (!$user) {
            return redirect()->back()->with(['resetPasswordMessage' => 'An email will be sent shortly to your email address if an account exists with us.']);
        }

        //generate password reset code...
        // try {
        $token = strtoupper(str_random(6));
        $exists = DB::table('password_resets')->where('email', $user->email)->first();
        if (!$exists) {
            DB::table('password_resets')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
        } else {
            DB::table('password_resets')->where('email', $user->email)->update(['token' => $token]);
        }

        $this->sendPasswordResetEmail($user->name, $user->email, $token);

        return redirect()->route('changePassword');

    }

    /**
     * @param $name
     * @param $email
     * @param $token
     */
    private function sendPasswordResetEmail($name, $email, $token)
    {
        $data = [
            'name' => $name,
            'email' => $email,
            'code' => $token,
        ];

        Mail::send('emails.passwordReset', ['mailData' => $data], function ($message) use ($data) {
            $message->subject(config('appSettings.passwordResetEmailSubject'));
            $message->from(config('appSettings.sendEmailFromEmailAddress'), config('appSettings.sendEmailFromEmailName'));
            $message->to($data['email']);
        });

    }

    public function changePassword()
    {
        if (config('appSettings.enPassResetEmail') == 'false') {
            abort(404);
        }
        if (Auth::user()) {
            if (Auth::user()->hasRole('Admin')) {
                return redirect()->route('admin.dashboard');
            }
            if (Auth::user()->hasRole('Store Owner')) {
                return redirect()->route('restaurant.dashboard');
            }
        }
        return view('auth.changePassword');
    }

    /**
     * @param Request $request
     */
    public function changePasswordPost(Request $request)
    {
        $validator = $request->validate([
            'captcha' => ['required', 'captcha'],
            'code' => ['required', 'min:6', 'max:6'],
            'password' => ['required', 'string', 'min:6'],
        ],
            [
                'captcha.required' => 'Captcha is a required field.',
                'captcha.captcha' => 'Invalid Captcha',

                'code.required' => 'Reset Code is a required field.',
                'code.min' => 'Reset Code is invalid.',
                'code.max' => 'Reset Code is invalid.',

                'password.required' => 'Password is a required field.',
                'password.string' => 'Password is invalid.',
                'password.min' => 'Password must be atleast 6 characters long.',
            ]);

        $code = $request->code;

        $token = DB::table('password_resets')->where('token', $code)->first();

        if (!$token) {
            return redirect()->back()->with(['invalidFields' => 'Invalid reset code or code not found in the records.']);
        }

        $user = User::where('email', $token->email)->first();
        if (!$user) {
            return redirect()->back()->with(['invalidFields' => 'User not found.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        //delete token.
        DB::table('password_resets')->where('email', $token->email)->delete();

        return redirect()->route('get.login')->with(['success' => 'Password reset successful. You can now login with the new password.']);
    }
}
