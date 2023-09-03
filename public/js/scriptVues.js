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
     /** Evenement quand on clique sur le bouton de fermeture d'affichage de categorie */
       /** Evenement quand on clique sur l'icon de fermeture (close) */
  $('.closeModifierCategorie').on('click', function(){
    $('.form-updatecategorie').removeClass('active');
    window.location.reload();
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
    invalid = false;
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
});