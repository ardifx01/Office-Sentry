<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\IzinKeluar;
use Illuminate\Support\Facades\DB;
use App\Models\OfficeBoy;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\OfficeBoyMonitoring;
use Carbon\Carbon;


class PengawasController extends Controller
{
    function pengawas(Request $request)
    {
        $totalOfficeBoys = OfficeBoy::count();
        // Data status Tugas
        $statusDetails = [
            'Aktif' => OfficeBoy::where('status', 'Aktif')->get(['nama_lengkap', 'nik']),
            'Mangkir' => OfficeBoy::where('status', 'Mangkir')->get(['nama_lengkap', 'nik']),
            'Cuti' => OfficeBoy::where('status', 'Cuti')->get(['nama_lengkap', 'nik']),
            'Sakit' => OfficeBoy::where('status', 'Sakit')->get(['nama_lengkap', 'nik']),
        ];

        $startDate = $request->input('start_date', Carbon::today()->subDays(7)->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->toDateString());

        $tasks = OfficeBoyMonitoring::select(DB::raw("DATE_FORMAT(date, '%Y-%m-%d') as date, status, COUNT(*) as count"))
            ->whereBetween('date', [$startDate, $endDate])
            ->groupBy('date', 'status')
            ->get();

        $allStatuses = ['Belum Dikerjakan', 'Selesai Dikerjakan'];
        $chartData = array_fill_keys($allStatuses, []);
        $totals = array_fill_keys($allStatuses, 0);

        foreach ($tasks as $task) {
            $chartData[$task->status][$task->date] = $task->count;
            $totals[$task->status] += $task->count;
        }

        // Data status perizinan
        $filterStartDate = $request->input('filter_start_date', Carbon::today()->subDays(7)->toDateString());
        $filterEndDate = $request->input('filter_end_date', Carbon::today()->toDateString());

        $belumKembali = IzinKeluar::whereBetween('tanggal', [$filterStartDate, $filterEndDate])
            ->where('status', 'Belum Kembali')
            ->count();

        $sudahKembali = IzinKeluar::whereBetween('tanggal', [$filterStartDate, $filterEndDate])
            ->where('status', 'Sudah Kembali')
            ->count();

        $totalIzin = $belumKembali + $sudahKembali;

        // Hitung persentase berdasarkan total izin
        $belumKembaliPercent = $totalIzin > 0 ? number_format(($belumKembali / $totalIzin) * 100, 2) : 0;
        $sudahKembaliPercent = $totalIzin > 0 ? number_format(($sudahKembali / $totalIzin) * 100, 2) : 0;

        return view('pengawas.dashboard', compact('totalOfficeBoys', 'statusDetails', 'chartData', 'belumKembali', 'sudahKembali', 'totalIzin', 'filterStartDate', 'filterEndDate', 'belumKembaliPercent', 'sudahKembaliPercent'));
    }

    public function indexForm(Request $request)
    {
        $query = IzinKeluar::query();

        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        $izinKeluars = $query->paginate(10)->appends($request->except('page')); // Ensure pagination keeps query string
        return view('pengawas.officeboy_permission', compact('izinKeluars', 'request'));
    }


    function showRollingTask()
    {
        return view('pengawas.rollingTask');
    }

    public function show($id)
    {
        $officeBoy = OfficeBoy::findOrFail($id);
        return view('pengawas.show', compact('officeBoy')); // Buat view ini untuk menampilkan detail
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $officeBoys = OfficeBoy::when($search, function ($query, $search) {
            return $query->where('nama_lengkap', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('pengawas.index', compact('officeBoys'));
    }

    public function edit($id)
    {
        $officeBoy = OfficeBoy::findOrFail($id);
        return view('pengawas.edit-profile', compact('officeBoy'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Validasi inputan
        ]);

        logger()->info($request->all());

        $officeBoy = OfficeBoy::findOrFail($id);
        $updateData = [
            'tahun_masuk' => $request->tahun_masuk,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status' => $request->status,
            'no_telepon' => $request->no_telepon,
        ];

        if ($request->filled('password')) {
            $hashedPassword = bcrypt($request->password);
            $updateData['password'] = $hashedPassword;

            // Update password in users table
            DB::table('users')
                ->where('name', $officeBoy->nama_lengkap)
                ->update(['password' => $hashedPassword]);
        }

        $officeBoy->update($updateData);

        logger()->info($officeBoy->getAttributes());

        return redirect()->route('pengawas.index')->with('success', 'Profil Office Boy berhasil diperbarui.');
    }

    public function monitoring()
    {
        $monitorings = OfficeBoyMonitoring::with(['officeBoy', 'building', 'floor', 'room', 'shift'])->paginate(10);
        return view('pengawas.monitoring', compact('monitorings'));
    }

    public function destroy($id)
    {
        $officeBoy = OfficeBoy::findOrFail($id);
        $officeBoy->delete();
        $user = User::findOrFail($officeBoy->user_id); // Dapatkan user yang terkait dengan office boy
        $user->delete(); // Menghapus user juga akan menghapus office boy karena kaskade

        return redirect()->route('pengawas.index')->with('success', 'Office Boy berhasil dihapus.');
    }


    public function showTrackingForm()
    {
        $today = Carbon::today();

        // Mendapatkan rooms unik dari office_boy_monitorings yang memiliki tanggal hari ini
        $rooms = OfficeBoyMonitoring::with(['room', 'room.floor', 'room.floor.building'])
            ->whereDate('date', $today)
            ->get()
            ->unique('room_id')
            ->pluck('room');

        // Mendapatkan semua office boys dari office_boy_monitorings pada hari ini
        $officeBoys = OfficeBoyMonitoring::with('officeBoy')
            ->whereDate('date', $today)
            ->get()
            ->unique('office_boy_id')
            ->pluck('officeBoy');

        return view('pengawas.tracking', compact('rooms', 'officeBoys'));
    }

    public function Trackings(Request $request)
    {


        // Validasi input
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'office_boy_id' => 'nullable|exists:office_boys,id', // Nullable karena bisa saja tidak memilih office boy tertentu
            'sumber_informasi' => 'required|string',
            'catatan' => 'required|string',
            // 'lokasi' => 'nullable|string', // Uncomment jika Anda ingin menggunakan kolom lokasi
        ]);

        $today = Carbon::today();

        if ($request->input('office_boy_id') === null || $request->input('office_boy_id') === '') {
            // Jika "Semua Office Boy" dipilih, ambil semua office boy di ruangan tersebut
            $monitorings = OfficeBoyMonitoring::where('room_id', $request->room_id)
                ->whereDate('date', $today)
                ->get();
        } else {
            // Jika office boy tertentu dipilih, ambil hanya office boy tersebut
            $monitorings = OfficeBoyMonitoring::where('room_id', $request->room_id)
                ->where('office_boy_id', $request->office_boy_id)
                ->whereDate('date', $today)
                ->get();
        }

        if ($monitorings->isEmpty()) {
            return back()->with('error', 'Tidak ada office boy ditemukan di room ini untuk hari ini.');
        }

        foreach ($monitorings as $monitoring) {
            // Perbarui tracking untuk setiap office boy
            $monitoring->update([
                'sumber_informasi' => $request->sumber_informasi,
                'catatan' => $request->catatan,
                // 'lokasi' => $request->lokasi, // Uncomment jika Anda ingin menggunakan kolom lokasi
            ]);
        }

        return back()->with('success', 'Tracking Informasi Pelaporan telah berhasil diperbarui untuk ruangan dan office boy yang dipilih.');
    }

    public function getOfficeBoysByRoom(Request $request)
    {
        $room_id = $request->room_id;
        $officeBoys = OfficeBoyMonitoring::where('room_id', $room_id)
            ->whereDate('date', Carbon::today())
            ->with('officeBoy') // asumsikan relasi ke tabel office boys dengan nama 'officeBoy'
            ->get()
            ->unique('office_boy_id') // menghindari duplikat
            ->pluck('officeBoy');

        return response()->json([
            'officeBoys' => $officeBoys
        ]);
    }

    public function showMonitorings(Request $request)
    {
        // Ambil kata kunci pencarian dari request
        $search = $request->input('search');

        // Query ke database dengan kondisi pencarian jika ada
        $monitorings = OfficeBoyMonitoring::with(['officeBoy', 'building', 'floor', 'room', 'shift'])
            ->when($search, function ($query, $search) {
                return $query->whereHas('officeBoy', function ($query) use ($search) {
                    $query->where('nama_lengkap', 'like', "%{$search}%");
                })
                    ->orWhereHas('building', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('floor', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('room', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            ->paginate(10); // Ganti dengan angka yang diinginkan untuk pagination

        // Append the date parameter to the pagination links
        $monitorings->appends(['search' => $request->search]);

        return view('pengawas.monitoring', compact('monitorings'));
    }

    public function showTrackingResults(Request $request)
    {
        // Ambil inputan pencarian dari request
        $search = $request->input('search');

        // Query awal untuk mendapatkan data tracking dimana sumber_informasi dan catatan tidak null
        $query = OfficeBoyMonitoring::whereNotNull('sumber_informasi')
            ->whereNotNull('catatan');

        // Jika ada inputan pencarian, tambahkan filter pencarian ke dalam query
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('officeBoy', function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('building', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('floor', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('room', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            })
                ->paginate(10);
        }

        // Eksekusi query dan ambil data tracking
        $trackings = $query->paginate(10);

        // Append the date parameter to the pagination links
        $trackings->appends(['search' => $request->search]);

        // Kirim data tracking ke view bersama inputan pencarian untuk ditampilkan kembali
        return view('pengawas.tracking_result', compact('trackings', 'search'));
    }


}