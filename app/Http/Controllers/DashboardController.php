<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Payroll;
use App\Models\Presence;
use App\Models\Task;



class DashboardController extends Controller
{
    public function index()
    {
        $employee = Employee::count();
        $department = Department::count();
        $payroll = Payroll::count();
        $presence = Presence::count();
        $tasks = Task::all();

        return view('dashboard.index', compact('employee', 'department', 'payroll', 'presence', 'tasks'));
    }

    public function presence()
    {
        // Get present counts for the last 12 months (including current month)
        $data = Presence::where('status', 'present')
            ->selectRaw('MONTH(date) as month, YEAR(date) as year, COUNT(*) as total_present')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        // Ensure we have data for each of the last 12 months
        $results = [];
        $now = \Carbon\Carbon::now();
        for ($i = 0; $i < 12; $i++) {
            $date = $now->copy()->subMonths($i);
            $year = $date->year;
            $month = $date->month;
            $found = $data->firstWhere(function ($item) use ($year, $month) {
                return $item->year == $year && $item->month == $month;
            });
            $results[] = (object) [
                'year' => $year,
                'month' => $month,
                'total_present' => $found ? $found->total_present : 0,
            ];
        }
        // Return in chronological order (oldest to newest)
        return response()->json(array_reverse($results));
    }
}
