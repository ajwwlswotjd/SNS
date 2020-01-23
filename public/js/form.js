class App {

	constructor(){
		this.boldStatus = false;
		this.italicStatus = false;
		this.underlineStatus = false;
		this.strikeStatus = false;

		this.init();
	}

	init(){
		$("#tab-menu > .tab2").eq(0)[0].querySelector("ul > li:last-child").classList.add("active");

		document.querySelectorAll(".form-button-box > button").forEach(b=>{
			b.addEventListener("click",(e)=> document.execCommand(b.dataset.property));
		});
	}

}

window.addEventListener("load",(e)=>{
	let app = new App();
});