@if($user->roles != "admin")
<form action="{{ route('users.destroy', $user->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <a class="btn btn-sm btn-info" href="{{ route('users.show', $user->id) }}">Detail</a>
    <a class="btn btn-sm btn-primary" href="{{ route('users.edit', $user->id) }}">Ubah</a>
    <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
</form>
@endif