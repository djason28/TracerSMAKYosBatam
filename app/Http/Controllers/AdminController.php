<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Helpers\JsonHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;                   
use Illuminate\Support\Facades\Auth;     
use Illuminate\Validation\Rule;          
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\ImportAlumni;
use App\Jobs\importAdmin;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // ---------- ADMIN PROFILE ----------

    public function show(): JsonResponse
    {
        $user = Auth::user();

        if (! $user) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Harap login terlebih dahulu'
            ], 401);
        }

        // Opsi: pastikan hanya role=admin
        if ($user->role !== 'admin') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Akses ditolak'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'data'   => $user
        ], 200);

    }

    public function update(Request $request): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Harap login terlebih dahulu'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'name'                  => 'sometimes|string|max:255',
            'email'                 => 'sometimes|email|unique:users,email,' . $user->id,
            'password'              => 'sometimes|nullable|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    // ---------- ADMIN CRUD ----------

    public function indexAdmin()
    {
        $admins = User::where('role', 'admin')->paginate(10);
        return view('admin.admindb_admin', compact('admins'));
    }

    public function storeAdmin(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name'     => 'required|string',
            'email'            => [
                'nullable',
                'email',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    if ($value && !str_ends_with(strtolower($value), '@gmail.com')) {
                        $fail('Email harus menggunakan @gmail.com.');
                    }
                },
            ],
            'password' => 'required|string|min:6',
        ]);
        if ($v->fails()) {
            return response()->json(['status'=>'error','errors'=>$v->errors()], 422);
        }
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
        ]);
        
        return response()->json($user, 201);
    }

    public function showAdmin($id)
    {
        try {
            $admin = User::where('role','admin')->findOrFail($id);
            return view('admin.adminformedit_admin', compact('admin'));
        } catch (ModelNotFoundException $e) {
            return response()->json(['status'=>'error','message'=>'Admin tidak ditemukan'], 404);
        }
    }

    public function updateAdmin(Request $request, $id)
    {
        try {
            // Ambil data admin berdasarkan ID
            $admin = User::where('role', 'admin')->findOrFail($id);

            $v = Validator::make($request->all(), [
                'name'             => 'sometimes|required|string|max:255',
                'email'            => [
                'sometimes',
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($admin->id),
                function ($attribute, $value, $fail) {
                    if ($value && !str_ends_with(strtolower($value), '@gmail.com')) {
                        $fail('Email harus menggunakan @gmail.com.');
                    }
                },
            ],
                'password'         => 'sometimes|nullable|string|min:6'
            ]);
    

            if ($v->fails()) {
                return redirect()->back()
                    ->withErrors($v)
                    ->withInput();
            }

            // Cek jika ada password lama tapi tidak ada password baru → tolak
            if ($request->filled('old_password') && !$request->filled('password')) {
                return back()->withErrors(['password' => 'Harap isi password baru jika mengisi password lama.']);
            }
    
            // Jika ada password baru → validasi password lama
            if ($request->filled('password')) {
                if (!$request->filled('old_password') || !Hash::check($request->old_password, $admin->password)) {
                    return back()->withErrors(['old_password' => 'Password lama salah atau tidak diisi']);
                }
    
                $admin->password = Hash::make($request->password);
            }
    
            // Update nama dan email
            $admin->update($request->only(['name', 'email']));
            $admin->save();
    
            return redirect()->route('admindb_admin')->with('success', 'Admin berhasil diperbarui!');
        
        } catch (ModelNotFoundException $e) {
            return response()->json(['status'=>'error', 'message'=>'Admin tidak ditemukan'], 404);
        }
    }

    public function destroyAdmin($id)
    {
        try {
            $admin = User::where('role','admin')->findOrFail($id);

            // Cek apakah yang akan dihapus adalah dirinya sendiri
            if ($admin->id === auth()->id()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda tidak dapat menghapus akun Anda sendiri.'
                ], 403);
            }

            $admin->delete();
            return response()->json(['status'=>'delete complete'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status'=>'error','message'=>'Admin tidak ditemukan'], 404);
        }
    }

public function batchDeleteAdmins(Request $request)
{
    $ids = $request->input('ids');

    if (!is_array($ids) || empty($ids)) {
        return response()->json(['status' => 'error', 'message' => 'ID tidak valid'], 400);
    }

    if (in_array(auth()->id(), $ids)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Anda tidak dapat menghapus akun Anda sendiri dalam penghapusan massal.'
        ]);
    }

    User::whereIn('id', $ids)->where('role', 'admin')->delete();

    return response()->json(['status' => 'success', 'message' => 'Admin terhapus']);
}

    public function importFormAdmin()
    {
        return view('admin.import_admin'); 
    }

    public function importAdmin(Request $request)
    {
        // 1) Validasi: harus ada file Excel
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        // 2) Simpan file Excel ke storage/app/imports
        $path = $request->file('file')->store('imports');

        // 3) Buat jobId unik
        $jobId = (string) Str::uuid();

        // 4) Inisialisasi cache untuk job status: 
        //    status = pending, duplicates = [], imported = []
        Cache::put(
            "import-status:{$jobId}",
            [
                'status'     => 'pending',
                'duplicates' => [],
                'imported'   => [],
            ],
            now()->addMinutes(30)
        );

        // 5) Dispatch Job
        ImportAdmin::dispatch($path, $jobId)
            ->onQueue('imports')
            ->delay(now());

        // 6) Return JSON { job_id }
        return response()->json(['job_id' => $jobId]);
    }




    // ---------- ALUMNI CRUD ----------

    public function indexAlumni()
    {
        $alumniad = User::where('role', 'alumni')
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        return view('admin.alumnidb_admin', compact('alumniad'));
    }


    public function storeAlumni(Request $request)
    {
        
        $v = Validator::make($request->all(), [
            'name'             => 'required|string|max:255',
            'password'         => 'required|string|min:8',
            'nis'              => 'required|string|min:4|max:4|unique:users,nis',
            'email'            => [
                'nullable',
                'email',
                'unique:users,email',
                function ($attribute, $value, $fail) {
                    if ($value && !str_ends_with(strtolower($value), '@gmail.com')) {
                        $fail('Email harus menggunakan @gmail.com.');
                    }
                },
            ],
            'birth_date'       => 'nullable|date',
            'insta'            => 'nullable|string|max:50',
            'university_name'  => 'nullable|string|max:255',
            'job_title'        => 'nullable|string|max:100',
            'work'             => 'nullable|string|max:100',
            'city'             => 'nullable|string|max:100',
            'major'            => 'nullable|string|max:100',
            'graduation_year'  => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'phone'            => 'nullable|string|max:20',
        ]);
        if ($v->fails()) {
            return response()->json(['status'=>'error','errors'=>$v->errors()], 422);
        }

        $work_place = $request->work . ', ' . $request->city;

        $user = User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'password'        => Hash::make($request->password),
            'role'            => 'alumni',
            'nis'             => $request->nis,
            'birth_date'      => $request->birth_date,
            'insta'           => $request->insta,
            'university_name' => $request->university_name,
            'job_title'       => $request->job_title,
            'work_place'      => $work_place,
            'major'           => $request->major,
            'graduation_year' => $request->graduation_year,
            'phone'           => $request->phone,
        ]);
        JsonHelper::updateMajorsJson($request->major);
        JsonHelper::updateCitiesJson($request->city);
        JsonHelper::updateUnivJson($request->university_name);

        return response()->json($user, 201);
    }



    public function showAlumni($id)
    {
        try {
            $alumniad = User::where('role','alumni')->findOrFail($id);


            // Pisahkan kota dan tempat kerja
            if ($alumniad->work_place) {
                $split = explode(',', $alumniad->work_place);
                $work = trim($split[0] ?? '');
                $city = trim($split[1] ?? '');
            } else {
                $work = '';
                $city = '';
            }

            return view('admin.alumniformedit_admin', compact('alumniad', 'work', 'city'));
        } catch (ModelNotFoundException $e) {
            return response()->json(['status'=>'error','message'=>'Alumni tidak ditemukan'], 404);
        }
        }

    public function updateAlumni(Request $request, $id)
    {
        try {
        $alumniad = User::where('role', 'alumni')->findOrFail($id);

        $v = Validator::make($request->all(), [
            'name'             => 'sometimes|required|string|max:255',
            'email'            => [
                'sometimes',
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($alumniad->id),
                function ($attribute, $value, $fail) {
                    if ($value && !str_ends_with(strtolower($value), '@gmail.com')) {
                        $fail('Email harus menggunakan @gmail.com.');
                    }
                },
            ],
            'password'         => 'sometimes|nullable|string|min:8',
            'nis'              => [
                'sometimes',
                'required',
                'string',
                'min:4',
                'max:4',
                Rule::unique('users', 'nis')->ignore($alumniad->id),
            ],
            'birth_date'       => 'sometimes|nullable|date',
            'insta'            => 'sometimes|nullable|string|max:50',
            'university_name'  => 'sometimes|nullable|string|max:255',
            'job_title'        => 'sometimes|nullable|string|max:100',
            'work'             => 'sometimes|nullable|string|max:100',
            'city'             => 'sometimes|nullable|string|max:100',
            'major'            => 'sometimes|nullable|string|max:100',
            'graduation_year'  => 'sometimes|nullable|integer|min:1900|max:' . (date('Y') + 1),
            'phone'            => 'sometimes|nullable|string|max:20',
        ]);

            if ($v->fails()) {
                return redirect()->back()
                    ->withErrors($v)
                    ->withInput();
            }

            // Update password if provided
            if ($request->filled('password')) {
                $alumniad->password = Hash::make($request->password);
            }

            $work_place = null;
            if ($request->filled('work') && $request->filled('city')) {
                $work_place = $request->work . ', ' . $request->city;
            } elseif ($request->filled('work')) {
                $work_place = $request->work;
            } elseif ($request->filled('city')) {
                $work_place = $request->city;
            } else {
                $work_place = ', ';
            }

            // Update other fields
            $alumniad->fill([
                'name'            => $request->name,
                'email'           => $request->email,
                'nis'             => $request->nis,
                'birth_date'      => $request->birth_date,
                'insta'           => $request->insta,
                'university_name' => $request->university_name,
                'job_title'       => $request->job_title,
                'work_place'      => $work_place,
                'major'           => $request->major,
                'graduation_year' => $request->graduation_year,
                'phone'           => $request->phone,
            ]);

            $alumniad->save();

            JsonHelper::updateMajorsJson($request->major);
            JsonHelper::updateCitiesJson($request->city);
            JsonHelper::updateUnivJson($request->university_name);

            return redirect()->route('alumnidb_admin')->with('success', 'Alumni berhasil diperbarui!');
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'error', 'message' => 'Alumni tidak ditemukan'], 404);
        }
    }



    public function destroyAlumni($id)
    {
        try {
            $alumni = User::where('role','alumni')->findOrFail($id);
            $alumni->delete();
            return response()->json(['status'=>'delete complete'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status'=>'error','message'=>'Alumni tidak ditemukan'], 404);
        }
    }

        public function batchDeleteAlumni(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || empty($ids)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada ID yang dikirim.'
            ], 400);
        }

        try {
            User::where('role', 'alumni')
                ->whereIn('id', $ids)
                ->delete();

            return response()->json(['status' => 'batch delete complete'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menghapus alumni.'
            ], 500);
        }
    }

    public function searchAlumni(Request $request)
    {
        $query = $request->input('query');

        $results = User::where('role', 'alumni')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('nis', 'like', '%' . $query . '%')
                ->orWhere('major', 'like', '%' . $query . '%')
                ->orWhere('university_name', 'like', '%' . $query . '%')
                ->orWhere('graduation_year', 'like', '%' . $query . '%')
                ->orWhere('work_place', 'like', '%' . $query . '%');
            })
            ->get();

        return response()->json($results);
    }
    


        public function searchAdmin(Request $request)
    {
        $query = $request->input('query');

        $results = User::where('role', 'admin')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%')
                ->orWhere('id', 'like', '%' . $query . '%');
            })
            ->get();

        return response()->json($results);
    }




        public function dashboard()
    {
        
        // Total Alumni
        $totalAlumni = User::where('role', 'alumni')->count();

        // Top Universitas (filtered by alumni only)
        $topUniversitas = User::where('role', 'alumni')
            ->select('university_name', DB::raw('count(*) as total'))
            ->groupBy('university_name')
            ->orderByDesc('total')
            ->first();

        // Alumni per Angkatan (filtered by alumni only)
        $alumniPerAngkatan = User::where('role', 'alumni')
            ->select(DB::raw("COALESCE(graduation_year, 'Belum Diisi') as graduation_year"), DB::raw('count(*) as total'))
            ->groupBy('graduation_year')
            ->orderByRaw("CASE WHEN graduation_year IS NULL THEN 0 ELSE 1 END, graduation_year ASC")
            ->get();

        // Distribusi tempat kerja per kota (filtered by alumni only)
        $alumniPerKota = DB::table('users')
            ->select(
                DB::raw("
                    COALESCE(
                        NULLIF(
                            TRIM(
                                CASE
                                    WHEN instr(work_place, ',') > 0 THEN substr(work_place, instr(work_place, ',') + 1)
                                    ELSE work_place
                                END
                            ),
                            ''
                        ),
                        'Belum Diisi'
                    ) as kota
                "),
                DB::raw("count(*) as total")
            )
            ->where('role', 'alumni')
            ->groupBy('kota')
            ->orderByDesc('total')
            ->get();

        $alumniPerUniv = DB::table('users')
            ->select(DB::raw("COALESCE(university_name, 'Belum Diisi') as university_name"), DB::raw('count(*) as total'))
            ->where('role', 'alumni')
            ->groupBy('university_name')
            ->orderByRaw("CASE WHEN university_name IS NULL THEN 0 ELSE 1 END, university_name ASC")
            ->get();



        // Distribusi Universitas (Pie Chart - filtered by alumni only)
        $jurusanData = User::where('role', 'alumni')
            ->select(DB::raw("COALESCE(major, 'Belum Diisi') as major"), DB::raw('count(*) as total'))
            ->groupBy('major')
            ->orderByDesc('total')
            ->get();


        $alumniWithIncompleteData = User::where('role', 'alumni')->get();

        $fieldsToCheck = [
            'name',
            'email',
            'nis',
            'birth_date',
            'insta',
            'university_name',
            'job_title',
            'work_place',
            'major',
            'graduation_year',
            'phone'
        ];

        $rowsWithEmpty = 0;

        foreach ($alumniWithIncompleteData as $user) {
            foreach ($fieldsToCheck as $field) {
                if (empty($user->$field)) {
                    $rowsWithEmpty++;
                    break; // lanjut ke baris berikutnya jika ada 1 kolom kosong
                }
            }
        }
        return view('admin.dashboard', compact(
            'totalAlumni',
            'topUniversitas',
            'alumniPerAngkatan',
            'alumniPerKota',
            'alumniPerUniv',
            'jurusanData',
            'rowsWithEmpty'
        ));

    }


    public function importForm()
    {
        return view('admin.import_alumni'); 
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        // Simpan file
        $path = $request->file('file')->store('imports');

        // Buat jobId unik
        $jobId = (string) Str::uuid();

        // Inisialisasi cache awal: status=pending, duplicates=[], imported=[]
        Cache::put("import-status:{$jobId}", [
            'status'     => 'pending',
            'duplicates' => [],
            'imported'   => [],
        ], now()->addMinutes(30));

        // Dispatch Job ke queue 'imports'
        ImportAlumni::dispatch($path, $jobId)
            ->onQueue('imports')
            ->delay(now());

        // Return JSON { job_id }
        return response()->json(['job_id' => $jobId]);
    }


}
