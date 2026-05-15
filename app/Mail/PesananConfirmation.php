<?php

namespace App\Mail;

use App\Models\Pesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PesananConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Pesanan $pesanan) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Konfirmasi Reservasi – Aurevia Hotel',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.pesanan.confirmation',
            with: ['pesanan' => $this->pesanan],
        );
    }
}