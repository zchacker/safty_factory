<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>تسجيل الدخول</title>

</head>

<body class="bg-gray-100">
    <div class="mx-auto lg:w-[500px] w-[350px] p-8">
        <h1 class="text-3xl font-bold">تسجيل الدخول للنظام</h1>
        <form action="" method="post" class="block mt-12">
            @csrf
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" id="email" name="email" class="input_box peer" value="{{ old('email') }}" placeholder="" required />
                <label for="email" class="lable_box">البريد الالكتروني</label>
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <input type="text" id="password" name="password" class="input_box peer" value="{{ old('password') }}" placeholder="" required />
                <label for="password" class="lable_box">كلمة المرور</label>
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <input type="submit" value="دخول" class="normal_button" />                
            </div>
        </form>
    </div>
</body>

</html>