<div class="body-content width-960">
    <div class="detail-view post-view width-960">
        <div class="left">
            <div class="form-group col-md-4">
                <img height="140px" width="140px" alt="" src="<?php echo $me->avartar; ?>">
            </div>
            <div class="form-group col-md-8">
                <label>Họ tên :</label> <label style="color: #0F75BC"><?php echo $me->full_name;?></label>
            </div>
            <div class="form-group col-md-8">
                <label for="thumbnail">Ngày sinh : </label> <label style="color: #0F75BC"> <?php echo DateTime::createFromFormat(DatabaseFixedValue::DEFAULT_FORMAT_DATE, $me->dob)->format('d/m/Y');?></label>
            </div>
            <div class="form-group col-md-8">
                <label for="thumbnail">Giới tính : </label> <label style="color: #0F75BC"> 
                        <?php
																								switch ($me->gender) {
																									case 'MALE' :
																										echo 'Nam';
																										break;
																									case 'FMALE' :
																										echo 'Nữ';
																										break;
																									case 'OTHER' :
																										echo 'KHÁC';
																										break;
																								}
																								?>
                    </label>
            </div>
            <div class="form-group col-md-8">
                <label>Email :</label> <label style="color: #0F75BC"><?php echo $me->email;?></label>
            </div>
            <div class="form-group col-md-8">
                <label>Loại tài khoản :</label> <label style="color: #0F75BC"><?php echo $me->account_role;?></label>
            </div>
            <div class="form-group col-md-8">
                <label>Ngày tham gia :</label> <label style="color: #0F75BC"><?php echo $me->created_at;?></label>
            </div>
        </div>
        <div class="right">
            <?php include APPPATH.VIEW_PATH.'/many_view_time.php';?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var $editUserFrm = $("#edit-user-frm").validate();
        $("#btnSubmit").click(function(){
            if($editUserFrm.errorList.length == 0){
                $("#edit-user-frm").submit();
            }
        });
    });
</script>