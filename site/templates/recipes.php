<!doctype html>
<html lang="de">

  <?php snippet('head') ?>

  <body>
    <div class="page">

      <main>

      	<?php snippet('header') ?>

        <article>

          <?php snippet('intro') ?>

          <section>

            <ul class="recipes">
              <?php foreach ($page->children()->listed() as $recipe): ?>
                <li>
                  <a href="<?php echo $recipe->url() ?>"><?php echo $recipe->title() ?></a>
                </li>
              <?php endforeach ?>
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