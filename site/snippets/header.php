<header class="header">
	<h1><a href="<?php echo $site->url() ?>">Töttchen</a></h1>
	<nav class="main-nav">
		<ul class="main-nav__list">
		<?php foreach ($site->children()->listed() as $child): ?>
			<li class="main-nav__item"><a href="<?php echo $child->url() ?>" class="main-nav__link"><?php echo $child->title()->html() ?></a></li>
		<?php endforeach ?>
		</ul>
		<button class="nav-toggle" aria-label="Toggle navigation">&#9776;</button>
	</nav>
	<?php snippet('footer') ?>
</header>