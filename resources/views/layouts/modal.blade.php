{{-- START OF  MODAL --}}
<div id="{{ $id }}" class="modal fade" data-backdrop="false" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			{{ $title }}
			<div class="modal-body">
				{{ $body }}
			</div>
			<div class="modal-footer">
				{{ $footer }}
			</div>
	        </form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
{{-- END OF MODAL --}}