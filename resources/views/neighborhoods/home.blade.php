@include('client.header')

<div class="content">
    <div class="p-4">
        <a href="{{ route('neighborhood.add') }}" class="normal_button">إضافة جديد</a>
    </div>
    
    <div class="tab_cover my-8">
        <ul class="tab_ul">
            <li class="mr-2">
                <a href="{{ route('category.home') }}" class="unselected_tab">الانشطة</a>
            </li>                
            <li class="mr-2">
                <a href="{{ route('neighborhood.home') }}" class="selected_tab">الأحياء</a>
            </li>                           
        </ul>
    </div>
    
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="w-full px-6 text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-300 dark:text-gray-800">
                            <tr>
                                <th scope="col" class="px-6 py-3">#</th>
                                <th scope="col" class="px-6 py-3">الاسم</th>
                                <th scope="col" class="px-6 py-3">حذف / تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($neighborhoods as $neighborhood)                                
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">                                                                                                
                                    <th scope="row">{{$neighborhood->id}}</th>
                                    <td class="px-6 py-2">{{$neighborhood->name}}</td>                                    
                                    <td class="px-6 py-2"><a href="{{route('neighborhood.edit')}}?id={{$neighborhood->id}}" class="text-red-800 font-extrabold hover:underline">تعديل</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $neighborhoods->links('pagination::bootstrap-4') }}
    <!-- </div> -->
</div>

@include('client.footer')