@include('engineer.header')

<div class="content">    

    <h2 class="text-[1.5rem] font-bold">قائمة العملاء الواردة</h2>
    <div class="my-2 bg-gray-400 h-[1px]"></div>
    
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="w-full px-6 text-sm text-center text-gray-900 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-300 dark:text-gray-900">
                            <tr>
                                <th scope="col" class="px-6 py-3">#</th>
                                <th scope="col" class="px-6 py-3">الاسم</th>
                                <th scope="col" class="px-6 py-3">رقم الهاتف</th>
                                <th scope="col" class="px-6 py-3">الحي</th>
                                <th scope="col" class="px-6 py-3">النشاط</th>                                
                                <th scope="col" class="px-6 py-3">الموقع</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)                                
                                <tr data-href="{{ route('engineer.details') }}?id={{ $client->id }}" title="{{ route('engineer.details') }}?id={{ $client->id }}" class="clickable-row bg-white border-b text-black dark:bg-gray-50 dark:border-gray-700"  >
                                    <th scope="row">{{$client->id}}</th>
                                    <td class="px-6 py-2">{{$client->name}}</td>
                                    <td class="px-6 py-2">{{$client->phone}}</td>
                                    <td class="px-6 py-2">{{$client->neighborhood_name}}</td>
                                    <td class="px-6 py-2">{{$client->category_name}}</td>                                    
                                    <td class="px-6 py-2"><a href="https://www.google.com/maps/search/?api=1&query={{$client->latitude}},{{$client->longitude}}" target="_blank" class="text-green-800 font-extrabold hover:underline">فتح الموقع</a></td>                                    
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
    $(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
</script>
@include('engineer.footer')