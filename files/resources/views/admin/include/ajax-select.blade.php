@if(!empty($subcategories))
    <option value="">Выберите пункт</option>
    @foreach($subcategories as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif


@if(!empty($categoryproducts))
    <option value="">Выберите пункт</option>
    @foreach($categoryproducts as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif
