<div class="modal fade" id="modalcategory" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<form method="post" id="SubmitFormCategory" action="javascript:void(0)">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title title-cate">Thêm mới một category</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>
				<div class="modal-body inputsize">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Category</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="name" name="name" placeholder="Category" value="">
							<span class="text-danger" id="error"></span>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Parent category</label>
						<div class="col-sm-9">
							<select class="form-control" id="allsize" name="parent_id">
								<option value="">- chon -</option>
							</select>
						</div>
					</div>
					<input type="hidden" name="row_id_cate" id="row_id_cate" value="">
					<input type="hidden" name="id" id="id" value="">
					<div class="form-group">
						<input type="submit" value="submit" class="btn btn-info">
					</div>
					
					
					{{-- <span class="text-success successSize"></span> --}}
				</div>
				<div class="modal-footer">

					<button type="button" class="btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>

		</div>

	</div>
</div>