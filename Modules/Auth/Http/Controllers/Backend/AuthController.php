<?php

namespace Modules\Auth\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Http\Requests\AuthRequest;
use App\Models\User;

class AuthController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        if ($user != null) {
            return redirect(route('cd-admin.dashboard'));
        } else {
            return view('auth::backend.login');
        }
    }

    public function login(AuthRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if ($user->hasRole('user')) {
                    return redirect()->back()->with('error', 'User does not have access to the Admin Panel');
                }
            }
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->intended(route('cd-admin.dashboard'))->with('success', 'Welcome To Admin Dashboard !');
            } else {
                return redirect()->back()->with('error', 'Invalid Login Credential');
            }
        } catch (QueryException $q) {
            return $q->getMessage();
        } catch (\Exception $e) {
            dd($e);
            return $e->getMessage();
        }
    }


    public function logOut(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('cd-admin/login')->with('success', 'Logged Out Successfully !');
    }
}
