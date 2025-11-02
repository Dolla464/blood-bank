//articles-carousel
$(document).ready(function() {
    $('.articles-carousel').owlCarousel({
        loop: false,
        margin: 10,
        rtl: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: true,
                loop: false
            }
        }
    })
});

// Governorate -> Cities dependent select (use local endpoint)
$("#governorates").on('change', function() {
    var governorateId = $(this).val();
    var $cities = $("#cities");

    $cities.prop('disabled', true).empty().append('<option selected disabled hidden value="">جاري التحميل...</option>');

    var endpoint = (window.websiteAjaxCities && typeof window.websiteAjaxCities === 'string')
        ? window.websiteAjaxCities
        : ((window.laravelurl || '') + '/ajax/cities');
    $.ajax({
        url: endpoint,
        type: 'GET',
        dataType: 'json',
        cache: false,
        data: { governorate_id: governorateId },
        success: function(result) {
            $cities.empty().append('<option selected disabled hidden value="">اختر المدينة</option>');
            if (result && result.status === 1 && Array.isArray(result.data) && result.data.length) {
                $.each(result.data, function(index, city) {
                    var option = '<option value="' + city.id + '">' + city.name + '</option>';
                    $cities.append(option);
                });
                $cities.prop('disabled', false);
            } else {
                $cities.append('<option disabled>لا توجد مدن لهذه المحافظة</option>').prop('disabled', true);
            }
        },
        error: function() {
            $cities.empty().append('<option disabled>حدث خطأ أثناء تحميل المدن</option>').prop('disabled', true);
        }
    });
});