<!doctype html>
<html lang="de">
  
  <?php snippet('head') ?>

  <body>
    <div class="page">

      <main>

        <?php snippet('header') ?>

        <article>

          <section>
            <h1><?php echo $page->title(); ?></h1>
          </section>

          <section>
            <ul class="gallery">
              <?php foreach ($page->children()->listed() as $relative): ?>
                <li class="gallery__list-item">
                  <figure>
                    <?php foreach ($relative->files() as $image): ?>
                      <img src="<?php echo $image->url(); ?>" alt="<?php echo $image->title()->html(); ?>" class="gallery__image" />
                    <?php endforeach ?>
                    <figcaption><?php echo $relative->title(); ?></figcaption>
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