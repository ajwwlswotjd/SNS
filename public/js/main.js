window.addEventListener("load",(e)=>{
	let app = new App();
});

class App {

	constructor(){
		this.init();
		this.loadingData = false;
	}


	init(){
		document.querySelector(".form_part").addEventListener("click",(e)=> location.href = "/form");
		$("#tab-menu > .tab2").eq(0)[0].querySelector("ul > li:first-child").classList.add("active");

		document.querySelector(".news-top-right").addEventListener("click",(e)=>{
			e.stopImmediatePropagation();		
			let dom = e.target.parentNode.parentNode.parentNode.querySelector(".news-more-box");
			dom.style.display = dom.style.display == "block" ? "none" : "block";
		});

		window.addEventListener("scroll",(e)=>{
			document.querySelectorAll(".news-more-box").forEach(x=> x.style.display = "none");
		});

		window.addEventListener("click",(e)=>{
			document.querySelectorAll(".news-more-box").forEach(x=> x.style.display = "none");
		});

		document.querySelector(".last-part").addEventListener("click",(e)=>{
			$("#main").animate({scrollTop : 0},300);
		});

		window.addEventListener("scroll",(e)=>{
			let scrollTop = $(document).scrollTop();
			let windowHeight = $(window).height();
			let documentHeight = $(document).height();
			let scrollBottom = documentHeight - scrollTop - windowHeight;
			if(Math.floor(scrollBottom <= 0)){
				if(this.loadingData) return;
				this.loadingData = true;

			}
		});

		$(document).on("click",".news-bottom-comment",(e)=>{
			e.target.parentNode.parentNode.querySelector(".news-comment-box").style.display = "inline-block";
		});
	}

	getForm(data){
		return ``;
	}
}