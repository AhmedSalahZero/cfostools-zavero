<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

                <select name="sales_discounts_fields[]" required class="js-example-basic-single"
                    id="sales_discounts_fields"  >
                    @foreach ($data as $val)

                    <option value="{{$val}}">{{ $val }}</option>
                    @endforeach

                </select>

<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
