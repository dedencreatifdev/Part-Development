@props([
    'inlinePrefix' => false,
    'inlineSuffix' => false,
])

<input
    {{
        $attributes->class([
            'form-control form-control-sm',
            // A fully transparent white background color is used
            // instead of transparent to fix a Safari bug
            // where the date/time input "placeholder" colors too dark.
            //
            // https://github.com/filamentphp/filament/issues/7087
            // 'bg-white/0',
            // 'ps-0' => $inlinePrefix,
            // 'ps-3' => ! $inlinePrefix,
            // 'pe-0' => $inlineSuffix,
            // 'pe-3' => ! $inlineSuffix,
        ])
    }}
/>
