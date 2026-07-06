<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send WhatsApp message via Fonnte API.
     *
     * @param string $target
     * @param string $message
     * @return bool
     */
    public static function send(string $target, string $message)
    {
        $token = Setting::getValue('fonnte_api_token');
        
        if (empty($token)) {
            Log::warning('WhatsAppService: Gagal mengirim pesan, API Token Fonnte kosong.');
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
            ]);

            $result = $response->json();

            if ($response->successful() && isset($result['status']) && $result['status'] == true) {
                Log::info('WhatsAppService: Pesan WA berhasil dikirim ke ' . $target);
                return true;
            } else {
                Log::error('WhatsAppService: Gagal mengirim pesan ke ' . $target . '. Response: ' . json_encode($result));
                return false;
            }
        } catch (\Exception $e) {
            Log::error('WhatsAppService Error: ' . $e->getMessage());
            return false;
        }
    }
}
