$(function () {
  
  if(!localStorage.getItem("activeJS")){
    $(".activejavascript").addClass("active");
   }
   $(".wrapperclose").on("click", function(){
     $(".activejavascript").removeClass("active");
     localStorage.setItem("activeJS","active");
   });
   /** Click en dehors de la boite */
   $(".activejavascript").on("click", function(){
     $(".activejavascript").removeClass("active");
     localStorage.setItem("activeJS","active");
   });
  
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
    $(temoignages).first().addClass('active');
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
    $('.recent-posts-more').hide();
    var url = $(this).attr("href");
    $.ajax({
      url : url,
      method : "GET",
      success : function(data){
        loadingfunc('.recent-posts-group', data);
        }
    })
  });
$('.filter-all').on('click', function(){
  $('.recent-posts-more').show();
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
    // var pseudo = $('#pseudo');
    var descriptioncommentaire = $('#descriptioncommentaire');
    var idArticle = $('#idArticle');
    var valid = false;
    var data = [descriptioncommentaire];
    $.each(data, function(index,element){
      if(!element.val()){
       valid = false;
      }
    });
    if(valid){
      $('.description-article-commentaires-message').html('<p class="message--erreur">Il faut remplir tous les champs</p>');
    }
    else{
      var url = $(this).attr("action")+'&descriptioncommentaire='+descriptioncommentaire.val()+'&idArticle='+idArticle.val();
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
      function substringName(desc, taille){
        return (desc.length < taille ? desc : desc.substring(0,taille)+"...");

      }
      e.preventDefault();
      var nombre = $('.recent-posts-bloc').length;
      var perPage = 2;
      var url = './index.php?controller=article&action=moreArticles&nbArticleParPage='+nombre+'&perPage='+perPage;
      $.ajax({
        url : url,
        method : "GET",
        success : function(data){
          $('.loadingprofil').css({'opacity':'1','z-index':'1'});
        /* Timer pour l'animation du gif loading */
        setTimeout(function(){
          $('.loadingprofil').css({'opacity':'0','z-index':'-1'});
          let arrayMoreArticles = JSON.parse(data); 
          let recent_posts_group = document.querySelector(".recent-posts-group");
          
          arrayMoreArticles.forEach(element => {
            let article = document.createElement("article");
            article.setAttribute('class','recent-posts-bloc');
          
            let div_recent_posts_image = document.createElement("div");
            div_recent_posts_image.setAttribute('class','recent-posts-image');
          
            let aLinkImage = document.createElement("a");
            aLinkImage.setAttribute('href','./index.php?controller=article&action=description&idArticle='+element.idArticle);

            let image = document.createElement("img");
            image.setAttribute('src', element.imageArticle);

            aLinkImage.appendChild(image)
            div_recent_posts_image.appendChild(aLinkImage);

             /** recent-posts-main */ 
            let div_recent_posts_main = document.createElement("div");
            div_recent_posts_main.setAttribute('class','recent-posts-main')

            let div_recent_posts_title = document.createElement("div");
            div_recent_posts_title.setAttribute('class','recent-posts-title')
            
            let strongTitreArticle = document.createElement("strong");
            let aTitreArticle = document.createElement("a");
            aTitreArticle.setAttribute('href','./index.php?controller=article&action=description&idArticle='+element.idArticle);
            aTitreArticle.text = element.titreArticle;

            let pDescArticle = document.createElement("p");
            pDescArticle.innerHTML = substringName(element.descriptionArticle,160);

            
            strongTitreArticle.appendChild(aTitreArticle);
            div_recent_posts_title.appendChild(strongTitreArticle);
            div_recent_posts_main.appendChild(div_recent_posts_title);
            div_recent_posts_main.appendChild(pDescArticle);


            article.appendChild(div_recent_posts_image);
            article.appendChild(div_recent_posts_main);
            recent_posts_group.appendChild(article);
          });
        },300) 
          }
      })
    });

    /** Barre de recherche dynamique avec Ajax */
    $('#search').on('input', function(){
      var search = $('#search');
        $(".searchmessage").removeClass("message--erreur--custom");
          var url = './index.php?controller=article&action=search&query='+search.val();
          $.ajax({
            url : url,
            method : "GET",
            success : function(data){
              let articles = JSON.parse(data);
              var viewArticle = document.querySelector('.searchmessage');
              viewArticle.innerHTML = "";
             
             articles.forEach(element => {
              $(search).addClass('active');
              var div = document.createElement("div");
              div.setAttribute('class','result');
              var aTitle = document.createElement("a");
              aTitle.setAttribute('href','./index.php?controller=article&action=description&idArticle='+element.idArticle);
              aTitle.innerHTML = element.titreArticle;
              div.appendChild(aTitle);
              viewArticle.appendChild(div);
             });
              }
          })
         
        //}
     
      
    });
    /** Barre de recherche avec clic sur le bouton de recherche du formulaire */
    $('.fa-magnifying-glass').parent().on('click', function(){
      var search = $('#search');
        if(!$(search).val()){
          $('.searchmessage').text('Vous recherchez quoi ?').addClass('message--erreur--custom');
        }
        else{
          var url = './index.php?controller=article&action=search&query='+search.val();
          $.ajax({
            url : url,
            method : "GET",
            success : function(data){
              let articles = JSON.parse(data);
              var viewArticle = document.querySelector('.searchmessage');
              viewArticle.innerHTML = "";
             if(articles.length > 0){
             articles.forEach(element => {
              $(search).addClass('active');
              var div = document.createElement("div");
              div.setAttribute('class','result');
              var aTitle = document.createElement("a");
              aTitle.setAttribute('href','./index.php?controller=article&action=description&idArticle='+element.idArticle);
              aTitle.innerHTML = element.titreArticle;
              div.appendChild(aTitle);
              viewArticle.appendChild(div);
             });
              }
              else{
                $('.searchmessage').text('Aucun article disponible').addClass('message--erreur--custom');
              }
            }
          })         
        }      
    });
});
