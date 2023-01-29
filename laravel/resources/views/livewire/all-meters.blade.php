<div>
    <div class="form-group mb-3">
        <input type="text" class="form-control" wire:model="search" placeholder="Search...">
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>
                <a href="#" wire:click.prevent="sortBy('id')">ID</a>
                @if ($sortField === 'id')
                    @if ($sortAsc)
                        <i class="fa fa-sort-asc"></i>
                    @else
                        <i class="fa fa-sort-desc"></i>
                    @endif
                @endif
            </th>
            <th>
                <a href="#" wire:click.prevent="sortBy('type')">Type</a>
                @if ($sortField === 'type')
                    @if ($sortAsc)
                        <i class="fa fa-sort-asc"></i>
                    @else
                        <i class="fa fa-sort-desc"></i>
                    @endif
                @endif
            </th>
            <th>
                <a href="#" wire:click.prevent="sortBy('mpxn')">MPXN</a>
                @if ($sortField === 'mpxn')
                    @if ($sortAsc)
                        <i class="fa fa-sort-asc"></i>
                    @else
                        <i class="fa fa-sort-desc"></i>
                    @endif
                @endif
            </th>
            <th>
                <a href="#" wire:click.prevent="sortBy('customer_name')">Customer Name</a>
                @if ($sortField === 'customer_name')
                    @if ($sortAsc)
                        <i class="fa fa-sort-asc"></i>
                    @else
                        <i class="fa fa-sort-desc"></i>
                    @endif
                @endif
            </th>
            <th>
                <a href="#" wire:click.prevent="sortBy('installation_date')">Installation Date</a>
                @if ($sortField === 'installation_date')
                    @if ($sortAsc)
                        <i class="fa fa-sort-asc"></i>
                    @else
                        <i class="fa fa-sort-desc"></i>
                    @endif
                @endif
            </th>
            <th>
                <a href="#" wire:click.prevent="sortBy('number_of_readings')">No. of Readings</a>
                @if ($sortField === 'number_of_readings')
                    @if ($sortAsc)
                        <i class="fa fa-sort-asc"></i>
                    @else
                        <i class="fa fa-sort-desc"></i>
                    @endif
                @endif
            </th>
            <th>
                <a href="#" wire:click.prevent="sortBy('last_read')">Last Read</a>
                @if ($sortField === 'last_read')
                    @if ($sortAsc)
                        <i class="fa fa-sort-asc"></i>
                    @else
                        <i class="fa fa-sort-desc"></i>
                    @endif
                @endif
            </th>
        </thead>
        <tbody>
        @foreach ($meters as $meter)
            <tr>
                <td>{{ $meter->id }}</td>
                <td>{{ $meter->type }}</td>
                <td><a href="{{ route('admin.meter.view', [$meter->id])}}">{{ $meter->mpxn }}</a></td>
                <td>{{ $meter->customer_name }}</td>
                <td>{{ $meter->installation_date }}</td>
                <td>{{ $meter->number_of_readings }}</td>
                <td>{{ $meter->last_read }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $meters->links() }}
</div>