<form action="{{ url($name. '/'. $id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-outline-danger w-50" id="delete" onclick="return confirm('本当に削除して宜しいですか？');">
        削除
    </button>
</form>
