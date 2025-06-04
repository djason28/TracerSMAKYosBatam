<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('Login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


// tampilkan form
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// proses kirim email reset
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (Request $request, string $token) {
    $email = $request->query('email');

    return view('auth.reset-password', [
        'token' => $token,
        'email' => $email,
    ]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    // Cari user berdasarkan email untuk menentukan minimal length
    $email = $request->input('email');
    $user  = User::where('email', $email)->first();

    // Jika role = 'admin', min:6; selainnya (alumni) min:8
    $min = 8;
    if ($user && $user->role === 'admin') {
        $min = 6;
    }

    // Lakukan validasi dinamis
    $request->validate([
        'token'    => 'required',
        'email'    => 'required|email',
        'password' => "required|string|confirmed|min:$min",
    ], [
        'password.min' => "Password harus minimal $min karakter.",
    ]);

    // Proses reset password bawaan Laravel
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');




Route::get('/signup', function () {
    return view('Signup');
})->name('signup');



Route::middleware(['auth', 'role:admin'])->group(function () {

Route::get('/dashboard/admin', [AdminController::class, 'indexAdmin'], function () {
    return view('admin/admindb_admin');
})->name('admindb_admin'); //show dashboard admin / admin

Route::get('/dashboard/admin/addform', function () {
    return view('admin/adminformadd_admin');
})->name('addadmin'); // add admin

Route::get('/dashboard/admin/editform/{id}', [AdminController::class, 'showAdmin'], function () {
    return view('admin/adminformedit_admin');
})->name('editadmin'); // edit admin

Route::put('/dashboard/admin/editform/{id}', [AdminController::class, 'updateAdmin'])->name('updateadmin'); // apply changes edit admin




Route::get('/dashboard/alumni', [AdminController::class, 'indexAlumni'], function () {
    return view('admin/alumnidb_admin');
})->name('alumnidb_admin'); // show dashboard admin / alumni

Route::get('/dashboard/alumni/addform',function () {
    return view('admin/alumniformadd_admin');
})->name('addalumni'); // add alumni

Route::get('/dashboard/alumni/editform/{id}', [AdminController::class, 'showAlumni'] , function () {
    return view('admin/alumniformedit_admin');
})->name('editalumni'); // edit admin


Route::put('/dashboard/alumni/editform/{id}', [AdminController::class, 'updateAlumni'])->name('updatealumni'); // apply changes edit admin


Route::get('/dashboard/alumni/search', [AdminController::class, 'searchAlumni'])->name('alumni.search');
Route::get('/dashboard/admin/search', [AdminController::class, 'searchAdmin'])->name('admin.search');



Route::get('/dashboard', [AdminController::class, 'dashboard'], function () {
    return view('admin/dashboard');
})->name('dashboard'); //show dashboard alumni

});



Route::middleware(['auth', 'role:alumni'])->group(function () {

Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni');
Route::get('/alumni/edit/{id}', [AlumniController::class, 'showedit'])->name('edit_profil');
Route::put('/alumni/edit/{id}', [AlumniController::class, 'update'])->name('updateprofil'); 

});
    


Route::get('/auth/callback', [AuthController::class, 'handleCallback']);



Route::post('/logout', function (Request $request) {
    auth()->logout(); 
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->json(['message' => 'Logged out'], 200);
});





Route::post('/admin/admin/import', [AdminController::class, 'importadmin'])
     ->name('import.admin.process');
Route::post('/admin/alumni/import', [AdminController::class, 'import'])
     ->name('import.alumni.process');
Route::get('/jobs/status/{jobId}', function($jobId) {
    // Ambil apa yang sudah di‐put oleh job (array) di cache.
    $data = Cache::get("import-status:{$jobId}");

    // Jika belum ada (job belum memanggil Cache::put), kembalikan default “pending”
    if (! $data) {
        return response()->json([
            'status'     => 'pending',
            'duplicates' => [],
            'imported'   => [],
        ]);
    }

    // Jika $data sudah berisi array, susun kembali tiga key-nya
    return response()->json([
        'status'     => $data['status']     ?? 'pending',
        'duplicates' => $data['duplicates'] ?? [],
        'imported'   => $data['imported']   ?? [],
    ]);
});

