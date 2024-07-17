<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function borrowings(Request $request)
    {
        $filters = $request->all();

        $borrowings = Borrowing::with(['book', 'user']);

        $filterInformation = null;

        if (
            $filters == [] ||
            isset($filters['start_date']) == false ||
            isset($filters['end_date']) == false ||
            $filters['start_date'] == null ||
            $filters['end_date'] == null
        ) {
            $borrowings = $borrowings->orderBy('created_at', 'DESC')->get();
        } else {
            Validator::make($filters, [
                'start_date' => ['date'],
                'end_date' => ['date', 'after_or_equal:start_date'],
            ])->validate();

            $borrowings = $borrowings->where('created_at', '>=', $filters['start_date'])->where('created_at', '<=', $filters['end_date'])->orderBy('created_at', 'DESC')->get();
            $filterInformation = Carbon::createFromDate($filters['start_date'])->format('d/m/Y') . ' s.d ' . Carbon::createFromDate($filters['end_date'])->format('d/m/Y');
        }

        $pdf = Pdf::loadView('report.borrowings', [
            'borrowings' => $borrowings,
            'filterInformation' => $filterInformation,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream(time() . '-laporan-peminjaman-buku.pdf');
    }
}
