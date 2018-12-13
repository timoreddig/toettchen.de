<!doctype html>
<html lang="de">

  <?php snippet('head') ?>

  <body>
    <div class="page">

      <main>

        <?php snippet('header') ?>

        <article>

          <section>
            <?php echo $page->text()->kt() ?>
          </section>

          <section>
            <ul class="gallery"<?php echo attr(['data-even' => $gallery->isEven(), 'data-count' => $gallery->count()], ' ') ?>>
              <?php foreach ($gallery as $image): ?>
              <li class="gallery__list-item">
                <figure>
                  <img src="<?php echo $image->url(); ?>" alt="<?php echo $image->title()->html(); ?>" class="gallery__image" />
                </figure>
              </li>
              <?php endforeach; ?>
            </ul>
          </section>
          
        </article>

        <aside>
          <?php snippet('logo') ?>
        </aside>

      </main>

    </div>

  </body>
</html>