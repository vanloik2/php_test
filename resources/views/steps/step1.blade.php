<div class="tab-pane active" role="tabpanel" id="step1">
    <div class="section-input">
        <div class="form-group">
            <label class="label-control">Please select a meal <i style="color:red">*</i></label>
            <select class="form-control" name="meal" id="exampleFormControlSelect1">
                <option value="">Please selected meal !!!</option>
                @foreach ($meals as $item)
                    <option value="{{ $item }}">{{ mb_convert_case($item, MB_CASE_TITLE) }}</option>
                @endforeach
            </select>
            <p class="meal-error show-error"></p>
        </div>
        <div class="form-group">
            <label class="label-control">Please enter number of people <i style="color:red">*</i></label>
            <input type="number" min="1" max="10" name="amount_people" class="form-control">
            <p class="amount-people-error show-error"></p>
        </div>
    </div>
    <ul class="list-inline pull-right">
        <li><button type="button" class="default-btn next-step btn-step-1">Continue to next step</button></li>
    </ul>
</div>
