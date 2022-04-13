function test(){
    let id = document.getElementById("id");
    let info = document.getElementById("info");
    let test = document.getElementById("test");

    $.ajax({
        type: 'POST',
        url: 'check_id.php',
        data: {
            id: id.value
        },
        success: function(data){
            if(data==0){
                info.innerText = "사용 중인 아이디입니다";
            }else{
                test.style.display="none";
                info.innerHTML = "사용 가능한 아이디입니다 <a href='resister.php'>reset</a> ";
                id.readOnly = true;
            }
        }
    })

}

function check(){

    let pw = document.getElementById("pw").value;
    let pw2 = document.getElementById("pw2").value;

    if(id.readOnly != true){
        alert("아이디 중복 체크를 해주세요.");
        return false;
    }else if(pw != pw2){
        alert("비밀번호가 일치하지 않습니다.");
        return false;
    }else{
        return true;
    }
}