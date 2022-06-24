<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"/> -->    
    <title>لوحة التحكم بالعملاء</title>
</head>

<body>

    <div class="flex">
        <nav class="lg:w-72">
            <span class="absolute shadow-md p-2 border-gray-100 border-solid border-2 rounded-md text-white text-4xl top-5 right-4 cursor-pointer" onclick="openSidebar()">
                <!-- <i class="bi bi-filter-right px-2 bg-gray-900 rounded-md"></i> -->        
                <img src="{{ asset('imgs/menu.svg') }}" class="h-8 w-8" alt="القائمة">
            </span>
            <div class="sidebar z-50 transition duration-150 ease-in-out  hidden lg:block fixed top-0 bottom-0 lg:right-0 p-2 w-[250px] overflow-y-auto text-center bg-[#420744]">
                <div class="text-gray-100 text-xl">
                    <div class="p-2.5 mt-1 flex items-center">
                        <!-- <i class="bi bi-app-indicator px-2 py-1 rounded-md bg-blue-600"></i> -->
                        <h1 class="font-bold text-white lg:text-[1.6rem] ml-3">Safty Platform</h1>                    
                        <img src="{{ asset('imgs/letter-x.svg') }}" class="h-8 w-8 ml-5 cursor-pointer left-0 absolute lg:hidden" onclick="openSidebar()" alt="">
                        <!-- <i class="bi bi-x cursor-pointer text-[45px] mr-28 lg:hidden" onclick="openSidebar()"></i> -->
                    </div>
                    <div class="my-2 bg-white h-[1px]"></div>
                </div>            
                <div class="navbar_item">
                    
                    <!-- <i class="bi bi-house-door-fill"></i> -->
                    <img src="{{ asset('imgs/home.svg') }}" class="h-8 w-8 ml-5" alt="">
                    <a href="{{ route('client.home') }}" class="navbar_item_text">الرئيسية</a>
                    
                </div>
                <div class="navbar_item">
                    <!-- <i class="bi bi-bookmark-fill"></i> -->
                    <img src="{{ asset('imgs/city.svg') }}" class="h-8 w-8 ml-5" alt="">
                    <a href="{{ route('category.home') }}" class="navbar_item_text">الانشطة والاحياء</a>
                </div>
                <div class="navbar_item">
                    <!-- <i class="bi bi-bookmark-fill"></i> -->
                    <img src="{{ asset('imgs/trash.svg') }}" class="h-8 w-8 ml-5" alt="">
                    <span class="navbar_item_text">الطلبات المرفوضة</span>
                </div>
                <div class="my-4 bg-white h-[1px]"></div>
                <div class="navbar_item">
                    <!-- <i class="bi bi-bookmark-fill"></i> -->
                    <img src="{{ asset('imgs/gear.svg') }}" class="h-8 w-8 ml-5" alt="">
                    <span class="navbar_item_text">الاعدادات</span>
                </div>
                <!-- <div class="navbar_item" onclick="dropdown()">
                    <i class="bi bi-chat-left-text-fill"></i>
                    <div class="flex justify-between w-full items-center">
                        <span class="navbar_item_text">Chatbox</span>
                        <span class="text-sm rotate-180" id="arrow">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </div>
                </div>
                <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200 font-bold" id="submenu">
                    <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                        Social
                    </h1>
                    <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                        Personal
                    </h1>
                    <h1 class="cursor-pointer p-2 hover:bg-blue-600 rounded-md mt-1">
                        Friends
                    </h1>
                </div> -->
                <div class="navbar_item">
                    <!-- <i class="bi bi-box-arrow-in-right"></i> -->
                    <img src="{{ asset('imgs/logout.svg') }}" class="h-8 w-8 ml-5" alt="">
                    <span class="navbar_item_text">تسجيل الخروج</span>
                </div>
            </div>
        </nav>

    <script type="text/javascript">

        function dropdown() {
            /*document.querySelector("#submenu").classList.toggle("hidden");*/
            document.querySelector("#arrow").classList.toggle("rotate-0");
        }

        //dropdown();

        function openSidebar() {
            document.querySelector(".sidebar").classList.toggle("hidden");
        }
    </script>