@include('client.header')

<div class="content">
    <div class="p-4">
        <a href="{{ route('client.add') }}" class="normal_button">إضافة جديد</a>
    </div>
    <!-- <div class="relative overflow-x-clip shadow-none sm:rounded-none"> -->
    <div class="overflow-x-auto flex flex-col md:flex-row pb-4 mb-4">
        <!-- <div class="w-64 font-bold h-6 mx-2 mt-3 text-gray-800">فلترة العملاء
            <div class="text-xs font-normal leading-none text-gray-500">Your billing address</div>
        </div> -->
        <div class="flex-1">
            <form action="" method="get">
                <div class="flex flex-col md:flex-row">
                    <select class="select_box" name="neighborhood">
                        <option value="" disabled selected>الحي</option>
                        @foreach ($neighborhoods as $neighborhood)
                            <option value="{{$neighborhood->id}}">{{$neighborhood->name}}</option>
                        @endforeach
                    </select>
                    <select class="select_box" name="category">
                        <option value="" disabled selected>النشاط</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <select class="select_box" name="service">
                        <option value="" disabled selected>الخدمة</option>
                        @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                    <select class="select_box" name="section">
                        <option value="" disabled selected>الفئة</option>
                        @foreach ($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                        @endforeach
                    </select>
                    <div class="w-full flex-1 mx-2">
                        <div class="my-2 p-1 bg-white flex border border-gray-500 rounded-none">
                            <input placeholder="رقم الهاتف" name="phone" value="" class="p-1 px-2 appearance-none outline-none w-full text-gray-800 ">
                        </div>
                    </div>
                    <div class="w-full flex-1 mx-2">
                        <div class="my-2 p-1 bg-white flex border border-gray-500 rounded-none">
                            <input placeholder="اسم الشركة" name="company_name" value="" class="p-1 px-2 appearance-none outline-none w-full text-gray-800 ">
                        </div>
                    </div>
                    <div class="w-full flex-1 mx-2">
                        <div class="my-2 p-0 ">
                            <input type="submit" value="بحث" class="normal_button" />
                            @if (request()->hasAny('neighborhood', 'category', 'phone' , 'company_name'))
                                <a href="{{ route('client.home') }}"  class="cancel_button" >ضبط</a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>          
        </div>
    </div>

    <div class="my-2 bg-gray-400 h-[1px]"></div>
    
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-10">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto px-6 text-sm text-center text-gray-900 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-300 dark:text-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3">#</th>
                                <th scope="col" class="px-6 py-3">الاسم</th>
                                <th scope="col" class="px-6 py-3">رقم الهاتف</th>
                                <th scope="col" class="px-6 py-3">الخدمة</th>
                                <th scope="col" class="px-6 py-3">الفئة</th>
                                <th scope="col" class="px-6 py-3">الحي</th>
                                <th scope="col" class="px-6 py-3">النشاط</th>
                                <th scope="col" class="px-6 py-3">أرسل للمهندس</th>
                                <th scope="col" class="px-6 py-3">الموقع</th>
                                <th scope="col" class="px-6 py-3">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                @if ( $client->is_visited == 1 )
                                <tr class="bg-white border-b text-black dark:bg-gray-50 dark:border-gray-700 is_visited">
                                @else
                                <tr class="bg-white border-b text-black dark:bg-gray-50 dark:border-gray-700">
                                @endif
                                    <th scope="row">{{$client->id}}</th>
                                    <td class="px-6 py-2">{{$client->name}}</td>
                                    <td class="px-6 py-2">{{$client->phone}}</td>
                                    <td class="px-6 py-2">{{$client->service_name}}</td>
                                    <td class="px-6 py-2">{{$client->section_name}}</td>
                                    <td class="px-6 py-2">{{$client->neighborhood_name}}</td>
                                    <td class="px-6 py-2">{{$client->category_name}}</td>
                                    <td class="px-6 py-2">
                                        @if ( $client->send_to_engineer == 1 )
                                            <input type="checkbox" checked onchange="javascript:send_to_engineer({{ $client->id }})"/>
                                        @else
                                            <input type="checkbox" onchange="javascript:send_to_engineer({{ $client->id }})"/>
                                        @endif
                                    </td>
                                    <td class="px-6 py-2"><a href="https://www.google.com/maps/search/?api=1&query={{$client->latitude}},{{$client->longitude}}" target="_blank" class="text-green-800 font-extrabold hover:underline">فتح الموقع</a></td>
                                    <td class="px-6 py-2">
                                        <div class="w-full block">
                                        <a href="{{ route('client.edit') }}?id={{$client->id}}"  class="text-orange-500 !important font-extrabold hover:underline">تعديل</a> / 
                                        <a href="{{ route('client.deleteClient') }}?id={{$client->id}}"  class="text-red-800 font-extrabold hover:underline">حذف</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $clients->links('pagination::bootstrap-4') }}
    <!-- </div> -->
</div>


<script>
    function send_to_engineer(client_id){
                    
        $.post("{{ route('client.sendToEngineer') }}", {id: client_id , _token: '{{ csrf_token() }}' }, function(result){
            console.log(result);
        });
        
    }
</script>
@include('client.footer')