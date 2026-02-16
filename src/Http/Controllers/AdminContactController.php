<?php

namespace Vendor\ContactForm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vendor\ContactForm\Models\ContactSubmission;

class AdminContactController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()?->is_admin) {
            abort(403);
        }

        $query = ContactSubmission::query();

        if ($search = $request->input('user_search')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        if ($dateFrom = $request->input('date_from')) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if ($dateTo = $request->input('date_to')) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        return view('contact-form::admin.index', [
            'submissions' => $query->latest()->paginate(10)
        ]);
    }

    public function destroy($id)
    {
        ContactSubmission::findOrFail($id)->delete();
        return back()->with('success', 'Deleted successfully.');
    }
}
