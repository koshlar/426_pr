@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Catalog</h1>
        @if (auth()->user()->role_id == 3)
            <a href="{{ route('products.create') }}" class="button">Create product</a>
        @endif
        @component('components.inputs.InputContainer', ['name' => 'product_category_id'])
            <select name="product_category_id" id="pci">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(isset($_GET['pci']) && $_GET['pci'] == $category->id)>{{ $category->name }}</option>
                @endforeach
                <script>
                    const select = document.querySelector('#pci');
                    select.onclick = () => {
                        const url = new URL(document.location.href);
                        document.location.href = url.searchParams.set('pci', select.value).toString();
                    }
                </script>
            </select>
        @endcomponent
        <div class="catalog__wrapper">
            @forelse ($products as $product)
                @include('components.ProductCard', ['product' => $product])
            @empty
                <p>No products</p>
            @endforelse
        </div>
    </div>
@endsection
