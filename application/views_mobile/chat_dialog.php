<?php
$supporters = get_instance ()->getSupporter ();
?>
<div id="chat-dialog" class="modal fade" ng-controller="ChatController">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Đóng</span>
                </button>
                <h4 class="modal-title">TRỢ GIÚP</h4>
            </div>
            <div class="modal-body" style="display: inline-block">
                <ul class="chat-dialog-modal">
                    <li><a href="/dento-chat"></a></li>
                    <li><a href="ymsgr:sendim?<?php echo $supporter->yahooAccount; ?>"></a></li>
                    <li><a href="javascript:void(0)" onclick="window.open('/send_mail','Gửi liên hệ','toolbar=1,location=1,directories=0,status=0,menubar=1,scrollbars=1,resizable=1,copyhistory=0,width=550,height=650')"></a></li>
                    <li><a href="skype:<?php echo $supporter->skypeAccount; ?>?chat"></a></li>
                    <li><a href="<?php echo $supporter->facebookUrl; ?>"></a></li>
                    <li><a href="callto:<?php echo $supporter->viberAccount; ?>"></a></li>
                </ul>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">
    function openChatDialog(){
        $("#chat-dialog").modal();
    }
    var supporters = <?php echo json_encode($supporters); ?>;
</script>