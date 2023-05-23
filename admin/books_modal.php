<div id="productModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="product_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Products</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Type of the Book\Material</label>
                            <select style="border: 2px solid grey ;" name="type" id="type" class="form-control ps-4" aria-label=".form-select-mg example">
                                <option value="">Type</option>
                                <option value="1">Books</option>
                                <option value="0">Projects</option>
                            </select>
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="">Title</label>
                            <input type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="product_name" id="product_name" required placeholder="Title">
                        </div>
                        <div class="upload p-2 col-md-6 ps-4">
                            <label for="">Upload File Image </label>
                            <input type="file" class="form-control ps-4" style="border: 2px solid grey ;" name="product_image" id="product_image">
                            <span id="product_uploaded_image"></span>
                        </div>
                        <div class="upload p-2 col-md-6 ps-4">
                            <label for="">Upload File </label>
                            <input type="file" class="form-control ps-4" id="book" style="border: 2px solid grey ;" name="book">
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="">Amount</label>
                            <input type="number" style="border: 2px solid grey ;" class="form-control ps-4" name="product_price" id="product_price" required placeholder="amount">
                        </div>
                        <div class="col-md-6">
                            <label for="">University</label>
                            <select style="border: 2px solid grey ;" name="university" id="university" class="form-control action">
                                <option value="">Select university</option>
                                <?php echo $university; ?>
                            </select>
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="">Faculty</label>
                            <select style="border: 2px solid grey ;" name="faculty" id="faculty" class="form-control action">
                                <option value="">Select faculty</option>
                            </select>
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="">Department</label>
                            <select style="border: 2px solid grey ;" name="department" id="department" class="form-control action">
                                <option value="">Select department</option>
                            </select>
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="">Course</label>
                            <select style="border: 2px solid grey ;" name="course" id="course" class="form-control">
                                <option value="">Select course</option>
                            </select>
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="">Description</label>
                            <textarea type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="desc" id="desc" required placeholder="Description"></textarea>
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="">Keywords</label>
                            <input type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="keywords" id="keywords" required placeholder="Keywords">
                        </div>
                        <div class="level col-6">
                            <label for="">Level</label>
                            <select class="form-select form-select-md" name="level" id="level" style="border: 2px solid grey ;" class="form-control ps-4" aria-label=".form-select-mg example">
                                <option> Current Level</option>
                                <option value="100">100L</option>
                                <option value="200">200L</option>
                                <option value="300">300L</option>
                                <option value="400">400L</option>
                                <option value="500">500L</option>
                            </select>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="product_id" id="product_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <button type="submit" name="action" id="action" class="btn btn-success">Edit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Update Photo -->
<div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="products_photo.php" enctype="multipart/form-data">
                    <input type="hidden" class="prodid" name="id">
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>

                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Update Photo -->
<!-- <div class="modal fade" id="edit_photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b><span class="name"></span></b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="products_photo.php" enctype="multipart/form-data">
                    <input type="hidden" class="prodid" name="id">
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>


                        <div class="upload p-2 col-md-6 ps-4">
                            <label for="">Upload File Image </label>
                            <input type="file" class="form-control ps-4" style="border: 2px solid grey ;" name="product_image" id="product_image">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div> -->