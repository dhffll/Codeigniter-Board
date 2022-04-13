let page = new URL(window.location.href).searchParams.get('page');
let index = page == null ? 1 : page;
$("#block a:contains("+index+")").css('color','red');
//해당 페이지에 효과주기

let sort = new URL(window.location.href).searchParams.get('sort');
if(sort!=null){
    $("#sort option").eq(sort-1).attr('selected','true');
}
//sort 파라미터에 따라 selectbox selected option 바꿔주기
