<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index() {
        $data['inDiscCount'] = Trip::where('status', 1)->get()->count();
        $data['acceptedCount'] = Trip::where('status', 2)->get()->count();
        $data['rejectedCount'] = Trip::where('status', 3)->get()->count();

        $data['inProgress'] = Trip::where('trip_status', 1)->get()->count();
        $data['completed'] = Trip::where('trip_status', 2)->get()->count();
        $data['cancelled'] = Trip::where('trip_status', 3)->get()->count();

        return view('welcome', $data);
    }

    public function getDateRangeResult(Request $request) {
        $from = $request->input('from');
        $to = $request->input('to');
        $data['inDiscCount'] = Trip::whereBetween('trip_date', [$from, $to])->where('status', 1)->get()->count();
        $data['acceptedCount'] = Trip::whereBetween('trip_date', [$from, $to])->where('status', 2)->get()->count();
        $data['rejectedCount'] = Trip::whereBetween('trip_date', [$from, $to])->where('status', 3)->get()->count();

        // $data['inProgress'] = Trip::whereBetween('trip_date', [$from, $to])->where('trip_status', 1)->get()->count();
        // $data['completed'] = Trip::whereBetween('trip_date', [$from, $to])->where('trip_status', 2)->get()->count();
        // $data['cancelled'] = Trip::whereBetween('trip_date', [$from, $to])->where('trip_status', 3)->get()->count();

        return $data;
    }

    public function getDateRangeAnotherResult(Request $request) {
        $from = $request->input('from');
        $to = $request->input('to');
        // $data['inDiscCount'] = Trip::whereBetween('trip_date', [$from, $to])->where('status', 1)->get()->count();
        // $data['acceptedCount'] = Trip::whereBetween('trip_date', [$from, $to])->where('status', 2)->get()->count();
        // $data['rejectedCount'] = Trip::whereBetween('trip_date', [$from, $to])->where('status', 3)->get()->count();

        $data['inProgress'] = Trip::whereBetween('trip_date', [$from, $to])->where('trip_status', 1)->get()->count();
        $data['completed'] = Trip::whereBetween('trip_date', [$from, $to])->where('trip_status', 2)->get()->count();
        $data['cancelled'] = Trip::whereBetween('trip_date', [$from, $to])->where('trip_status', 3)->get()->count();

        return $data;
    }

    public function iarCount() {
        $data['inDiscCount'] = Trip::where('status', 1)->get()->count();
        $data['acceptedCount'] = Trip::where('status', 2)->get()->count();
        $data['rejectedCount'] = Trip::where('status', 3)->get()->count();
        return $data;
    }

    public function anotherCount() {
        $data['inProgress'] = Trip::where('trip_status', 1)->get()->count();
        $data['completed'] = Trip::where('trip_status', 2)->get()->count();
        $data['cancelled'] = Trip::where('trip_status', 3)->get()->count();
        return $data;
    }

    public function columnChart() {
        return Trip::select('trip_name', 'booking_cost', 'commission_cost')->get();
    }

    public function tripFilter(Request $request) {
        $filter = $request->input('filter');
        $date = '';

        if($filter == "weekly") {
            $date = Carbon::today()->subDays(7);
        }

        if($filter == "monthly") {
            $date = Carbon::today()->subDays(30);
        }

        if($filter == "yearly") {
            $date = Carbon::today()->subDays(365);
        }

        return Trip::select('trip_name', 'booking_cost', 'commission_cost', 'trip_date')->where('trip_date','>=',$date)->get();
    }

    public function salesPerformance() {
        return Trip::select('trip_date', 'booking_date', 'booking_cost')->orderBy('booking_date', 'asc')->get();
    }

}
