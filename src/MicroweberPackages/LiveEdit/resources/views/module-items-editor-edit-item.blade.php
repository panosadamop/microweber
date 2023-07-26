<div>


    <?php

    $backButtonIconSvg = '';
    if (isset($editorSettings['config']['backButtonIconSvg'])) {
        $backButtonIconSvg = $editorSettings['config']['backButtonIconSvg'];
    }
    ?>

    <form wire:submit.prevent="submit" >

        <div class="d-flex align-items-center justify-content-between">
            <x-microweber-ui::button-back  x-on:click="showEditTab = 'main'">
                {!!$backButtonIconSvg!!}
            </x-microweber-ui::button-back>

            <div class="me-3">
                <x-microweber-ui::button-animation  type="submit">@lang('Save')</x-microweber-ui::button-animation>

            </div>
        </div>


        @if (isset($editorSettings['schema']))
            @foreach ($editorSettings['schema'] as $field)
                <div class="form-group">
                    <label class="live-edit-label" for="{{ $field['name'] }}">{{ $field['label'] }}</label>

                    @php
                        $placeholder = '';

                        if(isset($field['placeholder'])){
                            $placeholder = $field['placeholder'];
                        }
                    @endphp

                    @if($field['type'] == 'text' )
                        <x-microweber-ui::input placeholder="{{ $placeholder }}" wire:model.defer="itemState.{{ $field['name'] }}"/>

                    @elseif($field['type'] == 'textarea' )
                        <x-microweber-ui::textarea placeholder="{{ $placeholder }}" wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'image' )
                        <x-microweber-ui::media-picker wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'file' )
                        <x-microweber-ui::file-picker wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'select' )
                        <x-microweber-ui::select wire:model.defer="itemState.{{ $field['name'] }}">
                            @foreach ($field['options'] as $option)
                                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                            @endforeach
                        </x-microweber-ui::select>
                    @elseif($field['type'] == 'checkbox' )
                        <x-microweber-ui::checkbox wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'radio' )
                        <x-microweber-ui::radio wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'color' )
                        <x-microweber-ui::color-picker wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'date' )
                        <x-microweber-ui::date wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'datetime' )
                        <x-microweber-ui::datetime wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'range' )
                        <x-microweber-ui::range-slider wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'time' )
                        <x-microweber-ui::time wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'url' )
                        <x-microweber-ui::link-picker wire:model.defer="itemState.{{ $field['name'] }}"/>
                    @elseif($field['type'] == 'info' )
                        <x-microweber-ui::alert type="info"> {{ $field['help'] }} </x-microweber-ui::alert>
                    @else
                    <x-microweber-ui::input placeholder="{{ $placeholder }}" wire:model.defer="itemState.{{ $field['name'] }}"/>

                    @endif

                    @error($field['name']) <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            @endforeach
        @endif

            <div class="d-flex align-items-center justify-content-between">
                <x-microweber-ui::button-animation x-on:click="showEditTab = 'main'" type="button">@lang('Cancel')</x-microweber-ui::button-animation>
                <x-microweber-ui::button-animation type="submit">@lang('Save')</x-microweber-ui::button-animation>
            </div>
    </form>



</div>