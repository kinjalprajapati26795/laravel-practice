@forelse($connectionData as $key=>$value)
<tr>
	
	<td>{{ $value->first_name }} {{ $value->last_name }}</td>
	<td>{{ $value->email }}</td>
	<td>{{ $value->phone }}</td>
	<td>{{ implode(",", $value->technology()->pluck('technology')->toArray()) }}</td>
	<td>{{ $value->first_name }} {{ $value->last_name }}</td>
</tr>
@empty
@endforelse