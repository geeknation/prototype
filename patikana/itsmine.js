jQuery(document).ready(function($){
	$("#verifybutton").click(function(){
		
		var names=$("#attemptnames").val();
		var prompt=$("#prompt");
		if(names=='' || names==null)
		{
			prompt.text("enter your names to fully claim your lost document");
		}
		else{
			$('#verifyform').submit();
		}
	});
});
