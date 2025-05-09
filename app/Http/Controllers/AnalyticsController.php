<?php

namespace App\Http\Controllers;

use App\Constants\Statuses\ProjectStatuses;
use App\Models\Project;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index(Request $request) {
       return view('analytics.index');
    }

    public function project_statistic(Request $request) {
        $projects = Project::query()
            ->when($request->created_at, function($query, $date) {
                [$year, $month] = explode('-', $date);
                return $query->whereYear('start_date', $year)
                    ->whereMonth('start_date', $month);
            })->get();

        $statusCount = [
            'Активны' => $projects->where('status',ProjectStatuses::ACTIVE)->count(),
            'Приостановлены' => $projects->where('status',ProjectStatuses::PAUSED)->count(),
            'Завершены' => $projects->where('status',ProjectStatuses::COMPLETED)->count(),
            'В архиве' => $projects->where('status',ProjectStatuses::ARCHIVED)->count(),
        ];

        return view('analytics.project_statistic', compact('projects','statusCount'));
    }

    public function employee_employment() {
        $projects = Project::all();

        $employmentCount = [];
        foreach($projects as $project) {
            $employmentCount[$project->title] = $project->users->count();
        }

        return view('analytics.employee_employment', compact('projects','employmentCount'));
    }
}
