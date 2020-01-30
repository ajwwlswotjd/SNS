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

		document.querySelectorAll(".form-button-box > .form_btn").forEach(b=>{
			b.addEventListener("click",(e)=>{
				document.execCommand(b.dataset.property);
				document.querySelector(".editorDiv").focus();
			});
		});

		document.querySelector(".bgclr").addEventListener("click",(e)=>{
			document.querySelector("#bgc_input").click();

		});

		document.querySelector("#bgc_input").addEventListener("change",(e)=>{
			document.execCommand("backColor",false,e.target.value);
			document.querySelector(".editorDiv").focus();
		});

		document.querySelector(".clr").addEventListener("click",(e)=>{
			document.querySelector("#color_input").click();

		});

		document.querySelector("#color_input").addEventListener("change",(e)=>{
			document.execCommand("foreColor",false,e.target.value);
			document.querySelector(".editorDiv").focus();
		});

		document.querySelector("#form-image-add").addEventListener("click",(e)=>{
			let input = document.createElement("input");
			input.setAttribute("type", "file");
			input.setAttribute("multiple","");
			input.addEventListener("change",(e)=>{
				let fileList = Array.from(e.target.files);
				fileList.forEach(f=>{
					let img = new Image();
					let type = f.type.split("/")[0];
					if(type=="image"){ // 타입이 이미지임
						let reader = new FileReader();
						reader.readAsDataURL(f);
						reader.addEventListener("load",(e)=>{ // base64 완료
							let div = this.getImgPreviewTemp(f.name,reader.result);
							document.querySelector(".form-image-box").prepend(div);
						},false);
					} else {
						log(f);
					}
				});
			});
			input.click();
		});
	}

	getImgPreviewTemp(name,src){
		let div = document.createElement("div");
		div.classList.add("form-image-item-box");
		div.innerHTML = `
		<img src="${src}" alt="${name}" title="${name}">
		<div class="form-image-item-close">&times;</div>
		`;
		div.querySelector(".form-image-item-close").addEventListener("click",(e)=>{
			$(div).remove();
		});
		return div;
	}

}

window.addEventListener("load",(e)=>{
	let app = new App();
});