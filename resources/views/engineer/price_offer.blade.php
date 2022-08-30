@include('engineer.header')

<div class="content">
    <h1 class="text-xl font-bold mb-8"> كتابة عرض سعر </h1>
    <div class="relative overflow-x-clip">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="relative z-0 w-full mb-6 group">               
                <input type="text" name="name" id="name" class="input_box peer" value="{{ $customer->name }}" disabled />
                <label for="name" class="lable_box">اسم العميل</label>
            </div>  
            <div class="relative z-0 w-full mb-6 group">               
                <input type="text" name="name" id="name" class="input_box peer" value="{{ $customer->company_name }}" disabled />
                <label for="name" class="lable_box">اسم الشركة</label>
            </div>         
        </div>
        
        <form action="" method="post">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="relative z-0 w-full mb-6 group">               
                <input type="date" name="name" id="name" class="input_box peer" value="" required />
                <label for="name" class="lable_box"> التاريخ </label>
            </div>  
            <div class="relative z-0 w-full mb-6 group">               
                <input type="date" name="name" id="name" class="input_box peer" value="" required />
                <label for="name" class="lable_box"> صالح لغاية </label>
            </div>         
        </div>
        
        <div class="relative z-0 w-full mb-6 group">
            <p for="service" class="font-bold text-sm text-gray-500">الخدمة المطلوبة</p>
            
            @foreach ($products as $product)                    
                <div class="flex justify-between my-3">
                    <label for="{{$product->name}}" class="required:border-red-500 px-2 block border-b-2 border-gray-600 border-dotted w-full">
                    {{$product->name}}
                    </label>
                    <input type="number" name="products[]" class="mx-2 border border-gray-600 w-[50px]" id="{{$product->name}}" value="{{$product->name}}" >
                </div>
            @endforeach            
        </div>

        
        <div class="my-2 bg-gray-400 h-[1px]"></div>
        <div class="relative z-0 w-full mb-6 group">
                @csrf
                <input type="submit" name="compelte" value="حفظ" class="normal_button" />
            </form>
        </div>
    </div>
</div>





@include('engineer.footer')