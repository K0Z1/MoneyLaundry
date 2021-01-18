<table border="1">
	<caption>Laporan Laundry</caption>
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Invoice</th>
			<th>Nama Pelanggan</th>
			<th>Telpon Pelanggan</th>
			<th>Outlet</th>
			<th>Status</th>
			<th>Tanggal</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $laporan)
		<tr>
			<td>{{ $loop->iteration }}</td>
			<td>{{ $laporan->kode_invoice }}</td>
			<td>{{ $laporan->pelanggan->nama }}</td>
			<td>{{ $laporan->pelanggan->tlp }}</td>
			<td>{{ $laporan->outlet->nama }}</td>
			<td>{{ ucwords($laporan->status) }}</td>
			<td>{{ $laporan->tanggal() }}</td>
		</tr>
		@endforeach
	</tbody>
</table>