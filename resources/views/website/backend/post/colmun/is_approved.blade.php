
<div class="btn-toolbar">
	<form  action="{!! $is_approvedUrl !!}" method="POST">
		<input type="hidden" name="_method" value="delete">
		@csrf                                              
		@method('PUT')
			<button class="" onclick="return confirm('Are You sure want to Approve !')" disabled><span class="badge bg-blue">Approved</span></button>
	</form>	
</div>	