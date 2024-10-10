<form action="{{ route($settings['route'].'.destroy',$data->id) }}" method="POST" class="delete-data" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
  @csrf
  <input type="hidden" name="_method" value="DELETE">
  <td>
    @if (@$settings['ubah'] || !isset($settings['ubah']))
    <a type="button" class="btn btn-outline-warning btn-sm" href="{{ route($settings['route'].'.edit',$data->id) }}" > Edit</a>
    @endif
    @if (@$settings['hapus'] || !isset($settings['hapus']))
      <button type="submit" class="m-2 btn btn-outline-danger btn-sm"> Hapus</button>
    @endif
  </td>
</form>