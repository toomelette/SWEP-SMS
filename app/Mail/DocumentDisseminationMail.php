<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentDisseminationMail extends Mailable{


    use Queueable, SerializesModels;

    public $path;
    public $subject;
    public $filename;
    public $email;
    public $content;




    public function __construct($path, $subject, $filename, $email, $content){
        
        $this->path = $path;
        $this->subject = $subject;
        $this->filename = $filename;
        $this->email = $email;
        $this->content = $content;

    }





    public function build(){



         $path = $this->path;
         $subject = $this->subject;
         $filename = $this->filename;
         $email = $this->email;
         $content = $this->content;

         

        return $this->subject($subject)
                    ->attach($path, ['name' => $filename, 'mime' => 'application/pdf'])
                    ->to($email)
                    ->view('emails.document_dissemination')
                    ->with(['content' => $content]);

    }




}
