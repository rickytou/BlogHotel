$(function(){
  /** Fonction loading */
  // let loadingfunc = (className,data) => {
  //   $('.loadingprofil').css({'opacity':'1','z-index':'1'});
  //       /* Timer pour l'animation du gif loading */
  //       setTimeout(function(){
  //         $('.loadingprofil').css({'opacity':'0','z-index':'-1'});
  //         $(className).html(data);
  //       },500);
  // }

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
     var url = './index.php?controller=article&action=addArticle&titre='+titre.val()+'&description='+desc.val()+'&idCategories='+idCategories.val();
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


  /** Categories */
  /** Evenement quand on clique sur le bouton plus  */
  $('.addTemoignageBlog').on('click', function(){
    $('#temoignage').addClass('active');
  });
  /** Evenement quand on clique sur l'icon de fermeture (close) */
  $('.closeTemoignage').on('click', function(){
    $('#temoignage').removeClass('active');
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
      var url = './index.php?controller=categorie&action=addCategorie&nomCategorie='+nomCategorie.val()+'&descriptionCategorie='+descriptionCategorie.val();
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

/** Formulaire d'ajout d'un nnouveau temoignage */
$("#form-ajouter-temoignage").on('submit',function(e){
  e.preventDefault();
  var temoin = $('#nomTemoin');
  var invalid = false;
  var avis = $('#avis');
  var avatar = $("#avatar");
  var dataTemoignage = [temoin, avis];
  $.each(dataTemoignage, function(index, element){
    if(!$(element).val()){
      element.addClass('error');
      invalid = true;
    }
  });
  if(invalid){
    $(".ajouter-temoignage-message").html('<p class="message--erreur">Il faut remplir tous les champs</p>');
  }
  else{
    if($(avis).val().length > 300){
      $(".ajouter-temoignage-message").html('<p class="message--erreur">Taille maximum 300 caract&egrave;res</p>');
    }
    else{
    var url = './index.php?controller=temoignage&action=addTemoignage&temoin='+temoin.val()+'&avis='+avis.val();    
    var formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: url,
      data: formData,
      success: function(data){
        $('.ajouter-temoignage-message').html(data);
      },
      error: function(err){
        console.log('Erreur: '+err);
      },
      cache: false,
      contentType: false,
      processData: false
    });
    }
  }
});
 /** Pour enlever la bordure quand on edite l'input' */
 $("#nomTemoin").on('input', function(){
  $(this).removeClass('error');
});
$("#avis").on('input', function(){
  $(this).removeClass('error');
});


  /** Evenement lors du clic sur le bouton liste Categorie */
$('.viewListCategorie').on('click', function(){
  $('.fa-eye').removeClass('active');
  $('.header-bloc-group').removeClass('active');
  $('.header-bloc-group-2').addClass('active');
    $(this).addClass('active');
    var url = './index.php?controller=categorie&action=listCategorie';
    $.ajax({
      url: url,
      method: "GET",
      success: function(data){
        loadingfunc('.list-group', data);
      }
    });
  })
  /** Fin */

  $('.viewListTemoignage').on('click', function(){
    $('.fa-eye').removeClass('active');
    $('.header-bloc-group').removeClass('active');
    $('.header-bloc-group-4').addClass('active');
      $(this).addClass('active');
      var url = './index.php?controller=temoignage&action=listTemoignage';
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
    var url = './index.php?controller=article&action=listArticle';
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


/** Soumission du fomulaire de modification de la categorie */
// $('#updateModifierArticle').on('submit', function(e){ 
//   e.preventDefault();
//   alert('ok'); 
//   });

       /** Afficher une categorie */
       $('.viewArticle').on('click', function(e){
        e.preventDefault();
        var url = $(this).attr("href"); 
        $.ajax({
          url : url,
          method : "GET",
          success : function(data){
            loadingfunc('.form-updatearticle', data, 'active');
          }
        });
       })
       /** Fin */
        /** Cocher tous les inputs */
     CocherTout();
     function CocherTout() {
       const checkAll = document.querySelector("#allChecked");
       const checkInput = document.querySelectorAll(".list-group-table input[type=checkbox]");
       checkInput.forEach((inputcheck) => {
         inputcheck.onclick = () => {
           if (inputcheck.checked) {
             inputcheck.setAttribute("checked", "checked");
           } else {
             inputcheck.removeAttribute("checked");
           }
         };
       });
       if (checkAll) {
         checkAll.onclick = () => {
           if (checkAll.checked) {
             checkInput.forEach((inputcheck) => {
               if (!inputcheck.checked) {
                 //inputcheck.setAttribute("checked", "checked");
                 inputcheck.checked = true;
               }
             });
           } else {
             checkInput.forEach((inputcheck) => {
               if (inputcheck.checked) {
                 inputcheck.checked = false;
               }
             });
           }
         };
       }
     }
     /** Fin */
     /** Evenement lors du clic sur le bouton de suppression */
     $('.deleteAllArticles').on('click', function(e){
      e.preventDefault();
      var check = false;
      if($('#allChecked').is(':checked')){
        check = true;
      }
      if(!check){
        setTimeout(function(){
          $('.message--succes').hide()
        },450)  
        loadingfunc('.afficher--message','<p class="message--erreur"> IL faut cocher tous les champs</p>');
      }
      else{
        var url = $(this).attr("href");   
        $.ajax({
          url : url,
          method : "GET",
          success : function(data){
            loadingfunc('.list-group', data);
          }
        });
      }
     });
     /** Fin */
       /** Evenement lors du clic sur le bouton liste Categorie */
$('.viewListCommentaire').on('click', function(){
  $('.fa-eye').removeClass('active');
  $('.header-bloc-group').removeClass('active');
  $('.header-bloc-group-3').addClass('active');
    $(this).addClass('active');
    var url = './index.php?controller=comment&action=listCommentaire';
    $.ajax({
      url: url,
      method: "GET",
      success: function(data){
        loadingfunc('.list-group', data);
      }
    });
  })
  /** Fin */
});