
<div id="search-pop" class="dento-pop text-left">
    <span class="grow-up"></span>
    <form id="search-pop-frm" action="/search" class="text-left" method="get" ng-controller="SearchPopController">
        <input type="text" name="key_word" class="form-control" placeholder="Nhập từ khóa"  value="{{SelectedTag.id}}" />
        <button id="search-pop-frm-btn" class="btn btn-primary">Tìm kiếm</button>
        <br />
    </form>
    <a style="margin-top: 20px" href="/search">Tìm kiếm nâng cao</a>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#search-pop-btn").click(function(e){
            $(".dento-pop").hide();
            $("#search-pop").toggle();
            return false;
        });
        $("#search-pop-frm").click(function(){return false;});
        $("#search-pop-frm-btn").click(function(e){
            $("#search-pop-frm").submit();
        });
    });
</script>
