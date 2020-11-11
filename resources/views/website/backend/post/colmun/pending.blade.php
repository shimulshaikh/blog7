
<div class="btn-toolbar">
	<form  action="{!! $pendingUrl !!}" method="POST">
		@csrf                                              
		@method('PUT')
			<button class="" onclick="return confirm('Are You sure want to Approve !')"><span class="badge bg-pink">Pending..</span></button>
	</form>	
</div>