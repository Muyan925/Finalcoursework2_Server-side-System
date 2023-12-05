<form action="{{ route('uploads.destroy', $upload->id) }}" method="POST">
    @csrf
    @method('DELETE')

    <!-- 这里添加您的表单字段和提交按钮 -->

    <button type="submit">Delete</button>
</form>
