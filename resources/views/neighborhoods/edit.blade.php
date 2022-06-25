@include('client.header')

<div class="content">
    <h1 class="text-xl font-bold mb-8">تعديل الحي</h1>
    <div class="w-full my-2">
        @if (strlen($error_message) > 0)
        <div class="danger" role="alert">
            {!! $error_message !!}
        </div>
        @endif

        @if (strlen($message) > 0)
        <div class="success" role="alert">
            {{ $message }}
        </div>
        @endif
    </div>
    <div class="relative overflow-x-clip mt-6">        
        <form action="" method="post" class="relative">
            @csrf            
            <div class="relative z-0 w-full mb-6 group">
                <input type="text"id="name" name="name" class="input_box peer" value="{{ $neighborhood->name }}" placeholder="" required />
                <label for="name" class="lable_box">اكتب اسم الحي</label>
            </div>            
            
            <div class="relative z-0 w-full mb-6 group">
                <input type="submit" value="حفظ" class="normal_button" />
                <a href="{{ route('neighborhood.home') }}" class="cancel_button">إلغاء</a>
            </div>
        </form>
    </div>
</div>


@include('client.footer')