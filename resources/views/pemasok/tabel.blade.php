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
    <th class="col-md-3">Nama Pemasok</th>
    <th class="col-md-3">Alamat</th>				
    <th class="col-md-2">No Telpon</th>
    <th class="col-md-3">Action</th>
  </tr>

    @foreach ($pemasok as $b)
  <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $b->nama_p }}</td>
    <td>{{ $b->alamat }}</td>
    <td>{{ $b->no_telpon }}</td>
    <td>
      <a href="/pemasok/{{ $b->id_p }}/edit" class="btn btn-warning">Ubah</a>
      <form action="/pemasok/{{ $b->id_p }}" method="post" style="display: inline">
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

{{ $pemasok->links() }}