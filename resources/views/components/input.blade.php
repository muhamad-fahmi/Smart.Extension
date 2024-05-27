@php
    $source_replace = [' ', '/', '.'];
    $replace = ['_', '_', '_'];
@endphp
@isset ($inputgroup)
    <div class="form-group mb-4
        @if (empty($noprops))
            {{ str_replace(' ', '-', strtolower($field)) }}
        @endif"
        {{ $parentClass ?? '' }}>
        <label for="{{ $field }}">{{ ucwords($field) }}</label>
        <div class="input-group">
            <input type="{{ $type }}" class="form-control {{ $classAdd ?? '' }}" id="{{ str_replace($source_replace, $replace, strtolower($field)) }}" name="{{ strtolower(str_replace($source_replace, $replace, $field)) }}" placeholder="{{ ($type == 'search') ? 'Search' : 'Enter' }} {{ $field }}" aria-describedby="basic-addon2"
            @if (isset($value))
                value="{{ $value }}"
            @else
                value="{{ old(str_replace($source_replace, $replace, $field)) }}"
            @endif
            {{ empty($readonly) ? '' : 'readonly'}}
            {{ empty($disabled) ? '' : 'disabled'}}
            {{ empty($required) ? '' : 'required'}}
            {{ empty($max) ? '' : 'max="'.$max.'"'}}
            {{ empty($min) ? '' : 'min="'.$min.'"'}}
            {{ empty($length) ? '' : 'maxlength='.$length.''}}
            {{ empty($autocomplete) ? '' : 'autocomplete="off"'}}>
            <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2">{{ $inputgroup }}</span>
            </div>
        </div>
    </div>

@else
    <div class="form-group mb-4
        @if (empty($noprops))
            {{ str_replace(' ', '-', strtolower($field)) }}
        @endif"
        {{ $parentClass ?? '' }}>
        <label for="{{ $field }}">{{ ucwords($field) }}</label>
        <input type="{{ $type }}" class="form-control {{ $classAdd ?? '' }}" placeholder="{{ ($type == 'search') ? 'Search' : 'Enter' }} {{ $field }}"
        @if (empty($noprops))
            id="{{ str_replace($source_replace, $replace, strtolower($field)) }}" name="{{ strtolower(str_replace($source_replace, $replace, $field)) }}"
        @endif
        @if (isset($value))
            value="{{ $value }}"
        @else
            value="{{ old(str_replace($source_replace, $replace, $field)) }}"
        @endif
        {{ empty($readonly) ? '' : 'readonly'}}
        {{ empty($disabled) ? '' : 'disabled'}}
        {{ empty($required) ? '' : 'required'}}
        {{ empty($max) ? '' : 'max="'.$max.'"'}}
        {{ empty($min) ? '' : 'min="'.$min.'"'}}
        {{ empty($length) ? '' : 'maxlength='.$length.''}}
        {{ empty($autocomplete) ? '' : 'autocomplete="off"'}}>
    </div>
@endif
