<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container">
		<center>
			<h4>Membuat Laporan PDF Dengan DOMPDF Laravel</h4>
		</center>
		<br/>
		<table class='table table-bordered ' style="margin-right: 55px">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul</th>
					<th>Category</th>
					<th>Content</th>
					<th>Slug</th>
				</tr>
			</thead>
			<tbody>
				@php $i=1 @endphp
				@foreach($post as $p)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{$p->judul}}</td>
					<td>{{$p->category_id}}</td>
					<td>{{$p->content}}</td>
					<td>{{$p->slug}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</div>

</body>
</html>