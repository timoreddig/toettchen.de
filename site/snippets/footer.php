<footer class="article-footer">
  <ul class="article-footer__nav">
    <?php foreach($site->links()->toPages() as $link): ?>
      <?php echo $link ? '<li class="article-footer__item"><a href="' . $link->url() . '">' . $link->title()->html() . '</a></li>' : '' ?>
    <?php endforeach; ?>
  </ul>
</footer>