@php
    use Filament\Support\Enums\Alignment;
    use Filament\Support\Enums\VerticalAlignment;
    use Filament\Support\Facades\FilamentView;
    use Filament\Tables\Columns\Column;
    use Filament\Tables\Columns\ColumnGroup;
    use Filament\Tables\Enums\ActionsPosition;
    use Filament\Tables\Enums\FiltersLayout;
    use Filament\Tables\Enums\RecordCheckboxPosition;
    use Illuminate\Support\Str;

    $actions = $getActions();
    $flatActionsCount = count($getFlatActions());
    $actionsAlignment = $getActionsAlignment();
    $actionsPosition = $getActionsPosition();
    $actionsColumnLabel = $getActionsColumnLabel();
    $activeFiltersCount = $getActiveFiltersCount();
    $columns = $getVisibleColumns();
    $collapsibleColumnsLayout = $getCollapsibleColumnsLayout();
    $columnsLayout = $getColumnsLayout();
    $content = $getContent();
    $contentGrid = $getContentGrid();
    $contentFooter = $getContentFooter();
    $filterIndicators = $getFilterIndicators();
    $hasColumnGroups = $hasColumnGroups();
    $hasColumnsLayout = $hasColumnsLayout();
    $hasSummary = $hasSummary();
    $header = $getHeader();
    $headerActions = array_filter(
        $getHeaderActions(),
        fn(
            \Filament\Tables\Actions\Action|\Filament\Tables\Actions\BulkAction|\Filament\Tables\Actions\ActionGroup $action,
        ): bool => $action->isVisible(),
    );
    $headerActionsPosition = $getHeaderActionsPosition();
    $heading = $getHeading();
    $group = $getGrouping();
    $bulkActions = array_filter(
        $getBulkActions(),
        fn(
            \Filament\Tables\Actions\BulkAction|\Filament\Tables\Actions\ActionGroup $action,
        ): bool => $action->isVisible(),
    );
    $groups = $getGroups();
    $description = $getDescription();
    $isGroupsOnly = $isGroupsOnly() && $group;
    $isReorderable = $isReorderable();
    $isReordering = $isReordering();
    $areGroupingSettingsVisible = !$isReordering && count($groups) && !$areGroupingSettingsHidden();
    $isGroupingDirectionSettingHidden = $isGroupingDirectionSettingHidden();
    $isColumnSearchVisible = $isSearchableByColumn();
    $isGlobalSearchVisible = $isSearchable();
    $isSearchOnBlur = $isSearchOnBlur();
    $isSelectionEnabled = $isSelectionEnabled() && !$isGroupsOnly;
    $selectsCurrentPageOnly = $selectsCurrentPageOnly();
    $recordCheckboxPosition = $getRecordCheckboxPosition();
    $isStriped = $isStriped();
    $isLoaded = $isLoaded();
    $hasFilters = $isFilterable();
    $filtersLayout = $getFiltersLayout();
    $filtersTriggerAction = $getFiltersTriggerAction();
    $hasFiltersDialog = $hasFilters && in_array($filtersLayout, [FiltersLayout::Dropdown, FiltersLayout::Modal]);
    $hasFiltersAboveContent =
        $hasFilters && in_array($filtersLayout, [FiltersLayout::AboveContent, FiltersLayout::AboveContentCollapsible]);
    $hasFiltersAboveContentCollapsible = $hasFilters && $filtersLayout === FiltersLayout::AboveContentCollapsible;
    $hasFiltersBelowContent = $hasFilters && $filtersLayout === FiltersLayout::BelowContent;
    $hasColumnToggleDropdown = $hasToggleableColumns();
    $hasHeader =
        $header ||
        $heading ||
        $description ||
        ($headerActions && !$isReordering) ||
        $isReorderable ||
        $areGroupingSettingsVisible ||
        $isGlobalSearchVisible ||
        $hasFilters ||
        count($filterIndicators) ||
        $hasColumnToggleDropdown;
    $hasHeaderToolbar =
        $isReorderable ||
        $areGroupingSettingsVisible ||
        $isGlobalSearchVisible ||
        $hasFiltersDialog ||
        $hasColumnToggleDropdown;
    $pluralModelLabel = $getPluralModelLabel();
    $records = $isLoaded ? $getRecords() : null;
    $searchDebounce = $getSearchDebounce();
    $allSelectableRecordsCount = $isSelectionEnabled && $isLoaded ? $getAllSelectableRecordsCount() : null;
    $columnsCount = count($columns);
    $reorderRecordsTriggerAction = $getReorderRecordsTriggerAction($isReordering);
    $toggleColumnsTriggerAction = $getToggleColumnsTriggerAction();
    $page = $this->getTablePage();
    $defaultSortOptionLabel = $getDefaultSortOptionLabel();

    if (count($actions) && !$isReordering) {
        $columnsCount++;
    }

    if ($isSelectionEnabled || $isReordering) {
        $columnsCount++;
    }

    if ($group) {
        $groupedSummarySelectedState = $this->getTableSummarySelectedState(
            $this->getAllTableSummaryQuery(),
            modifyQueryUsing: fn(\Illuminate\Database\Query\Builder $query) => $group->groupQuery(
                $query,
                model: $getQuery()->getModel(),
            ),
        );
    }

    $getHiddenClasses = function (Column|ColumnGroup $column): ?string {
        if ($breakpoint = $column->getHiddenFrom()) {
            return match ($breakpoint) {
                'sm' => 'sm:hidden',
                'md' => 'md:hidden',
                'lg' => 'lg:hidden',
                'xl' => 'xl:hidden',
                '2xl' => '2xl:hidden',
            };
        }

        if ($breakpoint = $column->getVisibleFrom()) {
            return match ($breakpoint) {
                'sm' => 'hidden sm:table-cell',
                'md' => 'hidden md:table-cell',
                'lg' => 'hidden lg:table-cell',
                'xl' => 'hidden xl:table-cell',
                '2xl' => 'hidden 2xl:table-cell',
            };
        }

        return null;
    };
@endphp

<x-filament-tables::container>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\Tables\View\TablesRenderHook::HEADER_BEFORE, scopes: static::class) }}
                <h3 class="card-title">{{ $heading }} - <code>{{ $description }}</code></h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search Mail">
                        <div class="input-group-append">
                            <div class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\Tables\View\TablesRenderHook::HEADER_AFTER, scopes: static::class) }}
            </div>
            <div class="card-body p-0">

                {{--  --}}
                <div class="mailbox-controls">
                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-reply"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-share"></i>
                        </button>
                    </div>
                    <button type="button" class="btn btn-default btn-sm">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <div class="float-right">
                        1-50/200
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-sm">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Table --}}

                @if (($content || $hasColumnsLayout) && $records !== null && count($records))

                    {{-- isReordering --}}

                    {{-- Konten --}}
                    @if ($content)
                        {{ $content->with(['records' => $records]) }}
                    @else
                        @php
                            $previousRecord = null;
                            $previousRecordGroupKey = null;
                            $previousRecordGroupTitle = null;
                        @endphp

                        @foreach ($records as $record)
                            @php
                                $recordAction = $getRecordAction($record);
                                $recordKey = $getRecordKey($record);
                                $recordUrl = $getRecordUrl($record);
                                $openRecordUrlInNewTab = $shouldOpenRecordUrlInNewTab($record);
                                $recordGroupKey = $group?->getStringKey($record);
                                $recordGroupTitle = $group?->getTitle($record);

                                $collapsibleColumnsLayout?->record($record);
                                $hasCollapsibleColumnsLayout = (bool) $collapsibleColumnsLayout?->isVisible();
                            @endphp

                            <x-filament-tables::table :reorderable="$isReorderable" :reorder-animation-duration="$getReorderAnimationDuration()">
                                <x-slot name="header">
                                    @foreach ($columns as $column)
                                        <th>{{ $column->getLabel() }}</th>
                                    @endforeach
                                </x-slot>

                                @php
                                    $previousRecordGroupKey = $recordGroupKey;
                                    $previousRecordGroupTitle = $recordGroupTitle;
                                    $previousRecord = $record;
                                @endphp
                            </x-filament-tables::table>

                            {{--  --}}
                            
                            @if ($isColumnSearchVisible)
                            @endif
                        @endforeach
                    @endif
                @elseif ($records !== null && count($records))
                    ready
                @elseif ($records === null)
                    null
                @elseif ($emptyState = $getEmptyState())
                    {{ $emptyState }}
                @else
                    <tr>
                        <td colspan="{{ $columnsCount }}">
                            <x-filament-tables::empty-state :actions="$getEmptyStateActions()" :description="$getEmptyStateDescription()" :heading="$getEmptyStateHeading()"
                                :icon="$getEmptyStateIcon()" />
                        </td>
                    </tr>
                @endif


                {{-- Modal Aksi --}}
                <x-filament-actions::modals />
            </div>
        </div>

    </div>
</x-filament-tables::container>
