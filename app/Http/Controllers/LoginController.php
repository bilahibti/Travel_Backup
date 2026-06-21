<?php 
namespace App\Http\Controllers; 
 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
 
class LoginController extends Controller 
{ 
    // ─────────────────────────────────────────────
    // BACKEND
    // ─────────────────────────────────────────────
 
    public function loginBackend() 
    { 
        return view('backend.v_login.login', [ 
            'judul' => 'Login', 
        ]); 
    } 
 
    public function authenticateBackend(Request $request) 
    { 
        $credentials = $request->validate([ 
            'email'    => 'required|email', 
            'password' => 'required' 
        ]); 
 
        if (Auth::attempt($credentials)) { 
            $user = Auth::user();
            $request->session()->regenerate(); 
 
            switch ($user->role->slug) {
                case 'admin':
                    return redirect()->route('v1.backend.dashboard.admin.dashboard');
                case 'staff':
                    return redirect()->route('v1.backend.dashboard.staff.dashboard');
                default:
                    Auth::logout();
                    return back()->with('error', 'Access is not allowed for backend users');
            }
        } 
 
        return back()->with('error', 'Login failed. Please check your credentials.'); 
    }
 
    public function logoutBackend() 
    { 
        Auth::logout(); 
        request()->session()->invalidate(); 
        request()->session()->regenerateToken(); 
        return redirect(route('v1.backend.login.login')); 
    } 
 
    public function registerBackend()
    {
        return view('backend.v_login.register', [
            'judul' => 'Register'
        ]);
    }
 
    // ─────────────────────────────────────────────
    // FRONTEND
    // ─────────────────────────────────────────────
 
    public function loginFrontend() 
    { 
        // Redirect jika sudah login
        if (Auth::check()) {
            return redirect()->route('v1.frontend.dashboard');
        }
        return view('frontend.v_login.login', [ 
            'judul' => 'Login', 
        ]); 
    }
 
    public function authenticateFrontend(Request $request) 
    { 
        $credentials = $request->validate([ 
            'email'    => 'required|email', 
            'password' => 'required' 
        ]); 
 
        if (Auth::attempt($credentials, $request->boolean('remember'))) { 
            $user = Auth::user();
 
            // Pastikan role customer atau yang tidak punya akses backend
            if ($user->role && in_array($user->role->slug, ['admin', 'staff'])) {
                // Boleh login ke frontend juga (opsional — hapus blok ini jika admin tidak boleh)
            }
 
            $request->session()->regenerate(); 
            return redirect()->intended(route('v1.frontend.dashboard')); 
        } 
 
        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Email or password is incorrect. Please try again.'); 
    }
 
    public function logoutFrontend() 
    { 
        Auth::logout(); 
        request()->session()->invalidate(); 
        request()->session()->regenerateToken(); 
        return redirect(route('v1.frontend.login.login'))
            ->with('success', 'You have been logged out successfully.'); 
    }
 
    public function registerFrontend()
    {
        // Redirect jika sudah login
        if (Auth::check()) {
            return redirect()->route('v1.frontend.dashboard');
        }
        return view('frontend.v_login.register', [
            'judul' => 'Register'
        ]);
    }
    
    public function storeRegister(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:user,email',
            'hp'                    => 'nullable|string|max:20',
            'password'              => 'required|string|confirmed|min:8',
        ], [
            'name.required'         => 'Full name is required.',
            'email.required'        => 'Email is required.',
            'email.unique'          => 'Email is already registered. Please use a different email.',
            'password.min'          => 'Password must be at least 8 characters.',
            'password.confirmed'    => 'Password confirmation does not match.',
        ]);
 
        $customerRole = \App\Models\Role::where('slug', 'customer')->first();
 
        if (!$customerRole) {
            return back()->with('error', 'Customer role is not available yet. Please contact the administrator.');
        }
 
        $user = \App\Models\User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'hp'       => $validated['hp'] ?? null,
            'password' => bcrypt($validated['password']),
            'role_id'  => $customerRole->id,
        ]);
 
        Auth::login($user);
 
        return redirect()->route('v1.frontend.dashboard')
            ->with('success', 'Welcome, ' . $user->name . '! Akun Anda berhasil dibuat.');
    }
} 