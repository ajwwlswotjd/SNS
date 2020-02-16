window.addEventListener("load",(e)=>{
	let app = new App();
});

class App {

	constructor(){
		this.init();
		this.loadingData = false;
		this.nowIndex = 0;
		this.showCnt = 5;
		this.totalCnt = 0;
		this.bringData();
	}


	async init(){

		let appThis = this;

		document.querySelector(".form_part").addEventListener("click",(e)=> location.href = "/form");
		$("#tab-menu > .tab2").eq(0)[0].querySelector("ul > li:first-child").classList.add("active");

		$(document).on('click',".news-top-right",function(e){
			e.stopImmediatePropagation();		
			let dom = this.parentNode.parentNode.parentNode.querySelector(".news-more-box");
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

		const main = document.querySelector("#main");

		main.addEventListener("scroll",(e)=>{
			let scrollTop = $(main).scrollTop();
			let windowHeight = $(window).height()-95;
			let documentHeight = $(".main_box").height();
			let scrollBottom = documentHeight-scrollTop-windowHeight;
			if(Math.floor(scrollBottom) <= 0){
				this.bringData();
			}
		});

		$(document).on("click",".news-top-icon",function(e){
			location.href = "/user/profile/?id="+this.parentNode.dataset.id;
		});

		$(document).on("click",".news-top-info",function(e){
			location.href = "/user/profile/?id="+this.parentNode.dataset.id;
		});

		$(document).on("click",".news-attr-right",function(e){
			this.parentNode.parentNode.querySelector(".news-bottom > .news-bottom-comment").click();
		});

		$(document).on("click",".news-bottom-comment",function(e){
			appThis.loadComment(this);
		});

		$(document).on('keydown',".news-comment-form > input",(e)=>{
			if(e.keyCode == 13) e.target.parentNode.querySelector("button").click();
		});
		
		$(document).on("click",".news-more-box-container > li:last-child",function(e){
			let data = {};
			data.board = this.dataset.board;
			$.ajax({
				data:data,
				url:"/board/delete",
				method:"POST",
				success : (e)=>{
					location.reload();
				}
			});
		});

		let slider = $(".image-box-container");
		let isSliding = false;
		let now = 0;
		let length = 0;
		let imgs = $(".image-box-container img");
		$(".image-btn-box > button").on("click",function(e){
			let dir = $(this).data("dir");
			if(isSliding) return;
			isSliding = true;
			if(dir==0){
				let next = now > 0 ? now - 1 : length;
				$(imgs[now]).animate({right:"-100%"},1000,function(){isSliding = false});
				$(imgs[next]).css({right:"100%"}).animate({right:0},1000);
				now = next;
				document.querySelector(".image-index > span:first-child").innerHTML = now+1;
			}else {
				let next = now < length ? now + 1 : 0;
				$(imgs[now]).animate({right:"100%"},1000,function(){isSliding = false});
				$(imgs[next]).css({right:"-100%"}).animate({right:0},1000);
				now = next;
				document.querySelector(".image-index > span:first-child").innerHTML = now+1;
			}
		});

		document.querySelector("#image-popup").addEventListener("click",function(e){
			if(e.target==this || e.target==document.querySelector(".image-popup-close")) $(this).fadeOut();
		});

		$(document).on("click",".news-img-box > span",(e)=>{
			let data = {};
			data.board = e.target.dataset.board;
			$.ajax({
				data:data,
				method:"post",
				url:"/board/load/img",
				success: function(e){
					let json = JSON.parse(e);
					now = 0;
					$(".image-box-container").html("");
					json.list.forEach(x=>{
						let img = document.createElement("img");
						img.src = x.src;
						$(".image-box-container").append(img);
					});
					imgs = $(".image-box-container img");
					$(".image-box-container img").css({position : "absolute", right : "100%"});
					length = imgs.length-1;
					document.querySelector(".image-index > span:last-child").innerHTML = length+1;
					$(".image-box-container img").eq(0).css({right:0, position:'relative'});
					$("#image-popup").fadeIn();
				}
			});
		});

		$(document).on("click",".news-bottom-like",function(e){
			let data = {};
			data.idx = this.dataset.board;
			data.now = $(this).hasClass("likeTrue");
			$.ajax({
				data:data,
				url:"/board/like",
				method : "POST",
				success : (e)=>{ 
					$(this).toggleClass("likeTrue");
					$(this).toggleClass("likeFalse");
					$(this.querySelector("i")).toggleClass("fas");
					$(this.querySelector("i")).toggleClass("far");
					let json = JSON.parse(e);
					this.parentNode.parentNode.querySelector(".news-attr-box > .news-attr-left > span").innerHTML = json.cnt;
				}
			});
		});

		$(document).on("click",".news-comment-form > button", function(e){
			let value = this.parentNode.querySelector("input").value;
			if($.trim(value)=="") return;
			else {
				let data = {};
				data.content = value;
				data.board = this.dataset.board;
				$.ajax({
					data:data,
					url:"/board/comment",
					method:"POST",
					success : (e)=>{
						this.parentNode.querySelector("input").value = "";
						appThis.loadComment(this.parentNode.parentNode.parentNode.querySelector(".news-bottom > .news-bottom-comment"));
					}
				});
			}
		});
	}


	loadComment(btn){
		let board_idx = btn.dataset.board;
		let data = {};
		data.idx = board_idx;
		let commentBox = btn.parentNode.parentNode.querySelector(".news-comment-box");
		commentBox.style.display = "block";
		$.ajax({
			data:data,
			url:"/board/comment/load",
			method:"POST",
			success: (e)=>{
				let json  = JSON.parse(e);
				commentBox.querySelector(".news-comment-container").innerHTML = "";
				commentBox.parentNode.querySelector(".news-attr-box > .news-attr-right > span").innerHTML = json.list.length;
				json.list.forEach(x=>{
					let div = this.getCommentForm(x);
					commentBox.querySelector(".news-comment-container").appendChild(div);
				});	
			}
		});
	}

	getCommentForm(data){
		let div = document.createElement("div");
		div.classList.add("news-comment");
		div.innerHTML = 
		`<div class="news-comment-img"> 
				<img src="${data.user.profile}" alt="">
		</div>	
		<div class="news-comment-text">
			<div class="news-comment-name">
				${data.user.name}
			</div>
			<div class="news-comment-content">
				${data.comment.content}
			</div>
			<div class="news-comment-date">
				${this.dateToString(data.comment.date)}
			</div>
		</div>`;
		return div;
	}


	bringData(){

		if(this.loadingData) return;
		this.loadingData = true;
		let data = {};
		data.cnt = this.showCnt;
		data.start = this.nowIndex;
		log("나 에이젝스 보낼께!");
		// $.ajax({
		// 	data : data,
		// 	url : "/board/load",
		// 	method : "POST",
		// 	success : (e)=>{
		// 		log(e);
		// 		let json = JSON.parse(e);
		// 		setTimeout((e)=>{
		// 			$("#spinner").fadeOut();
		// 		 	if(json.total) $(".last-part").fadeIn();
		// 		 	this.nowIndex = json.nowIndex;
		// 		 	json.list.forEach(x=>{
		// 		 		let div = this.getForm(x);
		// 		 		document.querySelector(".news-part-container").appendChild(div);
		// 		 	});
		// 		 	this.loadingData = false;
		// 		 },10);
		// 	}
		// });
	}

	getForm(data){
		let div = document.createElement("div");
		div.classList.add("news_part");
		div.innerHTML = `
			<div class="news-container">
						<div class="news-top" data-id="${data.user.id}">

							<div class="news-top-icon">
								<img src="${data.user.profile}" alt="">
							</div>

							<div class="news-top-info">
								<span class="news-top-info-name">
									${data.user.name}
								</span>
								<span class="news-top-info-date">
									${this.dateToString(data.board.date)}
								</span>
							</div>
							
							<div class="news-top-right">
								${data.host ? `<i class="fas fa-ellipsis-v"></i>` : ""}
							</div>
						</div>

						<div class="news-content">
							${data.board.content}
						</div>

						<div class="news-img-box">
							${ data.imgs.length > 0 ? `<img src="${data.imgs[0].src}" alt="">` : "" }
							${ data.imgs.length > 1 ? `<span data-board='${data.board.id}'>이외의 ${data.imgs.length-1}가지 이미지 더 보기</span>` : ""}
						</div>

						<div class="news-attr-box">
							<div class="news-attr-left">
								<i class="far fa-thumbs-up"></i>
								<span>${data.likeList.toLocaleString()}</span>
							</div>
							<div class="news-attr-right">
								<i class="far fa-comment"></i>
								<span>${data.comments.toLocaleString()}</span>
							</div>
						</div>

						<div class="news-bottom">
							<button class="news-bottom-like ${data.like ? 'likeTrue' : 'likeFalse'}" data-board="${data.board.id}">
								<i class="fa${data.like ? 's' : 'r'} fa-thumbs-up"></i>
								<span>좋아요</span>
							</button>

							<button class="news-bottom-comment" data-board="${data.board.id}">
								<i class="far fa-comment-dots"></i>
								<span>댓글쓰기</span>
							</button>
						</div>

						<div class="news-comment-box">
							<div class="news-comment-container">

							</div>
							<div class="news-comment-form">
								<input type="text" placeholder="댓글을 남겨주세요">
								<div class="news-comment-form-img">
									<img src="${$("#user-info-img").attr("src")}" alt="">
								</div>
								<button type="submit" data-board="${data.board.id}">보내기</button>
							</div>
						</div>

						<div class="news-more-box">
							<ul class="news-more-box-container">
								${data.host ? `<li data-board="${data.board.id}"><i class="far fa-edit"></i><span>수정</span></li>` : ""}
								${data.host ? `<li data-board="${data.board.id}"><i class="far fa-trash-alt"></i><span>삭제</span></li>` : ""}
							</ul>
						</div>
					</div>
		`;
		return div;
	}

	dateToString(date){
		date += "";
		let dateArr = date.split(":");
		let today = new Date();
		let dateTemp = new Date();
		dateTemp.setFullYear(dateArr[0],dateArr[1]-1,dateArr[2]);
		dateTemp.setHours(dateArr[3],dateArr[4],dateArr[5],0);
		let diff = (today - dateTemp)/1000;
		if(diff < 0){
			let ojh = dateArr[3] > 11 ? "오후" : "오전";
			let hour = dateArr[3] > 12 ? dateArr[3]-12 : dateArr[3];
			let str = dateArr[0]+"년 "+this.delZero(dateArr[1])+"월 "+this.delZero(dateArr[2])+"일 "+ojh+" "+hour+":"+dateArr[4];
			return str;
		}
		else if(diff < 60) return Math.floor(diff)+"초 전";
		else if(diff < 3600) return Math.floor(Math.ceil(diff/60))+"분 전";
		else if(diff < 86400) return Math.floor(Math.ceil(diff/3600))+"시간 전";
		else if(diff < 604800) return Math.floor(Math.ceil(diff/86400))+"일 전";
		else if(diff < 2592000) return Math.floor(Math.ceil(diff/604800))+"주 전";
		else if(diff < 31104000) return Math.floor(Math.ceil(diff/2592000))+"달 전";
		else {
			let ojh = dateArr[3] > 11 ? "오후" : "오전";
			let hour = dateArr[3] > 12 ? dateArr[3]-12 : dateArr[3];
			let str = dateArr[0]+"년 "+this.delZero(dateArr[1])+"월 "+this.delZero(dateArr[2])+"일 "+ojh+" "+hour+":"+dateArr[4];
			return str;
		}
		
	}

	preZero(text){
		let txt = "0"+text;
		return txt.substring(txt.length-2,txt.length);
	}

	delZero(text){
		let txtArr = text.split("");
		return txtArr[0]=="0" ? text.substring(text.length-1,text.length) : text;
	}
}