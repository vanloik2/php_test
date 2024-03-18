<div class="tab-pane" role="tabpanel" id="step3">
    <section class="section-input">
        <div class="group-form-dynamic">
            <div class="group-input row">
                <div class="col-md-8 w-row form-group">
                    <label class="label-control">Please select a dish <i style="color:red">*</i></label>
                    <select class="form-control dishes" value="" name="dishes[0]" id="exampleFormControlSelect1">
                    </select>
                    <p class="show-error validate-step3 dishes-0"></p>
                </div>
                <div class="col-md-4 w-row form-group">
                    <label class="label-control">Quantity <i style="color:red">*</i></label>
                    <input type="number" min="0" name="quantities[0]" class="form-control">
                    <div class="show-error validate-step3 quantities-0"></div>
                </div>
            </div>
        </div>
        <div class="btn-dynamic">
            <p id="add-prescription" class="btn-add">+</p>
            <p id="remove-prescription" class="btn-dele">-</p>
        </div>
    </section>
    <ul class="step-button">
        <li><button type="button" class="default-btn prev-step">Back</button>
        </li>
        <li><button type="button" class="default-btn next-step submit-form">Continue</button>
        </li>
    </ul>
</div>
<script src="{{ asset('js/dynamic-input.js') }}"></script>
