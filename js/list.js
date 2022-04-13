function check(){
    if(confirm("정말 삭제하시겠습니까?")){
        return true;
    }else{
        return false;
    }
}

function comment_save(num){
    $.ajax({
        type: 'POST',
        url: 'comment_save.php',
        data: {
            num : num,
            comment: $("#comment").val()
        },
        success: function(data){
            location.reload();
        }
    })
}

function comment_delete(id){
    $.ajax({
        type: 'POST',
        url: 'comment_delete.php',
        data: {
            num : id
        },
        success: function(data){
            location.reload();
        }
    })
}