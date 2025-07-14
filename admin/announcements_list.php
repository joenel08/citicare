<div class="row">
    <div class="col-sm-5">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h5 class=""><?php if ($title == 'Edit Announcement') {
                        echo 'Edit Announcement';
                    } else {
                        echo 'Add New Annoucement';
                    } ?></h5>
                    <p class="">Please fill out the details for the announcement publication</p>
                    <form id="announcementForm" enctype="multipart/form-data">

                        <input type="hidden" name="a_id" value="<?php echo isset($a_id) ? $a_id : '' ?>">
                        <!-- Title Field -->
                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title"
                                value="<?php echo isset($news_title) ? $news_title : '' ?>" name="title" required
                                placeholder="Enter the title of the publication">
                        </div>
                        <div class="row">
                            <div class="col">
                                <!-- Publication Date -->
                                <div class="form-group">
                                    <label for="pub_date">Publication Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control"
                                        value="<?php echo isset($pub_date) ? $pub_date : '' ?>" id="pub_date"
                                        name="pub_date" required>
                                </div>
                            </div>

                            <div class="col">

                                <!-- Category Selection -->
                                <div class="form-group">
                                    <label for="category">Category <span class="text-danger">*</span></label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="" disabled <?php echo !isset($category) ? 'selected' : ''; ?>>
                                            Select Category</option>
                                        <option value="Senior Citizens" <?php echo (isset($category) && $category == 'Senior Citizens') ? 'selected' : ''; ?>>Senior Citizens</option>
                                        <option value="Solo Parents" <?php echo (isset($category) && $category == 'Solo Parents') ? 'selected' : ''; ?>>Solo Parents</option>
                                        <option value="PWD" <?php echo (isset($category) && $category == 'PWD') ? 'selected' : ''; ?>>Persons with Disabilities</option>
                                    </select>
                                </div>

                            </div>
                        </div>



                        <!-- Content Field -->
                        <div class="form-group">
                            <label for="content">Content <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="5" required
                                placeholder="Enter the content of the news publication"> <?php echo isset($content) ? $content : '' ?></textarea>
                        </div>

                        <!-- Attach Image or Document (Optional) -->
                        <div class="form-group">
                            <label for="attachment">Attachment (Optional)</label>
                            <input type="file" class="form-control-file" id="attachment" name="attachment"
                                accept="image/*">
                            <?php if (!empty($attachment) && file_exists($attachment)): ?>
                                <img id="preview" src="<?= $attachment ?>" alt="Image Preview"
                                    style="max-height: 200px; margin-top: 10px;">
                            <?php else: ?>
                                <img id="preview" style="display: none; max-height: 200px; margin-top: 10px;">
                            <?php endif; ?>

                        </div>

                        <!-- Publish Status -->
                        <div class="form-group">
                            <label for="status">Publish Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="draft" <?php echo (isset($status) && $status == 'draft') ? 'selected' : ''; ?>>Draft</option>
                                <option value="published" <?php echo (isset($status) && $status == 'published') ? 'selected' : ''; ?>>Published</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-flat">
                                <i class="fas fa-paper-plane"></i> Submit Publication
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-7">
        <div class="card">
            <div class="card-body">
                <h5>Announcement Publications List</h5>
                <table class="table table-bordered table-striped table-responsive" id="announcementTable">
                    <thead class="">
                        <tr>
                            <th>Title</th>
                            <th>Publication Date</th>
                            <th>Category</th>
                            <th>Content</th>
                            <th>Attachment</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $news_sql = "SELECT * FROM announcement_publications ORDER BY created_at DESC";
                        $query = $conn->query($news_sql);
                        while ($row = $query->fetch_assoc()):
                            $short_content = mb_strimwidth(strip_tags($row['content']), 0, 60, "...");
                            $img_preview = (!empty($row['attachment']) && file_exists($row['attachment']))
                                ? '<img src="' . $row['attachment'] . '" alt="Attachment" style="max-height: 60px;">'
                                : '<span class="badge badge-secondary">No File</span>';
                            $badge = $row['status'] === 'published'
                                ? '<span class="badge badge-success">Published</span>'
                                : '<span class="badge badge-warning">Draft</span>';
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['announcement_title']) ?></td>
                                <td><?= date('F j, Y', strtotime($row['pub_date'])) ?></td>
                                <td><?= htmlspecialchars($row['category']) ?></td>
                                <td><?= $short_content ?></td>
                                <td><?= $img_preview ?></td>
                                <td><?= $badge ?></td>
                                <td><?= date('F j, Y g:i A', strtotime($row['created_at'])) ?></td>
                                <td>


                                    <a class="btn btn-success btn-sm view_announcement" href="javascript:void(0)"
                                        data-id="<?php echo $row['a_id'] ?>"><i class="fas fa-eye"></i></a>

                                    <a href="./index.php?page=edit_announcement&a_id=<?= $row['a_id']; ?>"
                                        class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a class="btn btn-danger btn-sm delete_announcement" href="javascript:void(0)"
                                        data-id="<?php echo $row['a_id'] ?>"> <i class="fas fa-trash"></i></a>

                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        $('#announcementTable').dataTable();

        $('.view_announcement').click(function () {
            uni_modal("<i class='fa fa-id-card'></i> Annoucement Details", "<?php echo $_SESSION['login_view_folder'] ?>view_announcement.php?a_id=" + $(this).attr('data-id'))
        })
    })
</script>
<script>
    $(document).ready(function () {
        // Image preview
        $('#attachment').change(function (event) {
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            } else {
                $('#preview').hide();
            }
        });

        // AJAX submission
        $('#announcementForm').on('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: 'ajax.php?action=save_announcement',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('button[type="submit"]').prop('disabled', true).text('Saving...');
                },
                success: function (response) {
                    alert_toast('Announcement saved successfully!', 'success');
                    $('#announcementForm')[0].reset();
                    setTimeout(function () {
                        location.replace('index.php?page=announcement_list')
                    }, 750)
                    $('#preview').hide();
                },
                error: function (xhr) {
                    alert_toast('Error: ' + xhr.responseText, 'error');
                },
                complete: function () {
                    $('button[type="submit"]').prop('disabled', false).html('<i class="fas fa-paper-plane"></i> Submit Publication');
                }
            });
        });

        $('.delete_announcement').click(function () {
            _conf("Are you sure to delete this announcement?", "delete_announcement", [$(this).attr('data-id')])
        })
    });

    function delete_announcement($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_announcement',
            method: 'POST',
            data: { id: $id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script>