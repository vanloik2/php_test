$(document).ready(function () {
    $("#add-prescription").click(function () {
        var intId = $(".group-form-dynamic .group-input").length || 0;

        var optionStrings = "<option value=''>Please selected dish !!!</option>";
        if (localStorage['dishes']) {
            $.each($.parseJSON(localStorage['dishes']), function (i, val) {
                optionStrings += `<option value="${val}">${val}</option>`
            });
        }

        var presFields = $(
            `<div class="row group-input">
                <div class="col-md-8 w-row form-group">
                    <label class="label-control">Please select a dish <i style="color:red">*</i></label>
                    <select class="form-control" name="dishes[${intId}]" id="exampleFormControlSelect1">
                        ` + optionStrings + `
                    </select>
                    <div class="show-error validate-step3 dishes-${intId}"></div>
                </div>
                <div class="col-md-4 w-row form-group">
                    <label class="label-control">Quantity <i style="color:red">*</i></label>
                    <input type="number" min="0" name="quantities[${intId}]" class="form-control" id="">
                    <div class="show-error validate-step3 quantities-${intId}"></div>
                    </div>
            </div>`
        );

        $(".group-form-dynamic").append(presFields);
    });

    $("#remove-prescription").click(function () {
        $(".group-form-dynamic .group-input:last").remove();
    });
});
