window.addEventListener("load",(e)=>{
	let app = new App();
});

class App {

	constructor(){
		this.init();
		this.loadingData = false;
		this.showCnt = 0;
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
		const main = document.querySelector("#main");
		main.addEventListener("scroll",(e)=>{
			let scrollTop = $(main).scrollTop();
			let windowHeight = $(window).height()-95;
			let documentHeight = $(".main_box").height();
			let scrollBottom = documentHeight-scrollTop-windowHeight;
			if(Math.floor(scrollBottom <= 0)){
				if(this.loadingData) return;
				this.loadingData = true;
				$("#spinner").fadeIn();
				setTimeout((e)=>{
					$("#spinner").fadeOut();
					let div = this.getForm(10);
					document.querySelector(".news-part-container").appendChild(div);
					this.loadingData = false;
				},1500);
			}
		});

		$(document).on("click",".news-bottom-comment",(e)=>{
			e.target.parentNode.parentNode.querySelector(".news-comment-box").style.display = "inline-block";
		});
	}


	bringData(start,cnt){
		let data = {};
		data.start = start;
		data.cnt = cnt;
		$.ajax({
			data : data,
			url : "/board/load",
			method : "POST",
			success : function(e){
				
			}
		});
	}

	getForm(data){
		let div = document.createElement("div");
		div.classList.add("news_part");
		div.innerHTML = 
				`
				<div class="news-container">
					<div class="news-top">

						<div class="news-top-icon">
							<img src="/imgs/user.png" alt="">
							<!-- <i class="fas fa-user-circle"></i> -->
						</div>
						
						<div class="news-top-info">
							<span class="news-top-info-name">
								정재성인척하는정재성
							</span>
							<span class="news-top-info-date">
								2020년 2월 1일 오후 11:12						
							</span>
						</div>

						<div class="news-top-right">
							<i class="fas fa-ellipsis-v"></i>
						</div>
					</div>

					<div class="news-content">
						<div style="text-align: left;">fewfewfew</div><div style="text-align: left;">fewlfewpflewp[flewp[flewp[fwel[pfew</div><div style="text-align: left;"><span style="background-color: rgb(0, 0, 0);"><font color="#ffffff">l[Felw[pfewl[p</font></span></div><div style="text-align: left;"><span style="background-color: rgb(0, 0, 0);"><font color="#ffffff">fewlf[pewflew[</font></span></div><div style="text-align: left;"><span style="background-color: rgb(0, 0, 0);"><font color="#ffffff">pflewp[flewp[flewp[few</font></span></div><div style="text-align: left;"><span style="background-color: rgb(0, 0, 0);"><font color="#ffffff">fewfklew[pfkew[pfewkf[pewflew[pfelw[pfelfp[ewlfe[wfe</font></span></div><div style="text-align: left;"><span style="background-color: rgb(0, 0, 0);"><font color="#ffffff">ffewfwefewfewfe[</font></span></div><div style="text-align: left;"><span style="background-color: rgb(0, 0, 0);"><font color="#ffffff">liuliuliu</font></span></div><div style="text-align: left;"><font color="#ffffff"><span style="background-color: rgb(0, 0, 0);">r</span></font></div><div style="text-align: left;"><font color="#ffffff"><span style="background-color: rgb(0, 0, 0);">안녕하세요 가나다라마ㅏ사아자카타파하</span></font></div>
					</div>

					<div class="news-img-box">
						<img src="/imgs/vkeod_bg.png" alt="">
						<span>이외의 10가지 이미지 더 보기</span>
					</div>

					<div class="news-attr-box">
						<div class="news-attr-left">
							<i class="far fa-thumbs-up"></i>
							<span>120</span>
						</div>
						<div class="news-attr-right">
							<i class="far fa-comment"></i>
							<span>6</span>
						</div>
					</div>

					<div class="news-bottom">
						<button class="news-bottom-like">
							<i class="far fa-thumbs-up"></i>
							<span>좋아요</span>
						</button>

						<button class="news-bottom-comment">
							<i class="far fa-comment-dots"></i>
							<span>댓글쓰기</span>
						</button>
					</div>

					<div class="news-comment-box">
						<div class="news-comment-container">
							<div class="news-comment">
								<div class="news-comment-img"> 
									<img src="/imgs/user.png" alt="">
								</div>	

								<div class="news-comment-text">
									<div class="news-comment-name">
										정재성인척하는정재성
									</div>

									<div class="news-comment-content">
										가나다라마바사아자카타파하가나다라마바사아자카타파하가나다라마바사
									</div>

									<div class="news-comment-date">
										2019년 1월 31일 오후 11:12
									</div>
								</div>
							</div>
						</div>

						<div class="news-comment-form">
							<input type="text" placeholder="댓글을 남겨주세요">
							<div class="news-comment-form-img">
								<img src="/imgs/user.png" alt="">
							</div>
							<button type="submit">보내기</button>
						</div>
					</div>

					<div class="news-more-box">
						<ul class="news-more-box-container">
							<li>
								<i class="far fa-edit"></i>
								<span>수정</span>
							</li>
							<li>
								<i class="far fa-trash-alt"></i>
								<span>삭제</span>
							</li>
						</ul>
					</div>
				</div>
				`;
		return div;
	}
}