<div class="btn-toolbar">
	<form  action="{!! $statusPendingUrl !!}" method="POST">
		<input type="hidden" name="_method" value="delete">
		@csrf                                              
		@method('PUT')
			<button class="" onclick="return confirm('Are You sure want to Published !')"><span class="badge bg-pink">Pending..</span></button>
	</form>	
</div>

