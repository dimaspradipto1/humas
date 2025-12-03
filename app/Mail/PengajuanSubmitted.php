<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengajuanSubmitted extends Mailable
{
    use Queueable, SerializesModels;
    public $pengajuan;

    /**
     * Create a new message instance.
     */
    public function __construct($pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    public function build()
    {
        return $this->from(auth()->user()->email)  // Menggunakan email pengguna yang sedang login
                    ->subject('Pengajuan: ' . $this->pengajuan->nama_kegiatan)
                    ->view('emails.pengajuan.submitted')
                    ->with([
                        'nama_kegiatan' => $this->pengajuan->nama_kegiatan,
                        'tgl_awal' => $this->pengajuan->tgl_awal,
                        'tgl_selesai' => $this->pengajuan->tgl_selesai,
                        'deskripsi_kegiatan' => $this->pengajuan->deskripsi_kegiatan,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengajuan: ' . $this->pengajuan->nama_kegiatan,
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
