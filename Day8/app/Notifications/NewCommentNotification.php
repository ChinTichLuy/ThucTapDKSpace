<?php

namespace App\Notifications;

use App\Mail\CommentNotificationMail;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    public $comment;
    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Bình luận mới cho bài viết của bạn')
            ->greeting('Xin chào ' . $notifiable->name . ',')
            ->line('Bài viết của bạn vừa nhận được một bình luận mới từ ' . $this->comment->user->name . '.')
            ->line('Nội dung bình luận: "' . $this->comment->content . '"')
            ->action('Xem bài viết', route('posts.show', $this->comment->post->id))
            ->line('Cảm ơn bạn đã sử dụng hệ thống của chúng tôi!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'comment_id' => $this->comment->id,
            'post_id' => $this->comment->post->id,
            'user_name' => $this->comment->user->name,
            'content' => $this->comment->content,
        ];
    }
}
