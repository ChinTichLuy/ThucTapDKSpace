<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký Ứng Viên</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-xl bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Form Đăng Ký Ứng Viên</h1>

        @include('components.alert')

        <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <!-- Họ tên -->
            <div>
                <label class="block font-medium">Họ tên:</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="mt-1 w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block font-medium">Email:</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="mt-1 w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ngày sinh -->
            <div>
                <label class="block font-medium">Ngày sinh:</label>
                <input type="date" name="birthday" value="{{ old('birthday') }}"
                    class="mt-1 w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('birthday')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ảnh đại diện -->
            <div>
                <label class="block font-medium">Ảnh đại diện:</label>
                <input type="file" name="avatar"
                    class="mt-1 w-full border border-gray-300 rounded px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-white file:bg-blue-500 hover:file:bg-blue-600">
                @error('avatar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- CV -->
            <div>
                <label class="block font-medium">CV (PDF):</label>
                <input type="file" name="cv"
                    class="mt-1 w-full border border-gray-300 rounded px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-white file:bg-blue-500 hover:file:bg-blue-600">
                @error('cv')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bio -->
            <div>
                <label class="block font-medium">Mô tả ngắn:</label>
                <textarea name="bio" rows="4"
                    class="mt-1 w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('bio') }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gửi -->
            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 text-white font-semibold px-6 py-2 rounded hover:bg-blue-700 transition">
                    Gửi Hồ Sơ
                </button>
            </div>
        </form>
    </div>

</body>

</html>
