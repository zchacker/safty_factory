@include('client.header')

<div class="content">
    <h1 class="text-xl font-bold mb-8">إضافة عميل جديد</h1>
    <div class="relative overflow-x-clip">
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
        <form action="" method="post" class="relative">
            @csrf
            <div class="grid xl:grid-cols-2 xl:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="first_name" id="floating_first_name" class="input_box peer" placeholder=" " required />
                    <label for="floating_first_name" class="lable_box">الاسم الاول</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="last_name" id="floating_last_name" class="input_box peer" placeholder=" " required />
                    <label for="floating_last_name" class="lable_box">الاسم الاخير</label>
                </div>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="tel" name="phone" class="input_box peer" placeholder=" " required />
                <label for="floating_phone" class="lable_box">رقم الهاتف</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="company_name" id="company_name" class="input_box peer" placeholder=" " required />
                <label for="company_name" class="lable_box">اسم الشركة / المؤسسة</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <label for="neighborhood" class="lable_box">الحي</label>
                <select name="neighborhood" id="neighborhood" class="input_box peer">
                    @foreach ($neighborhoods as $neighborhood)
                    <option value="{{$neighborhood->id}}">{{$neighborhood->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <label for="category" class="lable_box">نوع النشاط</label>
                <select name="category" id="category" class="input_box peer">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="relative z-0 w-full mb-6 group">
                <label for="note" class="lable_box">ملاحظات</label>
                <textarea name="note" class="input_box" id="note" cols="30" rows="10"></textarea>
            </div>

            <input type="hidden" name="latitude" id="latitude" />
            <input type="hidden" name="longitude" id="longitude" />

            <h2 class="font-bold my-5">اختر الموقع على الخريطة</h2>

            <span id="location_name" class="text-red-700 text-lg my-8"></span>

            <a href="javascript:getLocation();" class="normal_button">
                <span class="mt-5 mb-10">حدد موقعي</span>                
            </a>

            <div id="map" class="my-3 lg:h-[400px] h-[400px] lg:mx-10 lg:my-4 mx-3 bg-slate-700 ">

            </div>
            <div class="my-4 bg-gray-200 h-[1px]"></div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="submit" value="حفظ" class="normal_button" />
                <a href="{{ route('client.home') }}" class="cancel_button">إلغاء</a>
            </div>
        </form>
    </div>
</div>


<!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&callback=initMap&v=weekly" defer></script>

<script>
    var map, marker;

    // Initialize and add the map
    function initMap() {

        // The location of Medina
        const medinaCoordinator = {
            lat: 24.470383,
            lng: 39.608420
        };

        // The map, centered at medinaCoordinator
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: medinaCoordinator,
        });

        // The marker, positioned at medinaCoordinator
        marker = new google.maps.Marker({
            position: medinaCoordinator,
            map: map,
            draggable: true
        });

        //geocodePostion(marker.getPosition());      

        $('#latitude').val(marker.getPosition().lat());
        $('#longitude').val(marker.getPosition().lng());


        google.maps.event.addListener(marker, 'dragend', function() {

            $('#latitude').val(marker.getPosition().lat());
            $('#longitude').val(marker.getPosition().lng());

            map.setCenter(marker.getPosition());
            //geocodePostion(marker.getPosition());
            console.log("123");
        })
    }

    function geocodePostion(pos) {
        geocoder = new google.maps.Geocoder();
        geocoder.geocode({
                latLng: pos
            },
            function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    $('#location_name').html(results[0].formatted_address);

                    // $('#latitude').val(marker.getPosition().lat());
                    // $('#longitude').val(marker.getPosition().lng());                  
                } else {
                    $('#location_name').html("Location can not fetch");
                }
            });
    }

    function getLocation() {

        console.log("start get location");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        
        const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
        };
        
        map.setCenter(pos);
        
        marker.setPosition(pos);

        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);

    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("لا يوجد اذن للوصول الى اللوكشين");
                //x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                alert("غير قادر على الوصل الى موقعك");
                //x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                alert("تجاوز الوقت المسموح به للوصول الى موقعك");
                //x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                alert("حدث خطأ غير معرو");
                //x.innerHTML = "An unknown error occurred."
                break;
        }
    }

    getLocation();

    window.initMap = initMap;
</script>
@include('client.footer')