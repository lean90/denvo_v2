<?php
abstract class T_base {
	const id = 'id';
	const created_at = 'created_at';
	const deleted_at = 'deleted_at';
	const delete = 'delete';
}
class T_user extends T_base {
	CONST tableName = "t_user";
	CONST us = 'us';
	CONST pw = 'pw';
	CONST full_name = 'full_name';
	CONST platform = 'platform';
	CONST dob = 'dob';
	CONST avartar = 'avartar';
	CONST email = 'email';
	CONST gender = 'gender';
	CONST account_role = 'account_role';
	CONST account_status = 'account_status';
	CONST last_activity = 'last_activity';
	CONST status = 'status';
}
class T_category extends T_base {
	CONST tableName = "t_category";
	CONST category_id = 'category_id';
	CONST part_tree = "part_tree";
	CONST order = "order";
	CONST part_url = 'part_url';
	CONST name = 'name';
	CONST visible = 'visible';
	CONST category_type = 'category_type';
}
class T_comment extends T_base {
	CONST tableName = "t_comment";
	CONST user_id = 'user_id';
	CONST post_id = 'post_id';
	CONST comment = 'comment';
	CONST visible = 'visible';
}
class T_object extends T_base {
	CONST tableName = "t_object";
	CONST user_id = 'user_id';
	CONST full_name = 'full_name';
	CONST dob = 'dob';
}
class T_post extends T_base {
	CONST tableName = "t_post";
	CONST user_id = 'user_id';
	CONST category_id = 'category_id';
	CONST part_url = 'part_url';
	CONST title = 'title';
	CONST description = 'description';
	CONST content = 'content';
	CONST content_static = 'content_static';
	CONST view_count = 'view_count';
	CONST thumbnail = 'thumbnail';
}
class T_post_tag extends T_base {
	CONST tableName = "t_post_tag";
	CONST post_id = 'post_id';
	CONST tag_id = 'tag_id';
}
class T_setting extends T_base {
	CONST tableName = "t_setting";
	CONST key = 'key';
	CONST value = 'value';
}
class T_file extends T_base {
	CONST tableName = "t_file";
	CONST url = 'url';
	CONST is_dir = 'is_dir';
	CONST internal_path = 'internal_path';
}
class T_user_session extends T_base {
	CONST tableName = "t_user_session";
	CONST user_id = 'user_id';
	CONST session_id = 'session_id';
	CONST activity = 'activity';
}
class T_tag extends T_base {
	CONST tableName = "t_tag";
	CONST key = 'key';
	CONST value = 'value';
}
class T_profile extends T_base {
	CONST tableName = "t_profile";
	CONST support_id = 'support_id';
	CONST user_id = 'user_id';
	CONST full_name = 'full_name';
	CONST dob = 'dob';
	CONST email = 'email';
	CONST gender = 'gender';
	CONST teeth_status = 'teeth_status';
	CONST examination_at = 'examination_at';
}
class T_teeth_grow extends T_base {
	CONST tableName = "t_teeth_grow";
	CONST support_id = 'support_id';
	CONST user_id = 'user_id';
	CONST full_name = 'full_name';
	CONST dob = 'dob';
	CONST email = 'email';
	CONST gender = 'gender';
	CONST history = 'history';
	CONST examination_at = 'examination_at';
}
class T_profile_detail extends T_base {
	CONST tableName = "t_profile_detail";
	CONST profile_id = 'profile_id';
	CONST teeth_code = 'teeth_code';
	CONST teeth_status = 'teeth_status';
}
class T_support_ticket extends T_base {
	CONST tableName = "t_support_ticket";
	CONST user_post = 'user_post';
	CONST user_response = 'user_response';
	CONST ticket_content = 'ticket_content';
	CONST ticket_response = 'ticket_response';
}
class T_session {
	CONST tableName = "t_sessions";
	CONST session_id = 'session_id';
	CONST ip_address = 'ip_address';
	CONST user_agent = 'user_agent';
	CONST last_activity = 'last_activity';
	CONST user_data = 'user_data';
}
class T_questions extends T_base{
    CONST tableName = "t_questions";
    CONST email = 'email';
    CONST full_name = 'full_name';
    CONST question = 'question';
    CONST view_count = 'view_count';
    CONST question_type = 'question_type';
    CONST file_url = "file_url";
    CONST file_name = "file_name";
    CONST fk_user = "fk_user";
    CONST q_status = "q_status";
    CONST attached_img_1 = "attached_img_1";
    CONST attached_img_2 = "attached_img_2";
    CONST attached_img_3 = "attached_img_3";
}
class T_answers extends T_base{
    CONST tableName = "t_answers";
    CONST fk_question = 'fk_question';
    CONST fk_user = 'fk_user';
    CONST answer = 'answer';
    CONST total_like_number = 'total_like_number';
}
class T_position extends  T_base{
    CONST tableName = "t_position";
    CONST fk_category = 'fk_category';
    CONST name = 'name';
    CONST description = 'description';
    CONST latitude = 'latitude';
    CONST longitude = 'longitude';
    CONST website_link = 'website_link';
    CONST position_type = 'position_type';
    CONST img1 = "img1";
    CONST img2 = "img2";
    CONST img3 = "img3";
    CONST img4 = "img4";
    CONST hotline = "hotline";
    CONST logo = "logo";
    CONST sort_description = "sort_description";
    CONST detail_address = "detail_address";
    CONST like_number = "like_number";
    CONST email = "email";
    CONST working_time = "working_time";
}