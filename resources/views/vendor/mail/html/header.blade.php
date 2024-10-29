@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Biocyklus')
<img src="https://w7.pngwing.com/pngs/835/727/png-transparent-recycling-symbol-recycling-bin-computer-recycling-logo-recycle-angle-triangle-recycling-thumbnail.png" class="logo" alt="Biocyklus Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
