<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>welcome</title>
    
</head>
<body class="bg-cyan-800">
    <div class="mx-auto lg:w-[500px] w-[350px]">
        <div class="flex items-stretch place-items-stretch bg-white m-4 rounded-md shadow-md">
            <a href="{{route('client.home')}}" class="block h-full w-full p-9 text-center text-2xl font-bold    self-center">المندوب</a>
        </div>
        <div class="flex items-stretch place-items-stretch bg-white m-4 rounded-md shadow-md">
            <a href="{{route('engineer.home')}}" class="block h-full w-full p-9 text-center text-2xl font-bold    self-center">المهندس</a>
        </div>
    </div>
</body>
</html>