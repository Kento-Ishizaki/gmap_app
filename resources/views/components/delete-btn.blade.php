<form action="{{ url($name. '/'. $id) }}" method="post">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-outline-danger w-50" id="delete" onclick="return confirm('本当に削除して宜しいですか？');">
  削除
</button>
</form>

<script>
// 'use strict';
// var dltBtn = document.getElementById('delete');
// dltBtn.addEventListener('click', function() {
//   var result = confirm('本当に削除して宜しいですか？');
//   if(result) {
//   } else {
//     return false;
//   }
// });
</script>