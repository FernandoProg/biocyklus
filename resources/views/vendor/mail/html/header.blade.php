@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('storage/images/static/logo.jpg') }}" class="logo" alt="Biocyklus Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
