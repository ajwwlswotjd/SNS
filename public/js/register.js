const email_ptn = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i

window.onload = function(){

}

function registerProcess(){

	if($.trim(join_name.value)==""){
		join_name.focus();
		Swal.fire('빈 값','사용자이름 항목을 작성해주시길 바랍니다.','warning');
		return false;
	}

	if($.trim(join_email.value)==""){
		join_email.focus();
		Swal.fire('빈 값','이메일 항목을 작성해주시길 바랍니다.','warning');
		return false;
	}

	if(!email_ptn.test($.trim(join_email.value))){
		join_email.focus();
		Swal.fire('올바르지 않은 형식','이메일 형식이 올바르지 않습니다.','warning');
		return false;
	}

	if($.trim(join_pwd1.value)==""){
		join_pwd1.focus();
		Swal.fire('빈 값','비밀번호 항목을 작성해주시길 바랍니다.','warning');
		return false;
	}

	if($.trim(join_pwd2.value)==""){
		join_pwd2.focus();
		Swal.fire('빈 값','비밀번호 확인 항목을 작성해주시길 바랍니다.','warning');
		return false;
	}

	if($.trim(join_pwd1.value) != $.trim(join_pwd2.value)){
		join_pwd2.focus();
		Swal.fire('비밀번호 불일치','비밀번호가 서로 다릅니다.','warning');
		return false;
	}

	if(!join_agree.checked){
		Swal.fire('약관 동의','이용약관에 동의하여주시길 바랍니다.','warning');
		return false;	
	}
	
	let data = {};
	data.name = join_name.value;
	data.email = join_email.value;
	data.pwd = join_pwd1.value;

	$.ajax({
		data:data,
		url:"/user/join",
		method:"POST",
		success : function(e){
			let json = JSON.parse(e);
			if(json.success) Swal.fire("회원가입 완료",`${data.name} 회원님, 가입해주셔서 감사합니다.`,"success").then((e)=> location.href = "/login");
			else {
				join_email.focus();
				Swal.fire("이메일 중복",`이미 가입된 이메일 입니다.`,"error");
			}
		}
	});
	return false;
}