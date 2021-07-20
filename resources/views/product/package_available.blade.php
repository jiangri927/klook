@foreach ($package as $index => $item)

    <button class=" {{ $item->available_on ? 'package-type':'disable-package' }}" data-id="{{ $item->id }}  ">{{ $item->title }}
        
        @if (!$item->available_on )
            <p>Not available on your selected date</p>
        @endif

    </button>
@endforeach
