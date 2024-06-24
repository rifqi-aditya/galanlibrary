<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::with('user')->orderBy('created_at', 'DESC')->get();

        return view('attendance.index', [
            'attendances' => $attendances
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function qr()
    {
        $user = User::find(auth()->user()->id);

        $random = Str::random(32);

        $token = base64_encode($random);

        $user->forceFill([
            'attendance_token' => $token,
        ])->save();


        $renderer = new ImageRenderer(
            new RendererStyle(190, 0),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qr = $writer->writeString($token);

        return response()->json([
            'qr' => $qr,
        ], 200, [
            'Content-Type' => 'application/json',
            'Charset' => 'utf-8'
        ]);
    }

    public function fill(Request $request)
    {
        $result = $request->input('result');

        $user = User::where('attendance_token', $result)->get()->first();

        if (!$user) {
            $response = [
                'success' => false,
                'message' => 'QR code tidak valid.'
            ];
        } else {
            if ($attendance = Attendance::where('user_id', $user->id)->whereDate('created_at', Carbon::today())->get()->first()) {
                $user->forceFill(['attendance_token' => null])->save();
                $response = [
                    'success' => false,
                    'message' => 'Anda sudah konfirmasi kehadiran untuk hari ini pada: ' . $attendance->created_at
                ];
            } else {
                $user->forceFill(['attendance_token' => null])->save();
                Attendance::create([
                    'user_id' => $user->id
                ]);
                $response = [
                    'success' => true,
                    'message' => 'Anda berhasil konfirmasi kehadiran.'
                ];
            }
        }

        return response()->json($response, 200, [
            'Content-Type' => 'application/json',
            'Charset' => 'utf-8'
        ]);
    }
}
