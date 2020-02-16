class App {
	constructor(){
		this.init();
	}

	init(){
		let appThis = this;
		document.querySelector("#tab-menu > .tab2:last-child > ul > li:first-child").classList.add("active");

		if(document.querySelector(".profile-right-top > .profile-right-top-show >  button") != null){
			document.querySelector(".profile-right-top > .profile-right-top-show >  button").addEventListener("click",(e)=>{
				e.target.parentNode.style.display = "none";
				e.target.parentNode.parentNode.querySelector(".profile-edit-box").style.display = "flex";
				alert('별명은 20자 이하의 한국어, 영어, 숫자로만 구성되어있어야 합니다. (띄어쓰기 포함)');
				document.querySelector(".profile-edit-box > input").focus();
			});
		}
		if(document.querySelector(".profile-info-edit") != null){
			document.querySelector(".profile-info-edit").addEventListener("click",(e)=>{
				e.target.parentNode.style.display = "none";
				document.querySelector(".profile-right-input").style.display = "flex";
				alert("소개글은 최대 200자 까지만 작성 가능합니다. (띄어쓰기 포함)");
				document.querySelector("#profile-right-textarea").focus();
			});
		}

		document.querySelector("#profile-right-input-btn").addEventListener("click",(e)=>{
			let value = document.querySelector("#profile-right-textarea").value;
			if(value.length > 200){
				Swal.fire("글이 너무 깁니다.","소개글은 띄어쓰기를 포함하여 200자 이하로만 작성해야 합니다.","error");
				return;
			}
			let data = {};
			data.info = value;
			$.ajax({
				data:data,
				url:"/user/info",
				method:"post",
				success:(e)=>{
					alert("소개글이 변경되었습니다.");
					location.reload();
				}
			});
		});

		if(document.querySelector(".profile-img-change") != null){
			document.querySelector(".profile-img-change").addEventListener("click",(e)=>{
				let input = document.createElement("input");
				input.setAttribute("type","file");
				input.setAttribute("accept","image/*");
				input.addEventListener("input",(e)=>{
					let f = e.target.files[0];
					let type = f.type.split("/")[0];
					if(type=="image"){
						let formData = new FormData();
						formData.append("file",f);
						let ext = f.name.substring(f.name.lastIndexOf("."),f.name.length).toLowerCase();
						let fileName = ""+f.lastModified+f.size+ext;
						formData.append("name",fileName);
						let xhr = new XMLHttpRequest();
						xhr.open("POST","/user/img");
						xhr.addEventListener("load",(e)=>{
							alert("프로필 이미지가 변경되었습니다.");
							location.reload();
						});
						xhr.send(formData);
					}
				});
				input.click();
			});
		}
		if(document.querySelector(".notMe") != null){
			document.querySelector(".notMe").addEventListener("click",(e)=>{
				let status = e.target.dataset.status;
				let data = {};
				data.status = status;
				data.get = e.target.dataset.get;
				$.ajax({
					data:data,
					method:"post",
					url:"/user/friend",
					success : (e)=>{
						location.reload();
					}
				});
			});
		}

		if(document.querySelector(".profile-edit-box > .profile-edit-input-edit") != null){
			document.querySelector(".profile-edit-box > .profile-edit-input-edit").addEventListener("click",(e)=>{
				let value = e.target.parentNode.querySelector("input").value;
				value = value.replace(/(?:\r\n|\r|\n)/g, '<br/>');
				let userPtn = /^[a-z|A-Z|가-힣|0-9|\s]{1,20}$/;
				if(!userPtn.test(value) || value=="별명 미작성"){
					Swal.fire("형식 에러","별명은 20자 이하의 한국어,영어,숫자로만 구성되어있어야 합니다. (띄어쓰기 포함)","error");
					return;
				}
				let data = {};
				data.nick = value;
				$.ajax({
					data:data,
					url:"/user/nick",
					method:"post",
					success : (e)=>{
						alert("별명이 변경되었습니다.");
						location.reload();
					}
				});
			});
		}
	}
}

window.addEventListener("load",(e)=>{
	let app = new App();
});