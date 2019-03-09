<?php
include_once "Crawler.php";
date_default_timezone_set("America/Sao_Paulo");
$todos_prof = false;
if (isset($_GET['todos_prof']) && $_GET['todos_prof'] == 1)
  $todos_prof = true;
$crawler = new Crawler();
$todos_professores = $crawler->buscarProfessores();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Horários UFCSPA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.4/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script
			  src="https://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>
  </head>
  <body>
  <section class="hero is-small is-primary is-bold">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Corpo Docente UFCSPA
      </h1>
      <h2 class="subtitle">
      Lista do corpo docente da <strong>UFCSPA</strong>
      </h2>
    </div>
  </div>
</section>
  <section class="section">
    <div class="container">
      <div>
            <h3 class="title">
                Docentes
            </h3>
            <div class="columns">
                <div class="column is-4">
                    Filtre por nome ou por área:<input class="input" type="text" id="filtraCards" placeholder="Digite seu filtro">
                </div>
                <div class="column is-4">
                  <br>
                     <input id="check-dia-todo" class="checkbox" type="checkbox" id="filtraCards" <?php if($todos_prof) {echo "checked";} else { echo "";} ?>> Mostrar todos os professores
                </div>
            </div>

            <div class="tabs is-centered">
              <ul id="menu-predios">
                <li class="is-active" id="tab-predio-um"><a >Todos professores</a></li>
                <!-- <li id="tab-predio-dois"><a >Prédio 2</a></li>
                <li id="tab-predio-tres"><a >Prédio 3</a></li> -->
              </ul>
            </div>
          <div id="cards-predio-um" class="columns is-multiline aberta">
            <?php
                foreach ($todos_professores as $d) { 
            ?>
              <div class="column is-4 cards">
                <div class="box">
                    <article class="media">
                      <!-- <div class="media-left">
                        <figure class="image is-64x64">
                          <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                        </figure>
                      </div> -->
                      <div class="media-content">
                        <div class="content">
                          <p>
                            <strong class="nome-prof"><?php echo $d->nome; ?></strong> -  <small><?php echo $d->titulacao; ?></small>
                            <br>
                          <label class="nome-departamento">  <?php echo $d->departamento; ?> </label>
                            <br>
                            <small><?php echo $d->area_conhecimento; ?></small><br>
                          <small><a herf="mailto:<?php echo $d->email; ?>"> <?php echo $d->email; ?>  </a> - <a href="<?php echo $d->lattes; ?>"> Lattes </a></small>  
                          </p>
                        </div>
                        <!-- <nav class="level is-mobile">
                          <div class="level-left">
                            <a class="level-item" aria-label="thumbs-up">
                              <span class="icon is-small">
                                <i class="far fa-thumbs-up" aria-hidden="true"></i>
                              </span>
                            </a>
                            <a class="level-item" aria-label="thumbs-down">
                              <span class="icon is-small">
                                <i class="far fa-thumbs-down" aria-hidden="true"></i>
                              </span>
                            </a>
                          </div>
                        </nav> -->
                      </div>
                    </article>
                  </div>
              </div>
             <?php 
                }
             ?>
              
            </div>

        <div id="cards-predio-dois" class="columns is-multiline" style="display:none">
        </div>
        <div id="cards-predio-tres" class="columns is-multiline"  style="display:none">
        </div>
      </div>
  </section>
  <footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Desenvolvido</strong> por <a target="_blank" href="www.linkedin.com/in/lucas-pachecos
">Lucas Pacheco</a> <br> <br>
      <a  target="_blank" href="https://bulma.io/">
      <img src="https://bulma.io/images/made-with-bulma.png" alt="Made with Bulma" width="128" height="24">
    </a>
    </p>
  </div>
</footer>
  <!-- <section class="section">
    <div class="container">
      <div class="heading">
        <h1 class="title">Prédio</h1>
        <h2 class="subtitle">
           <strong>sections</strong>, like the one you're currently reading
        </h2>
      </div>
    </div>
  </section> -->
</body>
<script>
    $(document).ready(function(){


      $("#check-dia-todo").click(function(){
        if ($(this).is(':checked')) {
          location.href="?todo_dia=1";
        } else {
          location.href="?";
        }
      });

        $("#tab-predio-um").click(function(){
          
          $("#menu-predios").find("li").each(function(){
            $(this).toggleClass("is-active", false);
          });
          $(this).toggleClass("is-active", true);

          $(".aberta").animate({
                  height: "toggle",
                  opacity: "toggle"
                }, "slow");
            $(".aberta").toggleClass("aberta", false);
            //$("#cards-predio-dois").show();
            $("#cards-predio-um").animate({
                  height: "toggle",
                  opacity: "toggle"
                }, "slow");
            $("#cards-predio-um").toggleClass("aberta", true);

        });

        $("#tab-predio-dois").click(function(){
         
          $("#menu-predios").find("li").each(function(){
              $(this).toggleClass("is-active", false);
            });
            $(this).toggleClass("is-active", true);
  
            $(".aberta").animate({
                  height: "toggle",
                  opacity: "toggle"
                }, "slow");
            $(".aberta").toggleClass("aberta", false);
            //$("#cards-predio-dois").show();
            $("#cards-predio-dois").animate({
                  height: "toggle",
                  opacity: "toggle"
                }, "slow");
            $("#cards-predio-dois").toggleClass("aberta", true);

          });

        $("#tab-predio-tres").click(function(){
          $("#menu-predios").find("li").each(function(){
            $(this).toggleClass("is-active", false);
          });
          $(this).toggleClass("is-active", true);

          $(".aberta").animate({
                height: "toggle",
                opacity: "toggle"
                }, "slow");
            $(".aberta").toggleClass("aberta", false);
            //$("#cards-predio-dois").show();
            $("#cards-predio-tres").animate({
                  height: "toggle",
                  opacity: "toggle"
                }, "slow");
            $("#cards-predio-tres").toggleClass("aberta", true);
        });

        $("#filtraCards").keyup(function(){        
            var valor = $(this).val().toLowerCase();
            $(".cards").each(function(){
                if ($(this).find('[class="nome-prof"]').text().toLowerCase().indexOf(valor) > -1 || $(this).find('[class="nome-departamento"]').text().toLowerCase().indexOf(valor) > -1) {
                    $(this).fadeIn();
                } else {
                    $(this).fadeOut();
                }

            });
        });
    });
</script>
</html>
