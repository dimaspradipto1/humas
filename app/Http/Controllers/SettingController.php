<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        // Pastikan hanya admin yang bisa mengakses
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $settings = [
            'admin_whatsapp' => Setting::getValue('admin_whatsapp', '6282283736481'),
            'wa_message_template' => Setting::getValue('wa_message_template', ''),
        ];

        return view('pages.settings.index', compact('settings'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        // Pastikan hanya admin yang bisa mengakses
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'admin_whatsapp' => 'required|string',
            'wa_message_template' => 'required|string',
        ]);

        Setting::setValue('admin_whatsapp', $request->admin_whatsapp);
        Setting::setValue('wa_message_template', $request->wa_message_template);

        Alert::success('Success', 'Pengaturan WhatsApp berhasil diperbarui.')->toToast()->autoclose(3000)->timerProgressBar();
        return redirect()->route('settings.index');
    }
}
