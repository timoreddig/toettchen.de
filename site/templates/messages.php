<!doctype html>
<html lang="de">

  <?php snippet('head') ?>

  <body>
    <div class="page">

      <main>

      <?php snippet('header') ?>

        <article>

          <section class="section"><h1><?php echo $page->title(); ?></h1></section>

          <?php foreach ($page->children()->listed() as $section): ?>
            <section class="section">
            
              <?php echo $section->text()->kt() ?>

              <?php $gallery = $section->images()->filterBy("template", "image")->sortBy("sort"); ?>
              <ul class="gallery">
                <?php foreach ($gallery as $image): ?>
                  <li class="gallery__list-item">
                    <figure>
                      <img src="<?php echo $image->url(); ?>" alt="<?php echo $image->title()->html(); ?>" class="gallery__image" />
                    </figure>
                  </li>
                <?php endforeach ?>
              </ul>

            </section>
          <?php endforeach; ?>
          
        </article>

        <aside>
          <?php snippet('logo') ?>
        </aside>

      </main>

    </div>

  </body>
</html>