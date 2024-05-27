<div class="form-group {{ $parentClass ?? '' }}">
    <label for="{{ $field }}">{{ ucwords($field) }}</label>
    <select class="form-control {{ $classAdd ?? '' }} select2" name="{{ strtolower(str_replace(' ', '_', $field)) }}" id="{{ strtolower(str_replace(' ', '_', $field)) }}"
    {{ empty($required) ? '' : 'required'}}
    {{ empty($readonly) ? '' : 'readonly'}}
    {{ empty($disabled) ? '' : 'disabled'}}>
        @if (empty($selectdata))
            <option>Empty Select Data</option>
        @else
            @php
                $values = empty($values) ? explode(',', strtolower($selectdata)) : explode(',', $values);
                $selectdata = explode(',', $selectdata);
                $index = 0;
            @endphp
            <option value="" selected>Pilih {{ ucwords($field) }}</option>
            @foreach ($selectdata as $data)
                <option value="{{ str_replace(' ', '', $values[$index]) }}">{{ $data }}</option>
                @php
                    $index++;
                @endphp
            @endforeach
        @endif
    </select>
</div>
