$(document).ready(function() {
	setHeight();
	headerFn();
	//partnerWrap();

	$(window).resize(function() {
		setHeight();
		//partnerWrap();
	});

});

//GNB-메인-높이값세팅
function setHeight(){
	var wH = $(window).innerHeight();
	$(".gnb_wrap").css("height",wH);
}

//HEADER
function headerFn(){
	var wH = $(window).innerHeight(),
		 btnOpen = $(".menu_open"),
		 btnClase = $(".close"),
		 btnBack = $(".over_back"),
		 topV ;

	btnOpen.on("click", function() {
		var $this = $(this);
		$this.parent().addClass("open");
		$("body").addClass("h_hidden");
	});

	btnClase.on("click", function() {
		var $this = $(this);
		setTimeout(function() {
			$this.closest(".open").removeClass("open");
			$("body").removeClass("h_hidden");
		}, 200);
	});

	btnBack.on("click", function() {
		var $this = $(this);
		setTimeout(function() {
			$this.closest(".open").removeClass("open");
			$("body").removeClass("h_hidden");
		}, 200);
	});

}




