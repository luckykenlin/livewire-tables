<div class="space-y-2">
    <label for="">{{$column->name}}</label>
    <input
        wire:model="{{"dateFilters.$column->attribute"}}"
        class="w-full bg-white h-10 px-5 pr-16 text-sm rounded-md border-2 border-gray-300 focus:outline-none focus:ring-0 focus:ring-gray-600 focus:border-gray-600"
        value=""
        readonly
        placeholder="Choose date range"
        type="text" x-data x-init="init($el)"
        onchange="this.dispatchEvent(new InputEvent('input'))"
    >
</div>

@push('head')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        function init(el) {
            $(el).daterangepicker({autoUpdateInput: false})

            $(el).on('apply.daterangepicker', function (ev, picker) {
                this.dispatchEvent(new InputEvent('input'))
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
            });
        }
    </script>
@endpush
