<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendancesController extends Controller
{
    public function index()
    {
        return view('attendances.index');
    }


    public function test()
    {
        $user = User::select('id', 'name', 'barcode')->get();

        // dd($user);
        return view('attendances.test', [
            'users' => $user
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'barcode' => 'required|string'
        ]);

        // Cari user berdasarkan barcode
        $user = \App\Models\User::where('barcode', $request->barcode)->first();

        // dd($user);

        $now = Carbon::now(); // waktu saat ini
        $start = Carbon::createFromTime(8, 0, 0);
        $end = Carbon::createFromTime(12, 0, 0);

        // Jika sebelum jam 08:00
        if ($now->lt($start)) {
            return redirect()->back()->with('info', 'Waktu absen belum dimulai.');
            // return response()->json(['message' => 'Waktu absen belum dimulai.'], 403);
        }

        // Jika setelah jam 08:30
        if ($now->gt($end)) {
            $diff = $now->diff($start);
            $terlambat = sprintf(
                'absen terlambat (%02d jam %02d menit %02d detik)',
                $diff->h,
                $diff->i,
                $diff->s
            );
            $status = $terlambat;
        } else {
            $status = 'absen tepat waktu';
        }

        // Cek apakah user sudah absen hari ini
        $sudahAbsen = \App\Models\AttendancesModel::where('user_id', $user->id)
            ->whereDate('created_at', $now->toDateString())
            ->exists();

        if ($sudahAbsen) {
            return redirect()->back()->with('danger', 'Anda sudah absen hari ini.');
        }

        // Simpan absen
        \App\Models\AttendancesModel::create([
            'user_id' => $user->id,
            'status' => $status,
        ]);

        return redirect()->to(route('absensi.user', ['user' => $user->id]))->with('success', 'Absensi berhasil.' . $status);
        // return response()->json(['message' => 'Absensi berhasil.', 'status' => $status]);

        if (!$user) {
            return redirect()->back()->with('danger', 'Barcode tidak valid.');
            // return response()->json(['message' => 'Barcode tidak valid.'], 404);
        }


        // dd($request->all());
    }


    public function user($user)
    {

        $user = \App\Models\User::where('id', $user)->first();
        // dd($user);

        if (!$user) {
            return redirect()->route('absensi.index')->with('danger', 'User tidak ditemukan.');
        }
        // Mengambil 2 data absensi terbaru
        $attendances = $user->attendances()
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // dd($attendances);
        return view('attendances.show', [
            'user' => $user,
            'attendances' => $attendances
        ]);
    }
}
