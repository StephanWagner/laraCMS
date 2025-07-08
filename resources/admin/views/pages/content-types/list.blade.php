@extends('admin::app')

@section('content')
    <div style="padding: 16px 24px">Content Types: List</div>

<table class="list-table">
    <thead>
        <tr>
            @foreach ($listConfig['columns'] as $col)
                <th>{{ $col['label'] ?? '' }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            <tr>
                @foreach ($listConfig['columns'] as $col)
                    <td>
                        @php
                            $value = data_get($item, $col['source'] ?? $col['key']);
                        @endphp

                        @if ($col['type'] === 'datetime')
                            {{ \Carbon\Carbon::parse($value)->format('Y-m-d H:i') }}
                        @elseif ($col['type'] === 'username')
                            {{ \App\Models\User::find($value)?->name ?? '–' }}
                        @else
                            {{ $value }}
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

{{ $items->links() }}


    <div class="list__wrapper" data-endpoint="/admin/api/content-types"></div>
@endsection
