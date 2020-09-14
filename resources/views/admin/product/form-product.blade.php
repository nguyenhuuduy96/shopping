<div class="modal fade" id="ModalProduct">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>

				<h4 class="modal-title" id="titleProduct">Add new Product</h4>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				
					<form class="row" id="formnewproductsubmit" class="ShowSearhProduct">
						@csrf
						<div class="col-sm-12" id="getIdproduct">

						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="usr">Name:</label>
								<input type="text" class="form-control" id="usr">
							</div>
							<div class="form-group">
								<label for="pwd">Password:</label>
								<input type="password" class="form-control" id="pwd">
							</div>
							<div class="form-group" >
								<div id="product_id">

								</div>
								<label for="type" >Ten san pham:</label>
								<input type="hidden" class="form-control" id="rowid" placeholder="ten san pham" name="rowid" value="" >
								<input type="type" class="form-control" id="name_product" placeholder="ten san pham" name="name" >
								<span class="errorName" style="color: red"></span>
							</div>
							<div class="form-group">
								
								<label for="source">nguon:</label>
								<input type="type" class="form-control" id="source" placeholder="source" name="source" >
								<span class="errorsource" style="color: red"></span>
								
								
							</div>
							<div class="form-group">
								<label for="date">thoi gian het han:</label>
								<input type="date" class="form-control" id="date" placeholder="time_expired" name="date" >
								<span class="errortime_expired" style="color: red"></span>
							</div>
							<div class="form-group">
								<label >file image</label>
								<input type="file" name="image[]" class="form-control-file image" id="image" multiple="">
								<span class="error_image" style="color: red"></span>
							</div>
							<div class="form-group" id="getsizeup">

							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-2">
										<label>size</label>
										<select class="form-control" name="color_id[]" class="color_id"  style="width: 100%;">
											<option value="">-- chọn --</option>
										{{-- 	@foreach($sizes as $size)
											<option  
											value="{{$size->id}}">{{$size->size}}</option>
											@endforeach --}}
										</select>
									</div>
									<div class="col-md-2">

										<label>size</label>
										<select class="form-control" name="size_id[]" class="validatesize"  style="width: 100%;">
											<option value="">-- chọn --</option>
										{{-- 	@foreach($sizes as $size)
											<option  
											value="{{$size->id}}">{{$size->size}}</option>
											@endforeach --}}
										</select>
									</div>

									<div class="col-md-3">
										<label>giá</label>
										<input type="number" name="price[]" class="form-control" >
									</div>
									<div class="col-md-2">
										<label>số lượng</label>
										<input type="number" name="stock[]" class="form-control" >	                  
									</div>

									<div class="col-md-2">
										<label><a class="btn btn-outline-primary addSizePriceStock">thêm</a>  </label>

									</div>

								</div>
							</div>
							<div class="form-group" id="getsize">

							</div>

						</div>
					
						<div class="row col-sm-12" id="showImage">


						</div>

						<input type="submit" value="submit">
					</form>
				
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>