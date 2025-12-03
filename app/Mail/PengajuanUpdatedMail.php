<?php

namespace App\Mail;

use App\Models\Pengajuan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengajuanUpdatedMail extends Mailable
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
        return $this->view('emails.pengajuan_updated') // Mengarah ke view email
                    ->subject('Pengajuan Anda Telah Diperbarui') // Subjek email
                    ->with([
                        'namaKegiatan' => $this->pengajuan->nama_kegiatan,
                        'status' => $this->pengajuan->status,
                        'tglAwal' => $this->pengajuan->tgl_awal,
                        'tglSelesai' => $this->pengajuan->tgl_selesai,
                        'jamKegiatan' => $this->pengajuan->jam_kegiatan,
                        'waktuSelesai' => $this->pengajuan->waktu_selesai,
                        'deskripsiKegiatan' => $this->pengajuan->deskripsi_kegiatan,
                        'perlengkapan' => $this->pengajuan->perlengkapan,
                        'linkZoom' => $this->pengajuan->link_zoom,
                        'unitKegiatan' => $this->pengajuan->unit_kegiatan,
                        'tempatKegiatan' => $this->pengajuan->tempat_kegiatan,
                        'alasanDitolak' => $this->pengajuan->alasan_ditolak,
                        'linkDesain' => $this->pengajuan->link_desain,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengajuan Updated Mail',
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
