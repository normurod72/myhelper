
var ph;
window.onload = function(){
	var array=["Home cleaning", "iPhone 6 screen repair", "Laptop keybord repair", "Home redocoration"];
	if(document.getElementById("searchBox")){
    ph = new placeHolderEffect(document.getElementById("searchBox"), array);
  	ph.start();
  }
}


$(document).ready(function () { 
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});

function navbar_fixed_onscroll(){
	var scrolled_val = $(document).scrollTop().valueOf();
	if(scrolled_val<50){
		$(".navbar-wrapper").css({
		  	left:"0",
	    	top: "0",
	    	backgroundColor:"transparent",
	    	position:"absolute",
	    	transition:"0.3s",
	    	top:"0",
	    	boxShadow:"0px 0px 0px 0px black"
		});
		$(".navbar-wrapper .hms-navbar").css({
			position:"relative",
		});
	}else if(scrolled_val>75){
		$(".navbar-wrapper").css({
			left:"0",
	    	top: "0",
	    	backgroundColor:"#2495d0",
	    	position:"fixed",
	    	transition:"0.5s",
	    	top:"-15px",
	    	marginTop: "0",
	    	boxShadow:"0px 0px 4px 0px black"
		});
		$(".navbar-wrapper .hms-navbar").css({
		  	position:"relative",
		  	top:"15px"
		});
	}		
}