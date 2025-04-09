<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Family;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserApprovalController extends Controller
{
    public function index()
    {
        $users = User::where('userType', 'user')->get();
        return view('userApproval.index', compact('users'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();
        return redirect()->back()->with('success', 'User request approved successfully.');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();
        return redirect()->back()->with('success', 'User request rejected.');
    }

    public function deactivate(Request $request, $id)
    {
        $request->validate(['comment' => 'required|string']);

        try {
            DB::beginTransaction();
            $user = User::findOrFail($id);
            $user->status = 'deactivated';
            $user->deactivation_comment = $request->comment;
            $user->save();
            DB::commit();
            return redirect()->back()->with('success', 'User and associated family accounts deactivated successfully.');
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'User not found.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error occurred while deactivating user: ' . $e->getMessage());
        }
    }
}
