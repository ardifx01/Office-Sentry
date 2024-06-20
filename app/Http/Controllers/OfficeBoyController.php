<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfficeBoy;
use App\Models\OfficeBoyTask;
use App\Models\OfficeBoyReport;
use App\Models\Tracking;
use App\Models\IzinKeluar;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\OfficeBoyMonitoring;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OfficeBoyImport;

class OfficeBoyController extends Controller
{
    function office_boy()
    {
        $user = Auth::user();
        $officeBoy = OfficeBoy::where('user_id', $user->id)->firstOrFail();
        return view('officeboy.dashboard', compact('officeBoy'));
    }

    public function create()
    {
        return view('officeboy.createOfficeBoy');
    }

    public function form()
    {
        $user = Auth::user();
        $officeBoy = OfficeBoy::where('user_id', $user->id)->firstOrFail();
        return view('officeboy.permission_form', compact('officeBoy'));
    }

    public function storeForm(Request $request)
    {
        $request->validate([
            'keperluan' => 'required',
        ]);

        $user = Auth::user();
        $officeBoy = OfficeBoy::where('user_id', $user->id)->firstOrFail();

        IzinKeluar::create([
            'tanggal' => now()->toDateString(),
            'nama' => $officeBoy->nama_lengkap, // Menyimpan nama lengkap Office Boy
            'jam_keluar' => now()->toTimeString(),
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('officeboy.form')->with('success', 'Izin keluar berhasil dibuat.');
    }

    public function markReturned(Request $request, $id)
    {
        $user = Auth::user();
        $officeBoy = OfficeBoy::where('user_id', $user->id)->firstOrFail();

        $izinKeluar = IzinKeluar::where('id', $id)
            ->where('nama', $officeBoy->nama_lengkap) // Mencari berdasarkan nama lengkap Office Boy
            ->where('status', 'Belum Kembali')
            ->firstOrFail();

        $izinKeluar->update([
            'jam_masuk' => now()->toTimeString(),
            'status' => 'Sudah Kembali',
        ]);

        return redirect()->route('officeboy.returnForm')->with('success', 'Status berhasil diperbarui.');
    }

    public function returnForm()
    {
        $user = Auth::user();
        $officeBoy = OfficeBoy::where('user_id', $user->id)->firstOrFail();

        $izinKeluar = IzinKeluar::where('nama', $officeBoy->nama_lengkap) // Mencari berdasarkan nama lengkap Office Boy
            ->where('status', 'Belum Kembali')
            ->latest()
            ->first();

        return view('officeboy.returnForm', compact('izinKeluar', 'officeBoy'));
    }


    public function showDetail($id)
    {
        $task = OfficeBoyMonitoring::find($id);
        if (!$task) {
            // handle not found
            return redirect()->back()->with('error', 'Task tidak ditemukan.');
        }
        return view('detail-task', compact('task'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:office_boys',
            'nama_lengkap' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric',
        ]);

        // Generate a random password
        $randomPassword = Str::random(8);

        // Store the plaintext password temporarily (for display purposes)
        $plaintextPassword = $randomPassword;

        // Store the hashed password in the password column of the office_boys table
        $hashedPassword = Hash::make($randomPassword);

        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => $hashedPassword, // Securely hash the password
            'role' => 'office_boy',
        ]);

        if ($user) {
            // Store phone number and hashed password in the corresponding columns
            $officeBoy = new OfficeBoy;
            $officeBoy->nik = $request->nik;
            $officeBoy->nama_lengkap = $request->nama_lengkap;
            $officeBoy->no_telepon = $request->phone;
            $officeBoy->password = $plaintextPassword; // Store plaintext password
            $officeBoy->user_id = $user->id;
            $officeBoy->save();

            return redirect('/createOfficeBoy')->with('success', 'Akun Office Boy berhasil dibuat. Password: ' . $plaintextPassword);
        } else {
            // Handle error if user fails to be created
        }
    }

    public function showImportForm()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new OfficeBoyImport, $request->file('file'));

        return redirect()->back()->with('success', 'Office boys imported successfully.');
    }

    public function editProfile()
    {
        $user = Auth::user();
        $officeBoy = OfficeBoy::where('user_id', $user->id)->firstOrFail();
        return view('officeboy.edit-profile', compact('officeBoy'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'tahun_masuk' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'status' => 'required',
            'no_telepon' => 'required',
            'password' => 'nullable|min:6',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the profile photo
        ]);

        $user = Auth::user();
        $officeBoy = OfficeBoy::where('user_id', $user->id)->firstOrFail();

        // Update profile data
        $officeBoy->tahun_masuk = $request->tahun_masuk;
        $officeBoy->tempat_lahir = $request->tempat_lahir;
        $officeBoy->tanggal_lahir = $request->tanggal_lahir;
        $officeBoy->status = $request->status;
        $officeBoy->no_telepon = $request->no_telepon;

        // Check if a new password is provided and update it
        if ($request->filled('password')) {
            $newPassword = $request->password;

            // Hash the new password
            $hashedPassword = Hash::make($newPassword);

            // Update password in the office_boys table
            $officeBoy->password = $hashedPassword;
            $officeBoy->save();

            // Update password in the users table
            $user->password = $hashedPassword;
            $user->save();
        } else {
            // If no new password provided, update only other fields
            $officeBoy->save();
        }

        // Handle profile photo upload
        if ($request->hasFile('foto_profil')) {
            // Delete old photo if exists
            if ($officeBoy->foto_profil) {
                Storage::delete('public/' . $officeBoy->foto_profil);
            }

            // Store the new photo
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $officeBoy->foto_profil = $path;
        }

        // Check if all required profile fields are filled, then update status_profile
        if ($officeBoy->tahun_masuk && $officeBoy->tempat_lahir && $officeBoy->tanggal_lahir && $officeBoy->no_telepon) {
            $officeBoy->status_profile = 'Sudah Melengkapi';
        } else {
            $officeBoy->status_profile = 'Belum Melengkapi';
        }

        // Save the changes
        $officeBoy->save();

        return redirect()->route('office_boy.edit_profile')->with('success', 'Profil berhasil diperbarui.');
    }




    public function showProfile()
    {
        $user = Auth::user();
        $officeBoy = OfficeBoy::where('user_id', $user->id)->firstOrFail();
        return view('officeboy.profile', compact('officeBoy'));
    }


    public function showTasks()
    {
        // Dapatkan informasi office boy yang sedang login
        // Asumsi bahwa user yang login memiliki relasi ke office boy (misalnya melalui kolom office_boy_id di tabel users)
        $officeBoy = Auth::user()->officeBoy; // Ganti 'officeBoy' dengan nama relasi yang sesuai jika berbeda
        $user = Auth::user();
        $officeBoy = OfficeBoy::where('user_id', $user->id)->firstOrFail();

        // Pastikan bahwa office boy ditemukan
        if (!$officeBoy) {
            return back()->with('error', 'Office boy tidak ditemukan.');
        }

        // Dapatkan tanggal hari ini
        $today = Carbon::today();

        // Dapatkan semua tugas yang berkaitan dengan office boy yang sedang login untuk hari ini saja
        $tasks = OfficeBoyMonitoring::where('office_boy_id', $officeBoy->id)
            ->whereDate('date', $today) // Hanya tugas yang bertanggal hari ini
            ->with(['building', 'floor', 'room', 'shift'])
            ->get();

        return view('officeboy.task', compact('tasks', 'officeBoy'));
    }

    public function showForm()
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('officeboy.detail-task', ['user' => $user]);
    }

    public function submitReport(Request $request)
    {
        $request->validate([
            'monitoring_id' => 'required|exists:office_boy_monitorings,id',
            'catatan_tugas' => 'nullable|string|max:1000', // Contoh validasi untuk catatan_tugas
            'catatan_ob' => 'nullable|string|max:1000', // Contoh validasi untuk catatan_ob
            'proof_photo' => 'required|image|mimes:jpg,png|max:2048',
        ]);

        // Temukan tugas berdasarkan monitoring_id
        $task = OfficeBoyMonitoring::findOrFail($request->monitoring_id);

        // Menyimpan bukti foto
        if ($request->hasFile('proof_photo')) {
            $filenameWithExt = $request->file('proof_photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('proof_photo')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('proof_photo')->storeAs('public/proofs', $fileNameToStore);

            // Simpan nama file foto ke kolom 'proof_photo'
            $task->proof_photo = $fileNameToStore;
        }

        // Simpan catatan_tugas dan catatan_ob jika tersedia
        if ($request->has('catatan_tugas')) {
            $task->catatan_tugas = $request->catatan_tugas;
        }
        if ($request->has('catatan_ob')) {
            $task->catatan_ob = $request->catatan_ob;
        }

        // Update status tugas menjadi "Selesai Dikerjakan"
        $task->status = 'Selesai Dikerjakan';
        $task->save();

        // Simpan informasi ke session bahwa laporan sudah dikumpulkan pada hari ini
        $request->session()->put('laporan_dikumpulkan', true);

        return back()->with('success', 'Laporan berhasil dikirim.');
    }


    public function checkProfileCompletion($officeBoyId)
    {
        $officeBoy = OfficeBoy::find($officeBoyId);

        if ($officeBoy->tahun_masuk && $officeBoy->tempat_lahir && $officeBoy->tanggal_lahir) {
            $officeBoy->status_profile = 'Sudah Melengkapi';
            $officeBoy->save();
        } else {
            $officeBoy->status_profile = 'Belum Melengkapi';
            $officeBoy->save();
        }

        return back()->with('success', 'Status profil telah diperbarui.');
    }


    public function showTrackings(Request $request)
    {
        $user = Auth::user();
        $officeBoy = OfficeBoy::where('user_id', $user->id)->firstOrFail();

        // Dapatkan ID office boy yang sedang login
        $officeBoyId = auth()->user()->officeBoy->id;

        if (!$officeBoyId) {
            return back()->with('error', 'Office boy tidak ditemukan.');
        }

        // Inisialisasi variabel pencarian tanggal
        $searchDate = $request->input('date');

        // Dapatkan semua data tracking yang berkaitan dengan office boy ini
        // dan dimana sumber_informasi dan catatan tidak null
        $query = OfficeBoyMonitoring::where('office_boy_id', $officeBoyId)
            ->whereNotNull('sumber_informasi')
            ->whereNotNull('catatan');

        // Jika terdapat pencarian tanggal, tambahkan kondisi pencarian
        if ($searchDate) {
            $query->whereDate('date', $searchDate);
        }

        // Ambil data trackings berdasarkan query
        $trackings = $query->get();

        // Kirim data tracking ke view bersama dengan data pencarian
        return view('officeboy.trackings', compact('trackings', 'searchDate', 'officeBoy'));
    }


}