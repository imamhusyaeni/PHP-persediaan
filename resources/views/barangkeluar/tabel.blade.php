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
		<th class="col-md-1">No</th>
		<th class="col-md-3">Nama Barang</th>
		<th class="col-md-2">Jumlah Keluar</th>
		<th class="col-md-2">Keterangan</th>			
		<th class="col-md-2">Tanggal Keluar</th>		
		<th class="col-md-2">Aksi</th>
	</tr>

	@foreach ($barangkeluar as $b)			
	<tr>
		<td>{{ $loop->iteration }}</td>
		<td>{{ $b->nama_bk }}</td>
		<td>{{ $b->jumlah }}</td>
		<td>{{ $b->keterangan }}</td>			
		<td>{{ \Carbon\Carbon::parse($b->tgl_k)->format('d-m-Y')}}</td>			
		<td>
			<form action="/barangkeluar/{{ $b->id_bk }}" method="post" style="display: inline">
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

{{ $barangkeluar->links() }}