$(function(){
  /** Fonction loading */
  let loadingfunc = (className,data) => {
    $('.loadingprofil').css({'opacity':'1','z-index':'1'});
        /* Timer pour l'animation du gif loading */
        setTimeout(function(){
          $('.loadingprofil').css({'opacity':'0','z-index':'-1'});
          $(className).html(data);
        },500);
  }
  /** Fin */
  /** Evenement sur l'icon de l'utilisateur */
  $('.account .fa-circle-user').on('click', function(){
   $('.sous-menu').toggleClass('active');
  });
  /** Evenement sur le click ajouter */
  $('.addArticleBlog').on('click', function(){
    $('#article').addClass('active');
  });
  /** Evenement quand on clique sur l'icon de fermeture (close) */
  $('.closeArticle').on('click', function(){
    $('#article').removeClass('active');
  });
  
  /** Evenement pour le formulaire d'ajout d'un article */
  $('#form-ajouter-article').on('submit', function(e){
    e.preventDefault();
    var titre = $('#titre');
    var desc = $('#desc');
    var image = $("#uploadimage");
    var idCategories = $("#idCategorieArticle");
    var allInputs = [titre, desc, image];
    var valid = true;

  $.each(allInputs, function (indexInArray, valueOfElement) { 
     if(!$(valueOfElement).val()){
      $(valueOfElement).addClass('error');
      valid = false;
     }
  });
  if(!valid){
    $(".ajouter-article-message").html('<p class="message--erreur">Il faut remplir tous les champs</p>');
  }
  else{
     var url = '../index.php?controller=article&action=addArticle&titre='+titre.val()+'&description='+desc.val()+'&idCategories='+idCategories.val();
        var formData = new FormData(this);
        $.ajax({
          type: "POST",
          url: url,
          data: formData,
          success: function(data){
            $('.ajouter-article-message').html(data);
          },
          error: function(err){
            console.log('Erreur: '+err);
          },
          cache: false,
          contentType: false,
          processData: false
        });
      }
   
  });
  
  /**  */
  $("#titre").on('input', function(){
    $(this).removeClass('error');
  });
  $("#desc").on('input', function(){
    $(this).removeClass('error');
  });
  /* ------------------------------------------------------------------------------- */
  /** Categories */
  /** Evenement quand on clique sur le bouton plus  */
   $('.addCategorieBlog').on('click', function(){
    $('#categorie').addClass('active');
  });
  /** Evenement quand on clique sur l'icon de fermeture (close) */
  $('.closeCategorie').on('click', function(){
    $('#categorie').removeClass('active');
  });
  /* Evenement pour le formulaire d'ajout d'une categorie */
  $("#form-ajouter-categorie").on('submit',function(e){
    e.preventDefault();
    var nomCategorie = $('#nomCategorie');
    var invalid = false;
    var descriptionCategorie = $('#descriptionCategorie');
    if(!nomCategorie.val()){
      invalid = true;
    }
    if(invalid){
      nomCategorie.addClass('error');
    }
    else{
      var url = '../index.php?controller=categorie&action=addCategorie&nomCategorie='+nomCategorie.val()+'&descriptionCategorie='+descriptionCategorie.val();
      $.ajax({
        url : url,
        method : "GET",
        success : function(data){
            $('.ajouter-categorie-message').html(data);
          }
      })
    }
  });
  /** Pour enlever la bordure quand on edite l'input' */
  $("#nomCategorie").on('input', function(){
    $(this).removeClass('error');
  });
  /** Evenement lors du clic sur le bouton liste Categorie */
$('.viewListCategorie').on('click', function(){
  $('.fa-eye').removeClass('active');
  $('.header-bloc-group').removeClass('active');
  $('.header-bloc-group-2').addClass('active');
    $(this).addClass('active');
    var url = '../index.php?controller=categorie&action=listCategorie';
    $.ajax({
      url: url,
      method: "GET",
      success: function(data){
        loadingfunc('.list-group', data);
      }
    });
  })
  /** Fin */
    /** Evenement lors du clic sur le bouton liste Article */
$('.viewListArticle').on('click', function(){
  $('.fa-eye').removeClass('active');
  $('.header-bloc-group').removeClass('active');
  $('.header-bloc-group-1').addClass('active');
    $(this).addClass('active');
    var url = '../index.php?controller=article&action=listArticle';
    $.ajax({
      url: url,
      method: "GET",
      success: function(data){
        loadingfunc('.list-group', data);
      }
    });
  })
  /** Fin */
  /* -------------------Fin Categorie -------------------------- */
   /** Article */
   /** Evenement lors du clic sur le bouton de suppression */
   $('.deleteArticle').on('click', function(e){
     e.preventDefault();
      var url = $(this).attr("href");   
      $.ajax({
        url : url,
        method : "GET",
        success : function(data){
          loadingfunc('.list-group', data);
        }
      });
    });
    /** Fin */
    /** Desactive un article */
$('.desactivatedArticle').on('click', function(e){
  e.preventDefault();
  var url = $(this).attr("href"); 
  $.ajax({
    url : url,
    method : "GET",
    success : function(data){
      loadingfunc('.list-group', data);
    }
  });
});
/** Active une categorie */
$('.activatedArticle').on('click', function(e){
  e.preventDefault();
  var url = $(this).attr("href"); 
  $.ajax({
    url : url,
    method : "GET",
    success : function(data){
      loadingfunc('.list-group', data);
    }
  });
});
});