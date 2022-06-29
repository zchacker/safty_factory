@include('engineer.header')

<div class="content">
    <h1 class="text-xl font-bold mb-8">تفاصيل العميل</h1>
    <div class="relative overflow-x-clip">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="details_card">
                <strong>الاسم: </strong> <span>{{ $details->name }}</span>
            </div>
            <div class="details_card">
                <strong>رقم الهاتف: </strong> <span>{{ $details->phone }}</span>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="details_card">
                <strong>اسم الشركة: </strong> <span>{{ $details->company_name }}</span>
            </div>
            <div class="details_card">
                <strong>النشاط: </strong> <span>{{ $details->category_name }}</span>
            </div>
        </div>            
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="details_card">
                <strong>اسم الحي: </strong> <span>{{ $details->neighborhood_name }}</span>
            </div>       
            <div class="details_card">
                <strong>الموقع على الخريطة: </strong><a href="https://www.google.com/maps/search/?api=1&query={{$details->latitude}},{{$details->longitude}}" target="_blank" class="text-blue-800 font-extrabold hover:underline">فتح الموقع</a>
            </div>
        </div>


        
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="details_card">
                <strong>اسم الخدمة: </strong> <span>{{ $details->service_name }}</span>
            </div>       
            <div class="details_card">
                <strong>الفئة: </strong><span>{{ $details->section_name }}</span>
            </div>
        </div>


        <!-- wow  -->
        <div class="grid grid-cols-1 lg:grid-cols-1">
            <div class="details_card">
                <strong>ملاحظات: </strong> <span>{{ $details->note }}</span>
            </div>
        </div>
        <div id="map" class="lg:h-[400px] h-[400px] lg:mx-10 lg:my-4 mx-3 bg-slate-700 "></div>
        <div class="my-2 bg-gray-400 h-[1px]"></div>
        <div class="relative z-0 w-full mb-6 group">
            <form action="" method="post">
                @csrf
                <input type="submit" name="compelte" value="اكتملت المعاملة" class="normal_button" />
                <input type="submit" name="uncompelte" value="تم رفض المعاملة" class="cancel_button" />
            </form>
        </div>
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
            lat: {{$details->latitude}},
            lng:  {{$details->longitude}}
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

        /*google.maps.event.addListener(marker, 'dragend', function() {

            $('#latitude').val(marker.getPosition().lat());
            $('#longitude').val(marker.getPosition().lng());

            map.setCenter(marker.getPosition());
            //geocodePostion(marker.getPosition());
            console.log("123");
        })*/
    }

    // function geocodePostion(pos) {
    //     geocoder = new google.maps.Geocoder();
    //     geocoder.geocode({
    //             latLng: pos
    //         },
    //         function(results, status) {
    //             if (status == google.maps.GeocoderStatus.OK) {
    //                 $('#location_name').html(results[0].formatted_address);

    //                 // $('#latitude').val(marker.getPosition().lat());
    //                 // $('#longitude').val(marker.getPosition().lng());                  
    //             } else {
    //                 $('#location_name').html("Location can not fetch");
    //             }
    //         });
    // }

    window.initMap = initMap;
</script>


@include('engineer.footer')