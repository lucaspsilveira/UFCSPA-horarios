<?php
include_once "Crawler.php";
date_default_timezone_set("America/Sao_Paulo");
$todo_dia = false;
if (isset($_GET['todo_dia']) && $_GET['todo_dia'] == 1)
  $todo_dia = true;
$crawler = new Crawler("http://salas.ufcspa.edu.br/w8_relatorio_dia.php");
$crawler->setInstituicao(1);
$crawler->setPredio(1);
$disciplinas_predio_um = $crawler->buscarDisciplinas($todo_dia);
$crawler->setPredio(2);
$disciplinas_predio_dois = $crawler->buscarDisciplinas($todo_dia);
$crawler->setPredio(3);
$disciplinas_predio_tres = $crawler->buscarDisciplinas($todo_dia);
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
    <div class="columns"> 
    <div class="column is-11"> 
      <h1 class="title">
        Horários UFCSPA
      </h1>
      <h2 class="subtitle">
      Horários das salas de aula da <strong>UFCSPA</strong>
      </h2>
      </div>
      <div class="column is-1"><a href="index-professores.php" style=" text-decoration: underline;">Corpo Docente</a></div>
    </div>
    </div>
  </div>
</section>
  <section class="section">
    <div class="container">
        <div>
            <h3 class="title">
                Horários próximos
            </h3>
            <div class="columns">
                <div class="column is-4">
                    Filtre por curso ou por disciplina:<input class="input" type="text" id="filtraCards" placeholder="Digite seu filtro">
                </div>
                <div class="column is-4">
                  <br>
                     <input id="check-dia-todo" class="checkbox" type="checkbox" id="filtraCards" <?php if($todo_dia) {echo "checked";} else { echo "";} ?>> Mostrar o dia todo
                </div>
            </div>

            <div class="tabs is-centered">
              <ul id="menu-predios">
                <li class="is-active" id="tab-predio-um"><a >Prédio 1</a></li>
                <li id="tab-predio-dois"><a >Prédio 2</a></li>
                <li id="tab-predio-tres"><a >Prédio 3</a></li>
              </ul>
            </div>
               
          <div id="cards-predio-um" class="columns is-multiline aberta">
            <?php
                foreach ($disciplinas_predio_um as $d) { 
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
                            <strong class="nome-disciplina"><?php echo $d->disciplina; ?></strong> <small><?php echo $d->atividade; ?></small>
                            <br>
                          <label class="nome-curso">  <?php echo $d->curso; ?> </label>
                            <br>
                            <small><?php echo $d->horario; ?></small><br>
                          <small><?php echo $d->sala; ?> - <?php echo $d->sala_descricao; ?></small>  
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
        
        
        
        
        </div>

        <div id="cards-predio-dois" class="columns is-multiline" style="display:none">
        <?php
                foreach ($disciplinas_predio_dois as $d) { 
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
                            <strong class="nome-disciplina"><?php echo $d->disciplina; ?></strong> <small><?php echo $d->atividade; ?></small>
                            <br>
                          <label class="nome-curso">  <?php echo $d->curso; ?> </label>
                            <br>
                            <small><?php echo $d->horario; ?></small><br>
                          <small><?php echo $d->sala; ?> - <?php echo $d->sala_descricao; ?></small>  
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
        <div id="cards-predio-tres" class="columns is-multiline"  style="display:none">
        <?php
                foreach ($disciplinas_predio_tres as $d) { 
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
                            <strong class="nome-disciplina"><?php echo $d->disciplina; ?></strong> <small><?php echo $d->atividade; ?></small>
                            <br>
                          <label class="nome-curso">  <?php echo $d->curso; ?> </label>
                            <br>
                            <small><?php echo $d->horario; ?></small><br>
                          <small><?php echo $d->sala; ?> - <?php echo $d->sala_descricao; ?></small>  
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
      </div>
  </section>
  <footer class="footer">
  <div class="content has-text-centered">
    <p>
      <strong>Desenvolvido</strong> por <a target="_blank" href="https://linkedin.com/in/lucas-pachecos
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
                if ($(this).find('[class="nome-disciplina"]').text().toLowerCase().indexOf(valor) > -1 || $(this).find('[class="nome-curso"]').text().toLowerCase().indexOf(valor) > -1) {
                    $(this).fadeIn();
                } else {
                    $(this).fadeOut();
                }

            });
        });
    });
</script>
</html>
