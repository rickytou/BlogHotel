$(function(){
  /** Evenement sur le menuburger */
 $('.menu').on('click', () => {
  $('.menulink').toggleClass('active');
  $('#wrapper').toggleClass('active');
 })
 /** Evenement sur le lien du menu */
 $('.menulink li a').on('click', function(){
  $('.menulink li').removeClass('active');
  $(this).parent().addClass('active');
 });

 /**
 * Evenement sur la navigation a droite pour la section temoignages
 */
 $('.temoignages__navigation__right').on('click',function(){
  var temoignages = $('.temoignages__bloc__group');
  var tem;
  var compteur;
  $.each(temoignages, function(index,temoignage){
    if(temoignage.classList.contains('active')){
      $(temoignage).removeClass('active');
      compteur = index;   
      tem = temoignage;    
    }      
  });
  if(compteur < temoignages.length - 1){
  var t = $(tem);
  var trans = (compteur+1) * -102 +'%'; 
    $(t).css('transform','translateX('+trans+')');
    $(t).next().addClass('active');
    $(t).nextAll().css('transform','translateX('+trans+')');
    // var moitieTemoignages = Math.floor(temoignages.length / 2) + 1;
    // console.log(moitieTemoignages);
    if((compteur == temoignages.length - 2)){
      $(this).removeClass('active');
      $('.temoignages__navigation__left').addClass('active');
    }
  } 
});

/**
* Evenement sur la navigation a gauche pour la section temoignages
*/
$('.temoignages__navigation__left').on('click',function(){
var compteur; 
var temoignages = $('.temoignages__bloc__group');
$.each(temoignages, function(index,temoignage){
  if(temoignage.classList.contains("active")){
    $(temoignage).removeClass('active');
    }
    $(temoignage).css('transform','translateX(0)');
    
});
temoignages[0].classList.add('active');
$(this).removeClass('active');
$('.temoignages__navigation__right').addClass('active');
});

});