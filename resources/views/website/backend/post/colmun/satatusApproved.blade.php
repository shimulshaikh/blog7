<div class="btn-toolbar">
	<form  action="{!! $statusApproveUrl !!}" method="POST">
		<input type="hidden" name="_method" value="delete">
		@csrf                                              
		@method('PUT')
			<button class="" onclick="return confirm('Are You sure want to Pending !')"><span class="badge bg-blue">Published</span></button>
	</form>	
</div>	
