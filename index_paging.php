<?php 
    //정렬
    $sort = $_GET['sort'];
    if(empty($sort)){ //파라미터에 sort가 없으면 기본값은 최신순
        $sort = 1;
    }
    if($sort==1){
        $order = 'DESC';
    }else if($sort==2){
        $order = 'ASC';
    }


    //페이지네이션 개수를 위해 전체 데이터 개수 가져오기
    $search = $_GET['search'];
    if(empty($search)){
        $sql = "select * from board"; //검색 없이 전체 데이터
    }else{
        $sql = "select * from board where title like '%$search%' order by date {$order}"; //검색에 따른 데이터
    }

    $result = mysqli_query($con,$sql);
    $total_data = mysqli_num_rows($result); //검색 유무에 따른 데이터 개수


    //페이징 구현
    $data_num = 3; //한 페이지에 보여줄 게시물
    $page_num = 3; //한 페이지에 보여줄 블럭

    $page_total = ceil($total_data/$data_num); //전체 페이지
    $block_total = ceil($page_total/$page_num); //전체 블럭
            
    $page_now = isset($_GET['page']) ? $_GET['page'] : 1; //현재 페이지
    $block_now = ceil($page_now/$page_num); //현재 블럭

    $from = ($page_now-1) * $data_num;
    //페이징에 필요한 변수 끝
    

    //데이터 가져오기
    if(empty($search)){ //검색없이 게시물 전부 보여주기
        $sql = "select * from board order by date {$order} limit {$from}, {$data_num}";
    }else if(strlen($search)>0){ //파라미터에 검색이 있으면 검색 내용만 보여주기
        $sql = "select * from board where title like '%$search%' order by date {$order} limit {$from}, {$data_num}";
    }
    $result = mysqli_query($con,$sql);


    //페이지네이션
    $start = ($block_now-1)*$page_num+1; //첫번째 페이지네이션
    if($start == 0){
        $start = 1;
    }

    $end = $block_now * $page_num; //마지막 페이지네이션
    if($end > $page_total){
        $end = $page_total;
    }
?>