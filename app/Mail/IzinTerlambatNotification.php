<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class IzinTerlambatNotification extends Mailable
{
    public $terlambat;

    public function __construct($terlambat)
    {
        $this->terlambat = $terlambat;
    }

    public function build()
    {
        return $this->view('content.Employee.izin.mail.izin-terlambat-notification')
            ->subject('Izin Datang Terlambat ' . $this->terlambat->nama)
            ->from(auth()->user()->email, auth()->user()->name); // Menggunakan alamat email pengguna yang saat ini masuk sebagai pengirim
    }

}