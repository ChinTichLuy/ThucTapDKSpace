Vai trò của từng thư mục:
app/Http         Chứa các Controller, middleware và request, nơi xử lý Logic
app/Providers    Chứa các service provider, nơi đăng ký các service
resources/views  Chứa view hiển thị giao diện
routes/          Chứa các đường dẫn, định nghĩa route
storage/,        Chứa các file tạm thời, log, hoặc các file tải lên.
bootstrap/       Chứa các file khởi tạo ứng dụng.

Giải thích: Service Container là gì và nó nằm ở đâu trong cấu trúc Laravel

- Service Container là một công cụ quản lý các lớp và phụ thuộc giữa các Dependency Injection.
có thể sử dụng container này để bind (đăng ký) các service và resolve (kết nối) các service vào các phần của project.

- Service Container nằm ngay bên trong Laravel framework, Laravel đã tự tạo và quản lý từ lúc khởi động app.

trong file bootstrap/app.php
<<< return Application::configure(basePath: dirname(__DIR__)) >>>
Application ở đây chính là class kế thừa từ Illuminate\Container\Container, nghĩa là:
=> Application chính là Service Container

app()->bind(...)  
app()->make(...)
Laravel tự gán app() vào Application đó.

