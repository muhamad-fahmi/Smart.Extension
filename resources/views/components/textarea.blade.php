<div class="form-group mb-4">
    <label for="{{ $field }}">{{ ucwords($field) }}</label>
    <textarea class="form-control {{ $classAdd ?? '' }}" placeholder="Enter {{ $field }}" name="{{ strtolower(str_replace(' ', '_', $field)) }}" rows="{{ $row ?? 3 }}">@isset($value){{ $value }}@else{{ old(str_replace(' ', '', $field)) }}@endisset</textarea>
</div>
