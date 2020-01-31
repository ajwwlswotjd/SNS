class App {

	constructor(){
		this.boldStatus = false;
		this.italicStatus = false;
		this.underlineStatus = false;
		this.strikeStatus = false;
		this.fileList = [];
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
			input.setAttribute("accept","image/*");
			input.addEventListener("change",(e)=>{
				let fileList = Array.from(e.target.files);
				fileList.forEach(f=>{
					let type = f.type.split("/")[0];
					if(type=="image"){ // 타입이 이미지임
						let reader = new FileReader();
						reader.addEventListener("load",(e)=>{ // base64 완료
							let div = this.getImgPreviewTemp(f.name,reader.result,f);
							document.querySelector(".form-image-box").prepend(div);
							this.fileList.push(f);
						},false);
						reader.readAsDataURL(f);
					}
				});
			});
			input.click();
		});

		document.querySelector(".form-image-box").addEventListener("dragover",(e)=> {
			e.preventDefault();
		});

		document.querySelector(".form-image-box").addEventListener("drop",(e)=>{
			e.preventDefault();
			let fileList = Array.from(e.dataTransfer.files);
			fileList.forEach(f=>{

				let type = f.type.split("/")[0];
				if(type=="image"){
					let reader = new FileReader();
					reader.addEventListener("load",(e)=>{ // base64 완료
						let div = this.getImgPreviewTemp(f.name,reader.result,f);
						document.querySelector(".form-image-box").prepend(div);
						this.fileList.push(f);
					},false);
					reader.readAsDataURL(f);
				}
			});
		});

		document.querySelector(".form-submit").addEventListener("click",(e)=>{
			let value = document.querySelector(".editorDiv").innerHTML;

			if($.trim(value)=="" && this.fileList.length==0){ // 게시조건 불충족
				Swal.fire('글을 작성해주세요.',"입력칸이 비었습니다. 당신의 새로운 소식을 전해주세요!",'warning');
				return;
			}

			if(this.fileList.length > 0){

				this.fileList.forEach(f=>{

					let formData = new FormData();
					formData.append("file",f);
					log(f);
					
					let xhr = new XMLHttpRequest();
					xhr.open("POST","/board/upload");
					xhr.addEventListener("load",(e)=>{
						let json = JSON.parse(xhr.responseText);
						// log(json);
					});
					xhr.addEventListener("progress",(e)=>{
						// log(e.loaded/e.total)*100;
					});
					xhr.send(formData);

				});

			}
		});
	}

	getImgPreviewTemp(name,src,file){
		let div = document.createElement("div");
		div.classList.add("form-image-item-box");
		div.setAttribute("title",name);
		div.innerHTML = `
		<img src="${src}" alt="${name}">
		<div class="form-image-item-close">&times;</div>
		`;
		div.querySelector(".form-image-item-close").addEventListener("click",(e)=>{
			$(div).remove();
			let fIdx = this.fileList.findIndex(f=> f.name==file.name);
			this.fileList.splice(fIdx,1);
		});
		return div;
	}
}

window.addEventListener("load",(e)=>{
	let app = new App();
});