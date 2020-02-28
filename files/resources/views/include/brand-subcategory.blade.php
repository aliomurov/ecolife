<br>
<hr>
<div class="tags">
    <p class="lead">Брернды</p>
    @foreach($brands as $brand)
        <a href="{{route('pages.subcategory', [$category->slug, $subcategory->slug, 'categoryproduct'=>request()->categoryproduct, 'brand' => $brand->slug])}}">
            <span class="badge badge-light {{ request()->brand == $brand->slug ? 'active-brand' : ''}}">
                {{$brand->name}}
            </span>
        </a>
    @endforeach
</div>
