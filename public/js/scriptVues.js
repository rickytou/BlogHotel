$(function(){
    /** Fonction loading */
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
    /** Evenement lors du clic sur le bouton de suppression */
    $('.deleteCategorie').on('click', function(e){
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
     /** Evenement lors du clic sur le lien Tout supprimer */
      /** Evenement lors du clic sur le bouton de suppression */
      $('.deleteAllCategories').on('click', function(e){
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

      /** Evenement lors du clic sur le bouton de suppression */
      $('.deleteAllArticles').on('click', function(e){
        e.preventDefault();
        alert('okey');exit;
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

     /** Afficher une categorie */
     $('.viewCategorie').on('click', function(e){
      e.preventDefault();
      var url = $(this).attr("href"); 
      $.ajax({
        url : url,
        method : "GET",
        success : function(data){
          loadingfunc('.form-updatecategorie', data, 'active');
        }
      });
     })
     /** Fin */
     /** Evenement quand on clique sur l'icon de fermeture (close) */
  $('.closeModifierCategorie').on('click', function(){
    $('.form-updatecategorie').removeClass('active');
    // window.location.reload();
  });
  $('.closeModifierArticle').on('click', function(){
    $('.form-updatearticle').removeClass('active');
    // window.location.reload();
  });
/** Soumission du fomulaire de modification de la categorie */
$('#updateModifierCategorie').on('submit', function(e){   
  e.preventDefault();
  var nomCategorie = $('#updatenomCategorie');
  var descriptionCategorie = $('#updatedescriptionCategorie');
  var id = $('#updateidCategorie');
  var actif = $('#actif');
  var invalid = false;
  if(!nomCategorie.val()){
    invalid = true;
  }
  if(invalid){
    nomCategorie.addClass('error');
  }
  else{
    var url = '../index.php?controller=categorie&action=updateCategorie&nomCategorie='+nomCategorie.val()+'&descriptionCategorie='+descriptionCategorie.val()+'&idCategorie='+id.val()+'&actif='+actif.val();
    $.ajax({
      url : url,
      method : "GET",
      success : function(data){
          $('.updateModifierCategorie').html(data);
        }
    })
  }

  });
  /** Enlever la bordure pour les champs error */
  $('#nomCategorie').on('input', function(){
    $(this).removeClass('error');
  });
  /** Desactive une categorie */
  $('.desactivatedCategorie').on('click', function(e){
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
   /** Active une categorie */
   $('.activatedCategorie').on('click', function(e){
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
$('#updateModifierArticle').on('submit', function(e){ 
  e.preventDefault();
  var nomArticle = $('#updatenomArticle');
  var descriptionArticle = $('#updatedescriptionArticle');
  var id = $('#updateidArticle');
  var idCategorie = $('.idCategorieArticle');
  var fileUploadImage = $('#uploadimage');
  var actif = $('#actif');
  var invalid = false;
  var dataArticle = [nomArticle, descriptionArticle];
  $.each(dataArticle, function(index, element){
    if(!$(element).val()){
      $(element).addClass('error');
      invalid = true;
    }
  });
   if(!invalid){
    var url = '../index.php?controller=article&action=updateArticle&nomArticle='+nomArticle.val()+'&descriptionArticle='+descriptionArticle.val()+'&idArticle='+id.val()+'&actif='+actif.val()+'&fileUploadImage='+fileUploadImage+'&idCategorie='+idCategorie.val();
    var formData = new FormData(this);
    $.ajax({
      type: "POST",
      url: url,
      data: formData,
      success: function(data){
        $('.updateModifierArticle').html(data);
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
  $("#updatenomArticle").on('input', function(){
    $(this).removeClass('error');
  });
  $("#updatedescriptionArticle").on('input', function(){
    $(this).removeClass('error');
  });
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

});