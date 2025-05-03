<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoyaltyPoint;

class LoyaltyController extends Controller
{
    public function getPoints(Request $request)
    {
        $email = $request->query('email');

        $record = LoyaltyPoint::where('email', $email)->first();

        if (!$record) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json([
            'email' => $record->email,
            'points' => $record->points
        ]);
    }

    public function storePoints(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'points' => 'required|integer|min:1'
        ]);
    
        $record = LoyaltyPoint::firstOrNew(['email' => $validated['email']]);
        $record->points = ($record->points ?? 0) + $validated['points'];
        $record->save();
    
        return response()->json([
            'message' => 'Points accumulated correctly.',
            'data' => $record
        ]);
    }
}
