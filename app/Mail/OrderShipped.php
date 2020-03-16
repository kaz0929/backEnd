<?php

namespace App\Mail;

use App\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ContactUs $content)
    {
        $this->content = $content ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('感謝您來信!!')->markdown('emails.orders.shipped')->with('content', $this->content);

        // $message->subject($subject); (定義信件標題)
        // $message->attach($pathToFile, array $options = []); (寄送附件)
        // $message->with(變數名稱, 變數來源) (上方__construct預先定義的資料庫內容,引入何種資料庫在constuct定義,並無限制)
    }
}
