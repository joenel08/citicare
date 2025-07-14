<div class="card">
    <div class="card-body">
        <div class="container mt-5">
            <h2 class="text-center">Add News Publication</h2>
            <p class="text-center">Please fill out the details for the news publication</p>
            <form action="process_news.php" method="post" enctype="multipart/form-data">


                <!-- Title Field -->
                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" required
                        placeholder="Enter the title of the publication">
                </div>
                <div class="row">
                    <div class="col">
                        <!-- Publication Date -->
                        <div class="form-group">
                            <label for="pub_date">Publication Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="pub_date" name="pub_date" required>
                        </div>
                    </div>

                    <div class="col">

                        <!-- Category Selection -->
                        <div class="form-group">
                            <label for="category">Category <span class="text-danger">*</span></label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="" disabled selected>Select Category</option>
                                <option value="Senior Citizens">Senior Citizens</option>
                                <option value="Solo Parents">Solo Parents</option>
                                <option value="PWD">Persons with Disabilities</option>
                            </select>
                        </div>
                    </div>
                </div>



                <!-- Content Field -->
                <div class="form-group">
                    <label for="content">Content <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="content" name="content" rows="5" required
                        placeholder="Enter the content of the news publication"></textarea>
                </div>

                <!-- Attach Image or Document (Optional) -->
                <div class="form-group">
                    <label for="attachment">Attachment (Optional)</label>
                    <input type="file" class="form-control-file" id="attachment" name="attachment">
                </div>

                <!-- Publish Status -->
                <div class="form-group">
                    <label for="status">Publish Status <span class="text-danger">*</span></label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane"></i> Submit Publication
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>