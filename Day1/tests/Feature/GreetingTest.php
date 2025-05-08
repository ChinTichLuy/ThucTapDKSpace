<?php
namespace Tests\Feature;

use Illuminate\Support\Facades\App;
use Tests\TestCase;

class GreetingTest extends TestCase
{
    public function test_greeting_in_vietnamese()
    {
        App::setLocale('vi'); // Thiết lập ngôn ngữ là Tiếng Việt.

        $response = $this->get('/greeting'); // Gửi yêu cầu GET tới /greeting.
        $response->assertStatus(200); // Kiểm tra HTTP response có status code là 200 (thành công).
        $response->assertSee('Xin chào, quản trị viên'); // Kiểm tra nội dung phản hồi có chứa dòng chữ "Xin chào, quản trị viên".
    }

    public function test_greeting_in_english()
    {
        App::setLocale('en');

        $response = $this->get('/greeting');
        $response->assertStatus(200);
        $response->assertSee('Hello, admin');
    }
}
