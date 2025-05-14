<?php

namespace App\Jobs;

use App\Mail\CommentNotificationMail;
use App\Models\Comment;
use App\Notifications\NewCommentNotification;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NotifyAuthorOfComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $comment;
    /**
     * Create a new job instance.
     */
     public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         $author = $this->comment->post->user;

        // gửi thông báo qua email cho tác giả khi có ng dùng cmt vào bài viết
        Mail::to(new Address($author->email))->send(new CommentNotificationMail($this->comment));

        // gửi thông báo qua database
        $author->notify(new NewCommentNotification($this->comment));
    }
}
