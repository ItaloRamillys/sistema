<nav class="navbar navbar-expand-lg fixed-top navbar-light text-light navbar-transparent">
  <a class="navbar-brand" href="#"><?=$titulo?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?=$configBase?>/home">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=$configBase?>/escola">Escola</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=$configBase?>/equipe">Equipe</a>
      </li>
      <li class="nav-item" id="btn-login">
        <a class="nav-link" href="#" id="show-login">Login</a>
      </li>
    </ul>
  </div>
</nav>

<script type="text/javascript">
  $(window).bind('scroll', function () {
    if ($(window).scrollTop() > 600) {
        $('.navbar').removeClass('navbar-transparent');
          $('.nav-item').addClass('nav-item-2');
    } else {
        $('.navbar').addClass('navbar-transparent');
         $('.nav-item').removeClass('nav-item-2');
    }
  });
</script>