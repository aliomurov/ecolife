@if(!empty($categoryproducts))
    @foreach($categoryproducts as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif
