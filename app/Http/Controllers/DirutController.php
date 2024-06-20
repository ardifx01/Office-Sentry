<?php

namespace App\Http\Controllers;

use App\Models\OfficeBoy;
use App\Models\User;
use App\Models\IzinKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\OfficeBoyMonitoring;
use Carbon\Carbon;

class DirutController extends Controller
{
    function kabag_urdal(Request $request)
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
        return view('dirut.dashboard', compact('totalOfficeBoys', 'statusDetails', 'chartData', 'belumKembali', 'sudahKembali', 'totalIzin', 'filterStartDate', 'filterEndDate', 'belumKembaliPercent', 'sudahKembaliPercent'));
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $officeBoys = OfficeBoy::when($search, function ($query, $search) {
            return $query->where('nama_lengkap', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('dirut.index', compact('officeBoys'));
    }

    public function show($id)
    {
        $officeBoy = OfficeBoy::findOrFail($id);
        return view('dirut.show', compact('officeBoy')); // Buat view ini untuk menampilkan detail
    }

    public function destroy($id)
    {
        $officeBoy = OfficeBoy::findOrFail($id);
        $officeBoy->delete();
        $user = User::findOrFail($officeBoy->user_id); // Dapatkan user yang terkait dengan office boy
        $user->delete(); // Menghapus user juga akan menghapus office boy karena kaskade

        return redirect()->route('dirut.index')->with('success', 'Office Boy berhasil dihapus.');
    }


    public function filterTasksByDate(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = new Carbon($request->date);

        // Dapatkan semua monitoring sesuai tanggal yang dipilih dengan pagination
        $monitorings = OfficeBoyMonitoring::where('date', $date)
            ->with(['officeBoy', 'building', 'floor', 'room', 'shift'])
            ->paginate(10); // Adjust the number according to your needs

        // Append the date parameter to the pagination links
        $monitorings->appends(['date' => $request->date]);

        return view('dirut.monitoring', compact('monitorings'));
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
            });
        }

        // Eksekusi query dan ambil data tracking
        $trackings = $query->paginate(10);

        // Append the date parameter to the pagination links
        $trackings->appends(['search' => $request->search]);

        // Kirim data tracking ke view bersama inputan pencarian untuk ditampilkan kembali
        return view('dirut.tracking_results', compact('trackings', 'search'));
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
        return view('dirut.officeboy_permission', compact('izinKeluars', 'request'));
    }

}