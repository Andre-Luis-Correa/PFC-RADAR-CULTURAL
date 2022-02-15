<?php

  $pages = selectAll('tb_pagina');

?>

<!-- footer -->
<div class="footer">
  <div class="footer-content">

    <div class="footer-section about">
      <h1 class="logo-text"><span>Radar</span>Cultural</h1>
      <p>
        AwaInspires is a fictional blog conceived for the purpose of a tutorial on YouTube.
        However, Awa has a blog called pieceofadvice.org where he writes truly inspiring stuff.
      </p>
      <div class="contact">
        <span><i class="fas fa-phone"></i> &nbsp; 123-456-789</span>
        <span><i class="fas fa-envelope"></i> &nbsp; info@awainspires.com</span>
      </div>
      <div class="socials">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
      </div>
    </div>

    <div class="footer-section links">
      <h2>Quick Links</h2>
      <br>

      <ul>
        <a href="#">
          <?php foreach ($pages as $key => $page): ?>
             <li><a href="<?php echo BASE_URL . '/page.php?id_pagina=' . $page['id_pagina']; ?>"><?php echo $page['titulo']; ?></a></li>
          <?php endforeach; ?>
        </a>
      </ul>
    </div>

  </div>

  <div class="footer-bottom">
    &copy; Radar Cultural | Desenvolvido por alunos do IFPR
  </div>
</div>
<!-- // footer -->