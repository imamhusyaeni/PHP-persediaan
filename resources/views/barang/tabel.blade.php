<style>
  .loader {
    width: 200px;
    position: absolute;
    top: 250px;
    left: 400px;
    z-index: -1;
    display: none;
  }
</style>
<img src="/assets/loader.gif" class="loader">

<table class="table table-hover">
  <tr>
    <th class="col-md-1">No.</th>
    <th class="col-md-2">Nama Barang</th>
    <th class="col-md-2">Brand</th>
    <th class="col-md-2">Pemasok</th>				
    <th class="col-md-1">Jumlah</th>
    <th class="col-md-2">Tanggal Masuk</th>
    <th class="col-md-2">Aksi</th>
  </tr>

  @foreach ($barang as $b)
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $b->nama_b }}</td>
    <td >{{ $b->brand }}</td>
    <td>{{ $b->pemasok }}</td>
    <td>{{ $b->jumlah }}</td>
    <td>{{ \Carbon\Carbon::parse($b->tgl_m)->format('d-m-Y')}}</td>
    <td>
      <a href="/barang/{{ $b->id_b }}/edit" class="btn btn-warning">Ubah</a>
      <form action="/barang/{{ $b->id_b }}" method="post" style="display: inline">
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger" onclick="return confirm ('Anda yakin?');">Hapus</button>
      </form>
    </td>
  </tr>		
  @endforeach
</table>

<style>
  .pagination {
    float: left;
  }
</style>
{{ $barang->links() }}
