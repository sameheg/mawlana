<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuditLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FALaravel\Facades\Google2FA;

class TwoFactorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function enable(Request $request)
    {
        $user = $request->user();
        $secret = Google2FA::generateSecretKey();
        $user->two_factor_secret = $secret;
        $user->save();

        $qr = Google2FA::getQRCodeInline(
            config('app.name'),
            $user->email,
            $secret
        );

        AuditLogService::log('2fa_enabled');

        return response()->json(['qr' => $qr]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'digits:6'],
        ]);

        $user = $request->user();
        $valid = Google2FA::verifyKey($user->two_factor_secret, $request->code);

        if ($valid) {
            $user->two_factor_enabled = true;
            $user->save();

            AuditLogService::log('2fa_verified');
            return response()->json(['status' => '2FA enabled']);
        }

        return response()->json(['message' => 'Invalid code'], 422);
    }
}
