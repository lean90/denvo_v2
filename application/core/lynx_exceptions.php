<?php

if (! defined ( 'BASEPATH' ))
    exit ( 'No direct script access allowed' );
/**
 * LynxException
 *
 * @package lynx
 * @author ANLT <lethanhan.bkaptech@gmail.com>
 */
class Lynx_Exception extends Exception {
    public function __construct($message, $code = '9999') {
        parent::__construct ( $message, $code );
    }
    public function to_hash() {
        $class = get_class ( $this );
        $title = isset ( $this->title ) ? $this->title : '-';
        $ha = array (
                'error' => true,
                'class' => $class,
                'title' => $title,
                'message' => $this->getMessage () 
        );
        if (ENVIRONMENT == 'development') {
            $ha ['debug'] = array (
                    'code' => $this->getCode (),
                    'file' => $this->getFile (),
                    'line' => $this->getLine () 
            );
        }
        return $ha;
    }
}

// DB ERROR
class Lynx_DatabaseConnectionException extends Lynx_Exception {
    public $status_code = '500';
    public $title = 'DB CONECTION ERROR';
}
class Lynx_DatabaseQueryException extends Lynx_Exception {
    public $status_code = '500';
    public $title = 'DB QUERY ERRO';
}
class Lynx_MySqlConnectionException extends Lynx_DatabaseConnectionException {
    public $title = 'MySQL CONNECTION ERROR';
}
class Lynx_MySqlQueryException extends Lynx_DatabaseQueryException {
    public $title = 'MySQL QUERY ERROR';
}

// Routing
class Lynx_RoutingException extends Lynx_Exception {
    public $status_code = '404';
    public $title = 'PAGE NOT FOUND';
    public function __construct($message = 'KHÔNG TÌM THẤY TRANG') {
        parent::__construct ( $message );
    }
}

// BusinessLogicEROR
class Lynx_BusinessLogicException extends Lynx_Exception {
    public $status_code = '500';
    public $title = 'BusinessLogicError';
}

// ModelError
class Lynx_ModelMiscException extends Lynx_BusinessLogicException {
    public $status_code = '500';
    public $title = 'LỖI MODEL';
}
// Controller
class Lynx_ControllerMiscException extends Lynx_BusinessLogicException {
    public $status_code = '500';
    public $title = 'LỖI CONTROLLER';
}

// ACCESS CONTROL EXCEPTION
class Lynx_AccessControlException extends Lynx_Exception {
    public $status_code = '403';
    public $title = 'LỖI TRUY CẬP';
}
class Lynx_AuthenticationException extends Lynx_AccessControlException {
    public $title = 'LỖI XÁC MINH';
}

// LỖI TRUY CẬP ĐƯỜNG DẪN
class Lynx_RequestException extends Lynx_Exception {
    public $status_code = '400';
    public $title = 'LỖI TRUY CẬP ĐƯỜNG DẪN';
}

// MAINTAINCE
class Lynx_MaintenanceException extends Lynx_Exception {
    public $status_code = '200';
    public $title = 'BẢO TRÌ HỆ THỐNG';
}

// View exception
class Lynx_ViewException extends Lynx_Exception {
    public $status_code = '500';
    public $title = 'Lỗi view';
    public function __construct($message = 'Khởi tạo view sảy ra lỗi.') {
        parent::__construct ( $message );
    }
}

// Lỗi khi gửi mail
class Lynx_EmailException extends Lynx_Exception {
    public $status_code = '500';
    public $title = 'Lỗi EMAIL';
    public function __construct($message = 'KHông thực hiện được việc gửi mai.') {
        parent::__construct ( $message );
    }
}
class Lynx_IOException extends Lynx_Exception {
    public $status_code = '500';
    public $title = 'Lỗi view';
    public function __construct($message = 'Lỗi tương tác với files.') {
        parent::__construct ( $message );
    }
}
class Lynx_EmptyDataSetException extends Lynx_Exception {
    public $title = 'Lỗi không tìm thấy bản ghi bắt buộc';
    public function __construct($message = 'Không tìm thấy bản ghi bắt buộc có kết quả.') {
        parent::__construct ( $message );
    }
}




