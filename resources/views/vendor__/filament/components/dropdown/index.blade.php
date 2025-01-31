@props([
    'availableHeight' => null,
    'availableWidth' => null,
    'flip' => true,
    'maxHeight' => null,
    'offset' => 8,
    'placement' => null,
    'shift' => false,
    'size' => false,
    'sizePadding' => 16,
    'teleport' => false,
    'trigger' => null,
    'width' => null,
])

@php
    use Filament\Support\Enums\MaxWidth;

    $sizeConfig = collect([
        'availableHeight' => $availableHeight,
        'availableWidth' => $availableWidth,
        'padding' => $sizePadding,
    ])
        ->filter()
        ->toJson();
@endphp

<div class="btn-group">
    <button type="button" class="btn  dropdown-toggle btn-sm btn-primary" data-toggle="dropdown">
        {{-- <i class="fas fa-wrench"></i> --}}
        Aksi
    </button>
    <div class="dropdown-menu dropdown-menu-leaf" role="menu">
        {{-- <a href="#" class="dropdown-item">Action</a>
        <a href="#" class="dropdown-item">Another action</a>
        <a href="#" class="dropdown-item">Something else here</a>
        <a class="dropdown-divider"></a>
        <a href="#" class="dropdown-item">Separated link</a> --}}

        {{ $slot }}

    </div>
</div>
