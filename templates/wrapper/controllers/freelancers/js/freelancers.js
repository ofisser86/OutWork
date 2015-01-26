
function getotziv(fid) {
	
	 $('html').append('<div id="addotziv"  style="position: fixet;"><div class="addotziv" ></div> </div>');
	$('.addotziv').append('<a href="#close" id="close_window" onclick="closeotziv();  return false;"></a>'); 
        $('.addotziv').append('<div class="conotziv"></div>');
$.post('/freelancers/otziv/'+fid,  function(data) {
		$('.conotziv').append(data);
			});	
}
function addotziv(fid, tupe) {
	$('.add-otziv'+tupe).append('<form action="" method="post" id="spec_search_form">'); 
	$('.add-otziv'+tupe).append('<textarea name="text" rows="3" style="width:400px;" class="text-textar"></textarea>'); 	
	$('.add-otziv'+tupe).append('<input type="submit" name="susend" id="submit" value="отправить" onclick="adenotziv(\''+fid+'\', \''+tupe+'\'); return false;"/>'); 
	$('.add-otziv'+tupe).append('</form>'); 
}	
function adenotziv(fid, tupe) {	
        var text = $(".text-textar").val();	
	    text=text.replace(/\n/g,'<br />');
	    $.post('/freelancers/addotziv/'+fid, { text: text, tupe: tupe},  function(){
	$.post('/freelancers/otziv/'+fid,  function(data) {
		$('.conotziv').html(data);
			});	
        });
  
}
	 function closeotziv() {
	 $('#addotziv').fadeOut(200, function(){
        $('#addotziv').remove();
      });
}


function addportfolio() {
	 $('#addportfolio').fadeOut(500, function(){
        $('#addportfolio').show();
      });
}
	 function closewportfolio() {
	 $('#addportfolio').fadeOut(200, function(){
        $('#addportfolio').hide();
      });
}

function adenportfolio(portfolioid) {
		$('#upportfolio').fadeOut(500, function(){
		$('#portfolio_id').val(portfolioid);
        $('#upportfolio').show();
      });
}
	 function closeuportfolio() {
	 $('#upportfolio').fadeOut(200, function(){
     $('#portfolio_id').val('');
     $('#upportfolio').hide();
      });
}

 function portfolio(title, img) {
	
	 $('html').append('<div id="portfolio" style=""><div class="portfolio" ></div> </div>');
	
	$('.portfolio').append('<a href="#close" id="close_window" onclick="closeportfolio();  return false;"></a>'); 
	$('.portfolio').append('<h2 class="con_heading">'+title+'</h2>');
	$('.portfolio').append('<img src="'+img+'" alt="" />');

}
	 function closeportfolio() {
	 $('#portfolio').fadeOut(200, function(){
        $('#portfolio').remove();
      });
}
	