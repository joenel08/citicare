<?php include '../db_connect.php'; ?>

<?php
if (isset($_GET['n_id'])) {
    $qry = $conn->query("SELECT * FROM news_publications WHERE n_id = " . $_GET['n_id'])->fetch_array();
    foreach ($qry as $k => $v) {
        $$k = $v;
    }
}
?>

<div class="container-fluid p-0">
    <div class="card shadow">
        <?php if (!empty($attachment) && file_exists('../' . $attachment)): ?>
            <?php
            $ext = pathinfo($attachment, PATHINFO_EXTENSION);
            if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp'])): ?>
                <img src="<?= $attachment; ?>" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
            <?php else: ?>
                <div class="p-3">
                    <a href="<?= $attachment; ?>" target="_blank" class="btn btn-sm btn-outline-primary">View Attachment</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="card-body">
            <article class="text-muted mb-2"><?= date('F j, Y', strtotime($pub_date)); ?></article>
            <h3 class="mb-3"><?= htmlspecialchars($title); ?></h3>
            <p><?= nl2br($content); ?></p>
        </div>
    </div>
</div>

<div class="modal-footer display p-2">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<style>
    #uni_modal .modal-footer {
        display: none;
    }
    #uni_modal .modal-footer.display {
        display: flex;
        justify-content: end;
    }
    .card-body p {
        white-space: pre-wrap;
    }
</style>
