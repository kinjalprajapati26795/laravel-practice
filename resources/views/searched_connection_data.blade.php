@forelse($connectionData as $key=>$value)
<tr>
	<td>{{ $value->first_name }} {{ $value->last_name }}</td>
	<td>{{ $value->email }}</td>
	<td>{{ $value->first_name }} {{ $value->last_name }}</td>
</tr>
@empty
@endforelse