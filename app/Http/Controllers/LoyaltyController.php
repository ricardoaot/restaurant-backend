<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoyaltyPoint;
use App\Models\LoyaltyTransaction;

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

        LoyaltyTransaction::create([
            'email' => $validated['email'],
            'points' => $validated['points'],
            'type' => 'earn',
        ]);

        return response()->json([
            'message' => 'Points accumulated correctly.',
            'data' => $record
        ]);
    }
    public function getTransactions(string $email)
    {
        $transactions = LoyaltyTransaction::where('email', $email)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($transactions);
    }
}
