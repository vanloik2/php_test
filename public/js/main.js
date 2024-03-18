// ------------step-wizard-------------
$(document).ready(function () {

    // Click submit step 1
    $('.btn-step-1').click(function (e) {
        var meal = $("select[name=meal]").val();
        var amountPeople = $("input[name=amount_people]").val();

        $("select[name=restaurant] option").remove()
        $('.meal-error span').remove()
        $('.amount-people-error span').remove()

        $.ajax({
            method: 'GET',
            url: "/restaurants",
            data: {
                meal: meal,
                amount_people: amountPeople,
            },
            success: function (response) {
                var options = "<option value=''>Please selected restaurant !!!</option>";
                $.each(response, function (i, val) {
                    options += `<option value="${val}">${val}</option>`
                });

                $("select[name=restaurant]").append(options)
                // Next step 
                var active = $('.wizard .nav-tabs li.active');
                active.next().removeClass('disabled');
                nextTab(active);
                // clear message errors
                $('.show-error span').remove()
                return
            },
            error: function (e) {
                const errors = e.responseJSON?.errors ?? null
                errors.meal = errors?.meal ? errors?.meal[0] : ""
                errors.amount_people = errors?.amount_people ? errors?.amount_people[0] : ""
                $('.meal-error').append(`<span >${errors?.meal}</span>`)
                $('.amount-people-error').append(`<span >${errors?.amount_people}</span>`)
                return
            }
        });
    });

    // Click submit step 2
    $('.btn-step-2').click(function (e) {
        var meal = $("select[name=meal]").val();
        var restaurant = $("select[name=restaurant]").val();
        $('.restaurant-error span').remove()
        $(".dishes option").remove()


        $.ajax({
            method: 'GET',
            url: "/dishes",
            data: {
                meal: meal,
                restaurant: restaurant,
            },
            success: function (response) {
                var options = "<option value=''>Please selected dish !!!</option>";
                $.each(response, function (i, val) {
                    options += `<option value="${val}">${val}</option>`
                });

                $(".dishes").append(options)
                localStorage.clear()
                localStorage['dishes'] = JSON.stringify(response)

                // Next step 
                var active = $('.wizard .nav-tabs li.active');
                active.next().removeClass('disabled');
                nextTab(active);
                // clear message errors
                $('.show-error span').remove()
            },
            error: function (e) {
                const errors = e.responseJSON?.errors ?? null
                errors.restaurant = errors?.restaurant ? errors?.restaurant[0] : ""
                $('.restaurant-error').append(`<span >${errors?.restaurant}</span>`)
                return
            }
        });
    });

    $(".next-step").click(function (e) {

    });

    $(".prev-step").click(function (e) {

        var active = $('.wizard .nav-tabs li.active');
        prevTab(active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}

function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}


$('.nav-tabs').on('click', 'li', function () {
    $('.nav-tabs li.active').removeClass('active');
    $(this).addClass('active');
});

// Form submit
$('.submit-form').click(function () {
    // get all the inputs into an array.
    var $inputs = $('#reservation-form :input');

    // not sure if you wanted this, but I thought I'd add it.
    // get an associative array of just the values.
    var values = {};
    $inputs.each(function () {
        values[this.name] = $(this).val();
    });

    var dishes = $('select[name^=dishes]').map(function (idx, elem) {
        return $(elem).val();
    }).get();

    var quantities = $('input[name^=quantities]').map(function (idx, elem) {
        return $(elem).val();
    }).get();

    $.ajax({
        method: 'GET',
        url: "/validate-step-3",
        data: {
            dishes: dishes,
            quantities: quantities,
        },
        success: function (response) {
            // Next step 
            var active = $('.wizard .nav-tabs li.active');
            active.next().removeClass('disabled');
            nextTab(active);
            // clear message errors
            $('.show-error span').remove()
            // clear message errors
            $('.show-error span').remove()
        },
        error: function (e) {
            const errors = e.responseJSON?.errors ?? null

            let fields = [];
            for (let i = 0; i < Object.keys(errors).length; i++) {
                fields.push('dishes.' + i)
                fields.push('quantities.' + i)
            }

            $('.validate-step3 span').remove()
            $.each(errors, function (key, val) {
                if ($.inArray(key, fields) > -1) {
                    let classHtml = key.replace('.', '-')
                    $(`.${classHtml}`).append(`<span>${val[0]}</span>`)
                }
            })
            return
        }
    })

    //Show Step 4
    $(".meal-review p").remove()
    $(".meal-review").append(`<p>${values?.meal ?? ""}</p>`)
    $(".amount-people-review p").remove()
    $(".amount-people-review").append(`<p>${values?.amount_people ?? ""}</p>`)
    $(".restaurant-review p").remove()
    $(".restaurant-review").append(`<p>${values?.restaurant ?? ""}</p>`)

    var counts = {};
    $.each(dishes, function (key, value) {
        if (!counts.hasOwnProperty(value)) {
            counts[value] = quantities[key];
        } else {
            counts[value] = Number(counts[value]) + Number(quantities[key]);
        }
    });

    var dishesString = "";
    $.each(counts, function (key, val) {
        dishesString += `<p>${key}  -   ${val}</p>`
    })
    $(".dishes-review p").remove()
    $(".dishes-review").append(dishesString)
});