class App {
	constructor(){
		this.init();
	}

	init(){
		let appThis = this;
		document.querySelector("#tab-menu > .tab2:last-child > ul > li:first-child").classList.add("active");
		document.querySelector(".profile-right-top > .profile-right-top-show >  button").addEventListener("click",(e)=>{
			e.target.parentNode.style.display = "none";
			e.target.parentNode.parentNode.querySelector(".profile-edit-box").style.display = "flex";
			alert('별명은 10글자 이하의 한국어, 영어, 숫자로만 구성되어있어야 합니다. (띄어쓰기 불가)');
			document.querySelector(".profile-edit-box > input").focus();
		});
		document.querySelector(".profile-edit-box > .profile-edit-input-edit").addEventListener("click",(e)=>{
			let value = e.target.parentNode.querySelector("input").value;
			let userPtn = /^[a-z|A-Z|가-힣|0-9|\*]{1,30}$/;
			if(!userPtn.test(value) || value=="별명 미작성"){
				Swal.fire("형식 에러","별명은 30글자 이하의 한국어,영어,숫자로만 구성되어있어야 합니다.","error");
				return;
			}
			let data = {};
			$.ajax({
				data:data,
				url:"/user/name",
				method:"post",
				success : (e)=>{
					location.reload();
				}
			});
		});
	}
}

window.addEventListener("load",(e)=>{
	let app = new App();
});