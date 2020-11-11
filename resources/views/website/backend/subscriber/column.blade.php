<div class="btn-toolbar">
	<form  action="{!! $deleteUrl !!}" method="POST">
		<input type="hidden" name="_method" value="delete">
		@method('DELETE')
		@csrf                                              
			<button class="btn btn-danger btn-sm" onclick="return confirm('Are You sure want to delete !')">Delete</button>
	</form>	
</div>