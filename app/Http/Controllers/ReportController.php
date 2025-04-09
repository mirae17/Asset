<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset;
use App\Models\Family;
use App\Helpers\FaraidCalculator;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function generateReport()
    {
        $user = Auth::user();
        $userId = $user->id;
        
        // Fetch assets that belong to the logged-in user
        $assets = Asset::with(['familyMember', 'familyMember.assignedBy'])
                       ->where('user_id', $userId)
                       ->get();
        
        $date = now()->toDateString();
    
        // Calculate Faraid shares
        $faraidCalculator = new FaraidCalculator();
        $familyMembers = Family::where('assigned_by_user_id', $userId)->get();
    
        return view('report.assetReport', compact('assets', 'date', 'user'));
    }

    public function downloadPDF()
    {
        $user = Auth::user();
        $userId = $user->id;
        $assets = Asset::with(['familyMember', 'familyMember.assignedBy'])
                       ->where('user_id', $userId)
                       ->get();
        $date = now()->toDateString();

        // Calculate Faraid shares
        $faraidCalculator = new FaraidCalculator();
        $familyMembers = Family::where('assigned_by_user_id', $userId)->get();
        $distribution = $faraidCalculator->calculate($assets, $familyMembers);

        $pdf = Pdf::loadView('report.downloadPDF', compact('assets', 'date', 'user'));

        return $pdf->download('asset_report.pdf');
    }
}
