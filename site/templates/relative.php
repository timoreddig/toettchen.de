<!doctype html>
<html lang="de">

  <?php snippet('head') ?>

  <body>
    <div class="page">

      <?php snippet('header') ?>

      <main>

        <article>

          <?php if ($cover = $page->images()->findBy("template", "cover")): ?>
            <figure class="project-cover">
              <?php echo $cover; ?>
            </figure>
          <?php endif ?>


          <div class="text">
            <?php echo $page->text()->kt() ?>
          </div>

          <ul class="gallery"<?php echo attr(['data-even' => $gallery->isEven(), 'data-count' => $gallery->count()], ' '); ?>>
            <?php foreach ($gallery as $image): ?>
              <li class="gallery__list-item">
                <figure>
                  <img src="<?php echo $image->url(); ?>" alt="<?php echo $image->title()->html(); ?>" class="gallery__image" />
                </figure>
              </li>
            <?php endforeach; ?>
          </ul>

          <?php snippet('footer') ?>

        </article>

        <aside>
          <?php snippet('logo') ?>
        </aside>

      </main>

    </div>

  </body>
</html>