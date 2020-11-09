<div class="btn-toolbar">
	<a href="{!! $editUrl !!}" class="btn btn-info btn-sm" role="button" aria-pressed="true" style="margin-right: 4px;"><i class="far fa-edit"></i>Edit</a>

	<form  action="{!! $deleteUrl !!}" method="POST">
		<input type="hidden" name="_method" value="delete">
		@method('DELETE')
		@csrf                                              
			<button class="btn btn-danger btn-sm" onclick="return confirm('Are You sure want to delete !')">Delete</button>
	</form>	
</div>