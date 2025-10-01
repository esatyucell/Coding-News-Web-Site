
<div class="container my-2">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2 py-0 px-3">Arama Sonuçları: "<?php echo htmlspecialchars($query); ?>"</h1>
        <i class="fas fa-search fa-2x"></i>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($blogs)): ?>
                <div class="row">
                    <?php foreach ($blogs as $blog): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="<?php echo htmlspecialchars($blog['standard_image'] ?? ''); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($blog['title'] ?? ''); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($blog['title'] ?? ''); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($blog['short_description'] ?? ''); ?></p>
                                    <a href="/blog/<?php echo htmlspecialchars($blog['slug'] ?? ''); ?>" class="btn btn-secondary">Detaylar</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-center">Blog bulunamadı.</p>
            <?php endif; ?>
        </div>
    </div>
</div>