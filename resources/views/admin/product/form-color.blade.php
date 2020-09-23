	<div class="modal fade" id="modalTableColor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<!--Header-->
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Table Color</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<!--Body-->
			<div class="modal-body">

				<table class="table table-hover" id="TableColor">
					<thead>
						<tr>
							<th>#</th>
							<th>Size</th>
							<th>Remove</th>
							<th><a class="btn btn-outline-primary restformsize" data-toggle="modal" data-target="#FormColor">add new color</a></th>
						</tr>
					</thead>
					<tbody class="table_color">
						@foreach($colors as $color)
						<tr>
							<th scope="row">{{$color->id}}</th>
							<td>{{$color->name}}</td>

							<td><a class="btn btn-danger" onclick="tabledeleteColor(this,{{$color->id}})">delete</a></td>
							<td><a data-toggle="modal" data-target="#FormColor" class="btn btn-primary" onclick="tableGetColor(this,{{$color->id}})">update</a></td>
						</tr>
						@endforeach

					</tbody>
				</table>
				<div id="myDIV">
					<button class="btn btn-light pre" ><</button>
				  <button class="btn btn-light  page_color" value="1">1</button>
				  <button class="btn btn-light  page_color active" value="2">2</button>
				  <button class="btn btn-light page_color" value="3">3</button>
				  <button class="btn btn-light page_color" value="4">4</button>
				  <button class="btn btn-light page_color" value="5">5</button>
				</div>
			</div>
			<!--Footer-->
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>

			</div>
		</div>
	</div>
</div>
<!--Modal form Size-->
<div class="modal fade" id="FormColor" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<form method="post" id="submitColor" action="javascript:void(0)">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title title-color">Thêm mới một color</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>
				<div class="modal-body inputsize">
					<input type="hidden" name="id_color" id="id_color" value="">
					<input type="hidden" name="row_id_size" id="row_id_color" value="">
					<input class="newSize" name="name_color" id="name_color">
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