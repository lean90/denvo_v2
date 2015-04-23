<div class="body-content width-960">
    <div class="list-view items-list width-960">
        <?php
        if ($isShowSearchPannel == 1) {
            include APPPATH .VIEW_PATH.'/search_frm.php';
        }
        ?>
        <?php
        
        foreach ( $posts as $post ) {
            $url = "{$post->part_url}-{$post->id}.html";
            $post->created_at = DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $post->created_at )->format ( 'd/m/Y' );
            $post->description = substr ( $post->description, 0, 255 ) . ' ... ';
            // $post->thumbnail = strpos($post->thumbnail,'http') !== false ? $post->thumbnail : '/thumbnail.php'.$post->thumbnail."?140";
            $shareButtonLink = common::getCurrentHost () . $url;
            $canbeEdit = Common::getCurrentUser ()->account_role == 'ADMIN' || Common::getCurrentUser ()->id == $post->user_id;
            $showAdminLink = $canbeEdit ? 'inline-block' : 'none';
            $editUrl = $url . '/edit.html';
            $deleteUrl = $url . '/remove.html?callback=' . urlencode ( Common::curPageURL () );
            echo " 
                <div class='item-in-list'>
                    <img src='{$post->thumbnail}' >
                    <a href='{$url}'>{$post->title}</a>
                    <div class='post-view'>{$post->created_at}</div>
                    <div class='post-action'>
                        <div class='category'>Chuyên mục : <a href='{$post->category_part_url}'>{$post->category_name}</a></div>
                        <div class='facebook'>
                            <div class='fb-like'
                            data-href='{$shareButtonLink}'
                            data-layout='button_count' data-action='like'
                            data-show-faces='true' data-share='true'></div>
                        </div>
                    </div>
                    
                </div>
            ";
        }
        ?>

        <div class="list-footer widtd-960 text-center">
            <ul class="pagination">
              <?php
            $pageNumber = ceil ( $postsCount / 10 );
            $params = null;
            parse_str ( $_SERVER ['QUERY_STRING'], $params );
            $page = isset ( $params ['page'] ) ? $params ['page'] : 0;
            $startPage = $page - 4;
            $endPage = $page + 5;
            $startPage = $startPage <= 0 ? 0 : $startPage;
            $endPage = $endPage >= $pageNumber ? $pageNumber : $endPage;
            // TODO: binding URL
            $allQuery = array ();
            parse_str ( $_SERVER ['QUERY_STRING'], $allQuery );
            
            $currentPath = $url = strtok ( $_SERVER ["REQUEST_URI"], '?' );
            $currentPath .= '?';
            $indexQueryString = 0;
            $haveOtherQueryString = false;
            foreach ( $allQuery as $key => $value ) {
                if ($key == "page") {
                    continue;
                }
                $currentPath .= $indexQueryString == 0 ? "{$key}={$value}" : "&{$key}={$value}";
                $indexQueryString ++;
                $haveOtherQueryString = true;
            }
            
            if ($startPage != 0) {
                $currentPart = $parrentPageCategory [count ( $parrentPageCategory ) - 1]->part_url;
                $partPrepage = ! $haveOtherQueryString ? $currentPath . "?page=" . ($page - 1) : $currentPath . "&page=" . ($page - 1);
                $targetPreGroup = ! $haveOtherQueryString ? $currentPath . "?page=" . $startPage : $currentPath . "&page=" . $startPage;
                echo "<li><a href='{$currentPart}'><span class='glyphicon glyphicon-fast-backward'></span></a></li>";
                echo "<li><a href='{$targetPreGroup}'>...</a></li>";
            }
            
            for($i = $startPage; $i < $endPage; $i ++) {
                $delta = $i + 1;
                $target = ! $haveOtherQueryString ? $currentPath . "?page=" . $i : $currentPath . "&page=" . $i;
                echo $page == $i ? "<li class='active'><a href='{$target}'>{$delta}</a></li>" : "<li><a href='{$target}'>{$delta}</a></li>";
            }
            
            if ($endPage != $pageNumber) {
                $targetNextGroup = ! $haveOtherQueryString ? $currentPath . "?page=" . $endPage : $currentPath . "&page=" . $endPage;
                $endPageUrl = ! $haveOtherQueryString ? $pageNumber . "?page=" . $endPage : $pageNumber . "&page=" . $endPage;
                echo "<li><a href='{$targetNextGroup}'>...</a></li>";
                echo "<li><a href='{$endPageUrl}'><span class='glyphicon glyphicon-fast-forward'></span></a></li>";
            }
            ?>
            </ul>
        </div>
        <div class="item-in-list" style="display: none">
            <img href="#"> <a href="#">Nắn chỉnh chăm sóc răng miệng Nắn chỉnh chăm sóc răng miệng</a>
            <div class="post-view">
                16/08/2014 <span> | </span> Số lần xem : 1000 lượt
            </div>
            <div class="post-desc">
                Multiple function calls can be made if you need several joins in one query.If you need a specific type of JOIN you can specify it via the third parameter of the function. Options are: left, right, outer, inner, left outer, and right outer... <a href="#">Xem tiếp</a>
            </div>
            <div class="post-action">
                <div class="category">
                    Chuyên mục : <a href="#">Tin tức</a>
                </div>
                <div class="facebook"></div>
            </div>
        </div>
    </div>
</div>
