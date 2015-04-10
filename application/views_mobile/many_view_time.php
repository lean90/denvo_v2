<div class="many-view-item-container">
	<div class="many-view-item-header">
		<span class="title" style="width:100%">Nổi bật</span>
	</div>
	<!--     <div class="many-view-item" style="display: none"> -->
	<!--         <img /> -->
	<!--         <div class="title"><a href="#">Sâu răng: diễn biến, nguyên nhân, điều trị và dự phòng</a></div> -->
	<!--         <div class="infor">16/08/2014   |   Số lần xem: 1000 lượt </div> -->
	<!--         <div class="social"></div> -->
	<!--     </div> -->
    <?php
				foreach ( $manyViewPosts as $manyViewpost ) {
					$url = "{$manyViewpost->part_url}-{$manyViewpost->id}.html";
					$manyViewpost->created_at = DateTime::createFromFormat ( DatabaseFixedValue::DEFAULT_FORMAT_DATE, $manyViewpost->created_at )->format ( 'd/m/Y' );
					$shareButtonLink = str_replace("http://m.", "http://", common::getCurrentHost ()) . $url;
					echo "
            <div class='many-view-item'>
                <img src='{$manyViewpost->thumbnail}' />
                <div class='title'><a href='{$url}'>{$manyViewpost->title}</a></div>
                <div class='infor'>{$manyViewpost->created_at}   |   Số lần xem: {$manyViewpost->view_count} lượt </div>
                <div class='social'>
                    <div class='fb-like'
                    data-href='{$shareButtonLink}'
                    data-layout='button_count' data-action='like'
                    data-show-faces='true' data-share='true'></div>
                </div>
            </div>
        ";
				}
				?>
    
    
</div>