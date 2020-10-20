<div class="modal fade" id="ModalSlide">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="titleSlide">Add new slide</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <form class="row" action="javascript:void(0)" id="formsubmit" >
                        @csrf

                        <div class="col-sm-12 row">
                            <div class="col-sm-4 image">
                                <img src="{{ asset('img/default.jpg') }}" id="formImage" width="100%">
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group"><label for="title">Title:</label>
                                    <input type="hidden" class="form-control" id="rowid" name="rowid" value="">
                                    <input type="hidden" class="form-control" id="id" name="id" value="">
                                    <input type="type" class="form-control" id="title" placeholder="Title" name="title" value="">
                                    <span class="error_title" style="color: red"></span>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <input type="type" class="form-control" id="description" placeholder="description"
                                        name="desciption" value="">
                                    <span class="error_description" style="color: red"></span>
                                </div>
                                <div class="form-group">
                                    <label for="image">image:</label>
                                    <input type="hidden" name="anh" id="anh" class="anh" value="">
                                    <input type="file" class="form-control" id="image" placeholder="image" name="images">
                                    <span class="error_image" style="color: red"></span>
                                </div>
                                <div class="form-group">
                                    <label for="url">url:</label>
                                    <input type="text" class="form-control" id="url" placeholder="url" name="url" value="">
                                  
                                </div>
                                <input type="submit" value="submit" class="btn btn-primary">
                            </div>


                    </form>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
