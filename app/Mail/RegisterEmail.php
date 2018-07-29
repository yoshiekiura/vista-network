<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
     //   return $this->view('view.name');
        return $this->from('vista@vibetron.com')
                    ->view('mails.registration')
                    ->with(
                      [
                            'first_name' => $data['first_name'],
                            'last_name' => $data['last_name'],
                            'username' => $data['username'],
                            'password' => $data['password'],
                      ])
                      ->attach(public_path('/assets/images/logo').'/logo.png', [
                              'as' => 'logo.png',
                              'mime' => 'image/png',
                      ]);
    }
}
