<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\ImageHelper;
use App\Models\Role;

class UserController extends Controller 
{ 
    public function index() 
    { 
        $user = User::orderBy('updated_at', 'desc')->get(); 
        return view('backend.v_user.index', [ 
            'judul' => 'Data User', 
            'index' => $user 
        ]); 
    } 

     public function create() 
    { 
        return view('backend.v_user.create', [ 
            'judul' => 'Add User', 
            'roles' => Role::all(),
        ]); 
    } 

    public function destroy(string $id) 
    { 
        $user = User::findOrFail($id); 
        if ($user->foto) { 
            $oldImagePath = public_path('storage/img-user/') . $user->foto; 
            if (file_exists($oldImagePath)) { 
                unlink($oldImagePath); 
            } 
        } 
        $user->delete(); 
        return redirect()->route('backend.user.index')->with('success', 'Data already deleted'); 
    }

    public function edit(string $id) 
    { 
        $user = User::findOrFail($id); 
        $roles = Role::all();
        
        return view('backend.v_user.edit', [ 
            'judul' => 'Change User', 
            'edit' => $user ,
            'roles' => $roles
        ]); 
    }

    public function store(Request $request) 
    { 
        $validatedData = $request->validate([ 
            'name' => 'required|max:255', 
            'email' => 'required|max:255|email|unique:user,email', 
            'role' => 'required', 
            'hp' => 'required|min:10|max:13', 
            'password' => 'required|min:4|confirmed', 
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024', 

        ], $messages = [ 
            'foto.image' => 'The image format must be jpeg, jpg, png, or gif.', 
            'foto.max' => 'The maximum image file size is 1024 KB.' 
        ]); 

 
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $directory = 'img-user';   
            ImageHelper::uploadAndResize($file, $directory, $originalFileName);
            $validatedData['foto'] = $originalFileName;
        }
            User::create($validatedData); 
        
 
        // password kombinasi  
        $password = $request->input('password'); 
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'; 
        // huruf kecil ([a-z]), huruf besar ([A-Z]), dan angka (\d) (?=.*[\W_]) simbol karakter (non-alphanumeric) 
        if (preg_match($pattern, $password)) { 
            $validatedData['password'] = Hash::make($validatedData['password']); 
            User::create($validatedData, $messages); 
            return redirect()->route('backend.user.index')->with('success', 'Data berhasil tersimpan'); 
        } else { 
            return redirect()->back()->withErrors(['password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.']); 
        } 
    } 
 
     public function update(Request $request, string $id) 
    { 
        //ddd($request); 
        $user = User::findOrFail($id); 
        $validatedData = $request->validate([
            'name' => 'required|max:255', 
            'role' => 'required',  
            'hp' => 'required|min:10|max:13', 
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024', 
        ],
        
        $messages = [ 
            'foto.image' => 'The image format must be jpeg, jpg, png, or gif.', 
            'foto.max' => 'The maximum image file size is 1024 KB.' 
        ]); 
 
        $rules = [
            'name' => 'required|max:255',
            'role_id' => 'required|exists:roles,id',
            'hp' => 'required|min:10|max:13',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
        ];
        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|email|unique:user,email';
        }
        $validatedData = $request->validate($rules, [...messages]);
 
        // menggunakan ImageHelper 
        if ($request->file('foto')) { 
            //hapus gambar lama 
            if ($user->foto) { 
                $oldImagePath = public_path('storage/img-user/') . $user->foto; 
                if (file_exists($oldImagePath)) { 
                    unlink($oldImagePath); 
                } 
            } 
            $file = $request->file('foto'); 
            $extension = $file->getClientOriginalExtension(); 
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension; 
            $directory = 'img-user'; 
            // Simpan gambar dengan ukuran yang ditentukan 
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); // null (jika tinggi otomatis) 
            // Simpan nama file asli di database 
            $validatedData['foto'] = $originalFileName; 
        } 
 
        $user->update($validatedData); 
        return redirect()->route('backend.user.index')->with('success', 'Data berhasil diperbaharui'); 
    }
    
    public function formUser() 
    { 
        return view('backend.v_user.form', [ 
            'judul' => 'User Report', 
        ]); 
    } 
 
    public function printUser(Request $request) 
    { 
        // Menambahkan aturan validasi 
        $request->validate([ 
            'start_date' => 'required|date', 
            'end_date' => 'required|date|after_or_equal:start_date', 
        ], [ 
            'start_date.required' => 'Start Date is required.', 
            'end_date.required' => 'End Date is required.', 
            'end_date.after_or_equal' => 'End Date must be the same day or later than Start Date.', 
        ]); 
 
        $startdate = $request->input('start_date'); 
        $enddate = $request->input('end_date'); 
 
        $query =  User::whereBetween('created_at', [$startdate, $enddate]) 
            ->orderBy('id', 'desc'); 
 
        $user = $query->get(); 
        return view('backend.v_user.print', [ 
            'judul' => 'User Report', 
            'startdate' => $startdate, 
            'enddate' => $enddate, 
            'print' => $user 
        ]); 
    } 
 
    /** 
     * function lainnya 
     */ 
}
