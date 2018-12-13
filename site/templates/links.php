<!doctype html>
<html lang="de">

  <?php snippet('head') ?>

  <body>
    <div class="page">

      <main>

        <?php snippet('header') ?>

        <article>

          <section>
            <?php foreach ($page->links()->toStructure() as $item): ?>
              <section>
                <h2><?php echo $item->title(); ?></h2>
                <?php foreach ($item->link()->toStructure() as $link): ?>
                  <?php if($link->url()->isNotEmpty()): ?>
                    <h3 class="link-name"><a href="<?php echo $link->url(); ?>"><?php echo $link->name(); ?></a></h3>
                  <?php else: ?>
                    <h3 class="link-name"><?php echo $link->name(); ?></h3>
                  <?php endif; ?>
                  <p class="link-description"><?php echo $link->description(); ?></p>
                <?php endforeach; ?>
              </section>
            <?php endforeach; ?>
          </section>
    
        </article>

        <aside>
          <?php snippet('logo') ?>
        </aside>

      </main>

    </div>

  </body>
</html>