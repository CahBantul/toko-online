<div class="container">
    @if(Auth::user())
        @if(Auth::user()->level === 1)
            <div class="col-md-3">
                <a href="{{ url('tambah-produk/') }}" class="btn btn-success btn-block">Tambah Produk</a>
            </div>
        @endif
    @endif
</div>