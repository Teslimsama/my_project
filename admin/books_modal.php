<div id="userModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Type of the Book\Material</label>
                            <select style="border: 2px solid grey ;" name="type" id="type" class="form-control ps-4" aria-label=".form-select-mg example">
                            <option>Type</option>
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
                            <input type="file" class="form-control ps-4" style="border: 2px solid grey ;" name="user_image" id="user_image">
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="">Amount</label>
                            <input type="number" style="border: 2px solid grey ;" class="form-control ps-4" name="product_price" id="product_price" required placeholder="amount">
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="">Faculty</label>
                            <input type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="faculty" id="faculty" required placeholder="faculty">
                        </div>
                        <div class="col-md-6 p-2">
                            <label for="">Department</label>
                            <input type="text" style="border: 2px solid grey ;" class="form-control ps-4" name="department" id="department" required placeholder="department">
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
                    <input type="hidden" name="user_id" id="user_id" />
                    <input type="hidden" name="operation" id="operation" />
                    <button type="submit" name="action" id="action" class="btn btn-success">Edit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>