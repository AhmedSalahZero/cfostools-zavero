        <form  class="kt-form kt-form--label-right" method="{{ $method ?? 'POST' }}"  enctype="multipart/form-data"  action="{{  isset($model) ? $updateRoute : $storeRoute  }}" >
        @csrf 
        <label class="form-label">{{ __('Customer / Lead Name') }}</label>
        <input type="text" name="customer_name" class="form-control mb-3" placeholder="{{ __('Please Enter Customer Or Lead Name') }}">
        <label class="form-label">{{ __('Customer Or Lead ? ') }}</label>
        <select name="customer_type" class="form-control">
            @foreach($customerTypes as $customerType)
                <option class="{{ $customerType }}" > {{ $customerType }} </option>
            @endforeach
        </select>
        </form>