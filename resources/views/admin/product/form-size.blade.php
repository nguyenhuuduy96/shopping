<div class="modal fade" id="AddNewSize" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<form method="post" id="submitSize">
					@csrf
					<div class="modal-header">
						<h4 class="modal-title title-size">Thêm mới một size</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>

					</div>
					<div class="modal-body inputsize">
						<div class="id_size_hidden">

						</div>
						<input type="hidden" name="row_id_size" id="row_id_size" value="">
						<input class="newSize" name="size" id="name_size">
						<input type="submit" value="submit" class="btn btn-info"><br>
						<span class="text-danger errorsSize"></span>
						<span class="text-success successSize"></span>
					</div>
					<div class="modal-footer">

						<button type="button" class="btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>

			</div>

		</div>
	</div>