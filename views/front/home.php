<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000" aria-roledescription="carousel">
  <div class="carousel-inner">
    <?php if (!empty($sliders)): ?>
      <?php foreach ($sliders as $index => $slider): ?>
        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
          <img src="<?php echo htmlspecialchars($slider['image_url']); ?>" class="d-block w-100 rounded shadow" alt="<?php echo htmlspecialchars($slider['title']); ?>" style="object-fit:cover; max-height:420px;">
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="carousel-item active">
        <img src="https://place-hold.it/800x400?text=No+Sliders" class="d-block w-100 rounded shadow" alt="No Sliders">
        <div class="carousel-caption d-none d-md-block">
          <h5>Slider Bulunamadı</h5>
        </div>
      </div>
    <?php endif; ?>

    <!-- Carousel counter -->
    <div class="carousel-counter position-absolute end-0 bottom-0 me-3 mb-3 bg-babyblue rounded-pill px-3 py-1 text-white shadow-sm">
      <span id="carouselCounterValue">1/<?php echo max(1, count($sliders)); ?></span>
    </div>
  </div>

  <!-- Thumbnail navigation -->
  <div class="carousel-thumbs mt-3 d-flex justify-content-center align-items-center flex-wrap">
    <?php if (!empty($sliders)): ?>
      <?php foreach ($sliders as $index => $slider): ?>
        <img src="<?php echo htmlspecialchars($slider['image_url']); ?>" 
             class="img-thumbnail mx-1 thumb-clickable" 
             style="width:100px; height:50px; object-fit:cover; cursor:pointer; transition: transform 0.3s, box-shadow 0.3s;" 
             data-index="<?php echo $index; ?>" 
             alt="<?php echo htmlspecialchars($slider['title']) . ' Thumbnail'; ?>" 
             role="button" 
             aria-label="Slider <?php echo $index + 1; ?>">
      <?php endforeach; ?>
    <?php else: ?>
      <img src="https://place-hold.it/100x50?text=No+Thumbnail" class="img-thumbnail mx-1" style="width:100px; height:50px; object-fit:cover;" alt="No Thumbnail">
    <?php endif; ?>
  </div>
</div>

<style>
  /* Thumbnail hover efekti */
  .thumb-clickable:hover {
    transform: scale(1.1);
    box-shadow: 0 0 15px rgba(90, 200, 250, 0.6);
    z-index: 2;
  }

  /* Counter için bebek mavisi teması */
  .bg-babyblue { background-color: #5ac8fa !important; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const carouselEl = document.getElementById('carouselExampleIndicators');
  const carousel = new bootstrap.Carousel(carouselEl);

  // Thumbnail tıklanınca geçiş
  document.querySelectorAll('.thumb-clickable').forEach(thumb => {
    thumb.addEventListener('click', function() {
      const index = parseInt(this.getAttribute('data-index'));
      carousel.to(index);
    });
  });

  // Counter güncelleme
  const counter = document.getElementById('carouselCounterValue');
  const total = Math.max(1, document.querySelectorAll('.thumb-clickable').length);
  carouselEl.addEventListener('slid.bs.carousel', function(e){
    counter.textContent = (e.to + 1) + '/' + total;
  });
  counter.textContent = '1/' + total;
});
</script>
