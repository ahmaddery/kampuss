<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of activity logs.
     */
    public function index(Request $request)
    {
        $query = ActivityLog::with(['user'])
            ->orderBy('created_at', 'desc');

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by log name/category
        if ($request->filled('log_name')) {
            $query->where('log_name', $request->log_name);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('causer_id', $request->user_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search in description
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        // Get per page value
        $perPage = $request->input('per_page', 20);
        $validPerPage = in_array($perPage, [10, 20, 50, 100]) ? $perPage : 20;

        $logs = $query->paginate($validPerPage)->withQueryString();

        // Get data for filters
        $logNames = ActivityLog::distinct()->pluck('log_name')->filter()->sort();
        $users = User::orderBy('name')->get();

        // Get statistics
        $stats = $this->getActivityStats();

        return view('admin.activity-logs.index', compact('logs', 'logNames', 'users', 'stats'));
    }

    /**
     * Show detailed view of an activity log.
     */
    public function show(ActivityLog $activityLog)
    {
        $activityLog->load(['user', 'subject', 'causer']);
        
        return view('admin.activity-logs.show', compact('activityLog'));
    }

    /**
     * Get activity statistics.
     */
    protected function getActivityStats()
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();

        return [
            'today' => ActivityLog::whereDate('created_at', $today)->count(),
            'this_week' => ActivityLog::where('created_at', '>=', $thisWeek)->count(),
            'this_month' => ActivityLog::where('created_at', '>=', $thisMonth)->count(),
            'total' => ActivityLog::count(),
            'by_status' => ActivityLog::selectRaw('status, count(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status'),
            'by_category' => ActivityLog::selectRaw('log_name, count(*) as count')
                ->groupBy('log_name')
                ->orderBy('count', 'desc')
                ->limit(10)
                ->pluck('count', 'log_name'),
            'recent_users' => ActivityLog::with('user')
                ->whereNotNull('causer_id')
                ->where('created_at', '>=', $today)
                ->selectRaw('causer_id, count(*) as activity_count')
                ->groupBy('causer_id')
                ->orderBy('activity_count', 'desc')
                ->limit(5)
                ->get(),
        ];
    }

    /**
     * Export activity logs.
     */
    public function export(Request $request)
    {
        $query = ActivityLog::with(['user'])
            ->orderBy('created_at', 'desc');

        // Apply same filters as index
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('log_name')) {
            $query->where('log_name', $request->log_name);
        }

        if ($request->filled('user_id')) {
            $query->where('causer_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        $logs = $query->limit(1000)->get(); // Limit to prevent memory issues

        $filename = 'activity-logs-' . now()->format('Y-m-d-H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for proper UTF-8 encoding in Excel
            fwrite($file, "\xEF\xBB\xBF");
            
            // Header row
            fputcsv($file, [
                'Tanggal',
                'Waktu',
                'Pengguna',
                'Kategori',
                'Deskripsi',
                'Status',
                'IP Address',
                'URL',
                'Method'
            ]);

            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->created_at->format('d/m/Y'),
                    $log->created_at->format('H:i:s'),
                    $log->user ? $log->user->name : 'System',
                    ucfirst($log->log_name),
                    $log->description,
                    ucfirst($log->status),
                    $log->ip_address,
                    $log->url,
                    $log->method
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Clear old activity logs.
     */
    public function clear(Request $request)
    {
        $request->validate([
            'days' => 'required|integer|min:1|max:365'
        ]);

        $cutoffDate = Carbon::now()->subDays($request->days);
        $deletedCount = ActivityLog::where('created_at', '<', $cutoffDate)->delete();

        // Log this action
        $description = "Menghapus {$deletedCount} log aktivitas yang lebih lama dari {$request->days} hari";
        \App\Services\ActivityLogger::logSystem($description, [
            'deleted_count' => $deletedCount,
            'cutoff_date' => $cutoffDate->toDateString(),
            'days' => $request->days
        ]);

        return redirect()->back()->with('success', 
            "Berhasil menghapus {$deletedCount} log aktivitas yang lebih lama dari {$request->days} hari.");
    }

    /**
     * Get activity chart data for dashboard.
     */
    public function chartData(Request $request)
    {
        $days = $request->input('days', 7);
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subDays($days - 1);

        $data = [];
        $categories = [];

        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dayData = ActivityLog::whereDate('created_at', $date->toDateString())
                ->selectRaw('log_name, count(*) as count')
                ->groupBy('log_name')
                ->pluck('count', 'log_name');

            $data[] = [
                'date' => $date->format('d/m'),
                'total' => $dayData->sum(),
                'auth' => $dayData->get('auth', 0),
                'berita' => $dayData->get('berita', 0),
                'pengumuman' => $dayData->get('pengumuman', 0),
                'user' => $dayData->get('user', 0),
                'admin' => $dayData->get('admin', 0),
                'other' => $dayData->except(['auth', 'berita', 'pengumuman', 'user', 'admin'])->sum(),
            ];
        }

        return response()->json($data);
    }
}
