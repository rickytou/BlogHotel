$(function () {
  /** Evenement sur le menuburger */
  $(".menu").on("click", () => {
    $(".menulink").toggleClass("active");
    $("#wrapper").toggleClass("active");
  });
  /** Evenement sur le lien du menu */
  $(".menulink li a").on("click", function () {
    $(".menulink li").removeClass("active");
    $(this).parent().addClass("active");
  });
  /** Loading */
  let loadingfunc = (className,data, active = null) => {
    $('.loadingprofil').css({'opacity':'1','z-index':'1'});
        /* Timer pour l'animation du gif loading */
        setTimeout(function(){
          $('.loadingprofil').css({'opacity':'0','z-index':'-1'});
          if(active){
            $(className).addClass('active');
          }
          $(className).html(data);
        },500)    
      }

  /**
   * Evenement sur la navigation a droite pour la section temoignages
   */
  $(".temoignages__navigation__right").on("click", function () {
    var temoignages = $(".temoignages__bloc__group");
    var tem;
    var compteur;
    $.each(temoignages, function (index, temoignage) {
      if (temoignage.classList.contains("active")) {
        $(temoignage).removeClass("active");
        compteur = index;
        tem = temoignage;
      }
    });
    if (compteur < temoignages.length - 1) {
      var t = $(tem);
      var trans = (compteur + 1) * -102 + "%";
      $(t).css("transform", "translateX(" + trans + ")");
      $(t).next().addClass("active");
      $(t)
        .nextAll()
        .css("transform", "translateX(" + trans + ")");
      // var moitieTemoignages = Math.floor(temoignages.length / 2) + 1;
      // console.log(moitieTemoignages);
      if (compteur == temoignages.length - 2) {
        $(this).removeClass("active");
        $(".temoignages__navigation__left").addClass("active");
      }
    }
  });

  /**
   * Evenement sur la navigation a gauche pour la section temoignages
   */
  $(".temoignages__navigation__left").on("click", function () {
    var compteur;
    var temoignages = $(".temoignages__bloc__group");
    $.each(temoignages, function (index, temoignage) {
      if (temoignage.classList.contains("active")) {
        $(temoignage).removeClass("active");
      }
      $(temoignage).css("transform", "translateX(0)");
    });
    temoignages[0].classList.add("active");
    $(this).removeClass("active");
    $(".temoignages__navigation__right").addClass("active");
  });
  /** Filter */
  $(".filter-categorie").on("click", function (e) {
    $('.recent-posts-filtre-categorie').removeClass('active');
    e.preventDefault();
    $(this).parent().addClass('active');
    $(this).removeClass('fa-toggle-off');
    $(this).addClass('fa-toggle-on');
    var url = $(this).attr("href");
    $.ajax({
      url : url,
      method : "GET",
      success : function(data){
        loadingfunc('.recent-posts-group', data);
        }
    })
  });

  /** Formulaire de connexion */
  $('.form-connexion').on('submit', function(e){
    
    var nomutilisateur = $('#nomutilisateur');
    var motdepasse = $('#motdepasse');
    var data = [nomutilisateur, motdepasse];
    var valid = false;
    $.each(data, function(index,element){
      if(!element.val()){
        valid = true;
      }
    });
    if(valid){
      $('.connexion-message').html('<p class="message--erreur">Il faut remplir tous les champs</p>');
      e.preventDefault();
    }
  })
  /** Ajouter un commentaire */
  $('.description-article-commentaires').on('submit', function(e){
    e.preventDefault();
    var pseudo = $('#pseudo');
    var descriptioncommentaire = $('#descriptioncommentaire');
    var idArticle = $('#idArticle');
    var valid = false;
    var data = [pseudo,descriptioncommentaire];
    $.each(data, function(index,element){
      if(!element.val()){
       valid = false;
      }
    });
    if(valid){
      $('.description-article-commentaires-message').html('<p class="message--erreur">Il faut remplir tous les champs</p>');
    }
    else{
      var url = $(this).attr("action")+'&pseudo='+pseudo.val()+'&descriptioncommentaire='+descriptioncommentaire.val()+'&idArticle='+idArticle.val();
      $.ajax({
        url : url,
        method : "GET",
        success : function(data){
          loadingfunc('.description-article-commentaires-message', data);
          }
      })
    }
    });

    /** More Article */
    $('.viewMoreArticles').on('click', function(e){
      e.preventDefault();
      var nombre = $('.recent-posts-bloc').length;
      var perPage = 4;
      var url = './index.php?controller=article&action=moreArticles&nbArticleParPage='+nombre+'&perPage='+perPage;
      //alert(url);
      $.ajax({
        url : url,
        method : "GET",
        success : function(data){
          loadingfunc('.moreArticles', data);
          }
      })
    });
});
