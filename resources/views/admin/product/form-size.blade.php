	<div class="modal fade" id="modalTableSize" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Table Sizes</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<!--Body-->
			<div class="modal-body">

				<table class="table table-hover" id="TableSize">
					<thead>
						<tr>
							<th>#</th>
							<th>Size</th>
							<th>Remove</th>
							<th><a class="btn btn-outline-primary restformsize" data-toggle="modal" data-target="#AddNewSize">add new size</a></th>
						</tr>
					</thead>
					<tbody class="table_size">
						@foreach($sizes as $size)
						<tr>
							<th scope="row">{{$size->id}}</th>
							<td>{{$size->size}}</td>

							<td><a class="btn btn-danger" onclick="tabledeleteSize(this,{{$size->id}})">delete</a></td>
							<td><a data-toggle="modal" data-target="#AddNewSize" class="btn btn-primary" onclick="tableGetSize(this,{{$size->id}})">update</a></td>
						</tr>
						@endforeach

					</tbody>
				</table>

			</div>
			<!--Footer-->
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>

			</div>
		</div>
	</div>
</div>
<!--Modal form Size-->
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