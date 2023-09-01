$(function(){
  /** Evenement sur l'icon de l'utilisateur */
  $('.account .fa-circle-user').on('click', function(){
   $('.sous-menu').toggleClass('active');
  });
  /** Evenement sur le click ajouter */
  $('.addArticleBlog').on('click', function(){
    $('#article').addClass('active');
  });
  /** Evenement quand on clique en dehors du popup "Ajouter Article" */
  $('#article .fa-close').on('click', function(){
    $('#article').removeClass('active');
  });
  
  /** Evenement pour le formulaire d'ajout d'un article */
  $('#form-ajouter-article').on('submit', function(e){
    e.preventDefault();
    var titre = $('#titre');
    var tags = $('#tags');
    var desc = $('#desc');
    var dataArticle = [titre,tags,desc];
    var invalid = false;
    $.each(dataArticle, function(index, element){
      if(!element.val()){
        invalid = true;
        element.addClass('error');
      }
    });
    if(!invalid){
      var url = '../index.php?controller=article&action=addArticle';
      $.ajax({
        url : url,
        method : "GET",
        success : function(data){
            console.log(data);
        }
      })
    }
  });
  /**  */
  $("#titre").on('input', function(){
    $(this).removeClass('error');
  });
  $("#tags").on('input', function(){
    $(this).removeClass('error');
  });
  $("#desc").on('input', function(){
    $(this).removeClass('error');
  });
});