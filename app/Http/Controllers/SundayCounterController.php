<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller; 

class SundayCounterController extends Controller
{
    public function count(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date|before:end_date|date_format:Y-m-d',
            'end_date' => 'required|date|after:start_date|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);

        // Validation for date range and start date not being Sunday
        if ($startDate->diffInYears($endDate) < 2 || $startDate->diffInYears($endDate) > 5) {
            return response()->json(['error' => 'Dates must be at least 2 years apart but no more than 5.'], 422);
        }
        if ($startDate->dayOfWeek == Carbon::SUNDAY) {
            return response()->json(['error' => 'Start date cannot be a Sunday.'], 422);
        }

        $sundaysCount = $this->countSundays($startDate, $endDate);

        return response()->json(['number_of_sundays' => $sundaysCount]);
    }

    private function countSundays($startDate, $endDate)
    {
        $count = 0;
        while ($startDate->lte($endDate)) {
            if ($startDate->dayOfWeek == Carbon::SUNDAY && $startDate->day < 28) {
                $count++;
            }
            $startDate->addDay();
        }

        return $count;
    }
}
