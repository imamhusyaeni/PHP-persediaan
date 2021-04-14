@extends('layout/main')

@section('title', 'Dashboard')

@section('content')

<div class="col-md-12">
  <script src="/assets/js/jquery.min.js"></script>
  <script src="/assets/js/highcharts.js"></script>
	<script src="/assets/js/data.js"></script>
	<script src="/assets/js/exporting.js"></script>
	<script src="/assets/js/export-data.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<style>
th{
    text-align:center!important;
}
</style>
    
<table class="table table-hover table-bordered table-striped" style="width:100%; text-align:center" id="datatable">
  <thead style="background-color:#17ba9c; color:white" >
    <tr >
      <th>Nama Barang</th>
      <th>Stok Awal</th>
      <th>Barang Keluar</th>
      <th>Stok Akhir</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($barang as $b)
    <tr>
      <th>{{ $b->nama_b }}</th>
      <td>{{ $b->jumlah + $b->brg_keluar }}</td>
      <td><?php if(empty($b->brg_keluar)){echo '0';}else{echo $b->brg_keluar;} ?> </td>
      <td>{{ $b->jumlah }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

<script type="text/javascript">
	Highcharts.chart('container', {
    data: {
        table: 'datatable'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Stok Awal - Barang Keluar - Stok Akhir'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Jumlah'
        }
    },
    tooltip: {
        formatter: function () {
            return '<b>' + this.series.name + '</b><br/>' +
                this.point.y + ' ' + this.point.name.toLowerCase();
        }
    }
});
</script>
@endsection